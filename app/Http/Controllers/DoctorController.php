<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Http\Requests\Doctors\StoreRequest;
use App\Http\Requests\Doctors\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return view('doctors.show', [
            'doctor' => $doctor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', [
            'doctor' => $doctor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
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


    /**
     * Remove the specified resource from storage.
     */
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

    public function deletedDoctors(){
        $deletedDoctors = Doctor::onlyTrashed()->get();
        return view('doctors.deleted-doctors', [
            'doctors' => $deletedDoctors
        ]);
    }
}
