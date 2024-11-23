<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Http\Requests\Doctors\StoreRequest;
use App\Http\Requests\Doctors\UpdateRequest;
use App\Imports\Doctors\DoctorsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DoctorsExport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Spatie\Activitylog\Models\Activity;



class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $doctors = Doctor::when($request->specialty, function ($query, $specialty) {
            return $query->where('specialty', '=', $specialty);
        })->when($request->full_name, function ($query, $full_name) {
            return $query->where('full_name', 'like', '%' . $full_name . '%');
        })->paginate(10)->withQueryString();

        return view('doctors.index', [
            'doctors' => $doctors
        ]);
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            // Doctor::create([
            //     'full_name' => $validated['full_name'],
            //     'specialty' => $validated['specialty'],
            //     'phone_number' => $validated['phone_number'],
            // ]);
            Doctor::updateOrCreate(
                [
                    'full_name' => $validated['full_name'],
                    'phone_number' => $validated['phone_number']
                ],
                [
                    'specialty' => $validated['specialty'],
                ]
            );

            DB::commit();
            return redirect()->route('doctors.index')->with('success', 'Doctor created succesfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('doctors.index')->with('error', 'Doctor creation failed.');
        }
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', [
            'doctor' => $doctor
        ]);
    }

    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', [
            'doctor' => $doctor
        ]);
    }

    public function update(UpdateRequest $request, Doctor $doctor)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $doctor->update([
                'full_name' => $validated['full_name'],
                'specialty' => $validated['specialty'],
                'phone_number' => $validated['phone_number'],
            ]);

            DB::commit();
            return redirect()->route('doctors.index')->with('success', 'Doctor updated succesfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('doctors.index')->with('error', 'Doctor update failed.');
        }
    }

    public function destroy(Doctor $doctor)
    {
        DB::beginTransaction();
        try {
            $doctor->delete();
            DB::commit();

            return redirect()->route('doctors.index')->with('success', 'Doctor deleted succesfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('doctors.index')->with('error', 'Doctor deletion failed.');
        }
    }

    public function deletedDoctors()
    {
        $deletedDoctors = Doctor::onlyTrashed()->get();
        return view('doctors.deleted-doctors', [
            'doctors' => $deletedDoctors
        ]);
    }

    public function restoreDoctor($id)
    {
        $doctor = Doctor::withTrashed()->find($id);

        DB::beginTransaction();

        try {
            $doctor->restore();

            DB::commit();

            return redirect()->route('doctors.index')->with('success', 'Doctor restored successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('doctors.index')->with('error', 'Doctor restoration failed');
        }
    }

    public function restoreAllDoctors()
    {
        DB::beginTransaction();

        try {
            // Restore all deleted doctors
            Doctor::onlyTrashed()->restore();

            DB::commit();

            return redirect()->route('doctors.index')->with('success', 'All deleted doctors restored successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('doctors.index')->with('error', 'Failed to restore all doctors');
        }
    }

    public function createImport()
    {
        return view('doctors.import');
    }

    public function saveImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $filePath = $request->file('file');

        $spreadsheet = IOFactory::load($filePath->getPathname());
        $sheetCount = $spreadsheet->getSheetCount();

        // Define specialties for each sheet
        $sheetSpecialties = [
            'Cardiology',   // Sheet 1
            'Neurology',    // Sheet 2
            'Pediatrics',   // Sheet 3
            'Dermatology',  // Sheet 4
        ];

        // Trim specialties to match the sheet count
        $sheetSpecialties = array_slice($sheetSpecialties, 0, $sheetCount);

        $import = new DoctorsImport($sheetSpecialties);

        try {
            Excel::import($import, $filePath);

            $successes = $import->getSuccesses();
            $fails = $import->getFails();

            if (count($fails) > 0) {
                $export = new DoctorsExport();
                $export->setFails(collect($fails));
                $export->setSuccessesCount(count($successes));
                $export->setFailsCount(count($fails));

                return Excel::download($export, 'import_results.xlsx');
            }

            return redirect()
                ->route('doctors.index')
                ->with('success', 'Imported ' . count($successes) . ' doctors successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred during import: ' . $e->getMessage()]);
        }
    }



    public function export()
    {
        activity()
            ->causedByAnonymous()
            ->performedOn(new Doctor)
            ->log('Exported doctors to Excel file');

        return Excel::download(new DoctorsExport, 'doctors.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportView(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new DoctorsExport, 'doctors.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    public function logs(): \Illuminate\View\View
    {
        $logs = Activity::all();

        return view('doctors.logs', [
            'logs'  => $logs
        ]);
    }
}
