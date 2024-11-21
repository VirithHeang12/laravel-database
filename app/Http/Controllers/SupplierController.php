<?php

namespace App\Http\Controllers;

use App\Exports\SuppliersExport;
use App\Http\Requests\Suppliers\StoreRequest;
use App\Http\Requests\Suppliers\UpdateRequest;
use App\Models\Supplier;
use App\Imports\SuppliersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;



class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {

        $suppliers = Supplier::when($request->name, function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })->when($request->address, function ($query, $address) {
            return $query->where('address', 'like', '%' . $address . '%');
        })->paginate(10)->withQueryString();

        return view('suppliers.index', [
            'suppliers' => $suppliers
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        try {
            Supplier::updateOrCreate([
                'email'   => $request['email']
            ], [
                'name'    => $request['name'],
                'phone'   => $request['phone'],
                'address' => $request['address'],
            ]);

            DB::commit();

            return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('suppliers.index')->with('error', 'Supplier creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('suppliers.show', ['supplier' => $supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', ['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Supplier $supplier)
    {
        DB::beginTransaction();

        try {
            $supplier->update([
                'name'    => $request->input('name'),
                'email'   => $request->input('email'),
                'phone'   => $request->input('phone'),
                'address' => $request->input('address'),
            ]);

            DB::commit();

            return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('suppliers.index')->with('error', 'Supplier update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        DB::beginTransaction();

        try {
            $supplier->delete();

            DB::commit();

            return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('suppliers.index')->with('error', 'Supplier deletion failed: ' . $e->getMessage());
        }
    }

    /**
     * Display deleted suppliers.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function deletedSuppliers()
    {
        $deletedSuppliers = Supplier::onlyTrashed()->get();

        return view('suppliers.deleted-suppliers', [
            'suppliers' => $deletedSuppliers
        ]);
    }

    // restore suppliers after they were removed
    public function restoreSupplier($id)
    {
        $supplier = Supplier::withTrashed()->find($id);

        DB::beginTransaction();

        try {
            $supplier->restore();

            DB::commit();

            return redirect()->route('suppliers.index')->with('success', 'Supplier restored successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('suppliers.index')->with('error', 'Supplier restoration failed');
        }
    }


    public function restoreAllSupplier()
    {
        Supplier::withTrashed()->restore();

        return redirect()->route('suppliers.index')->with('success', 'All suppliers restored successfully');
    }


    /**
     * Show the form for importing supplier
     *  @return \Illuminate\Http\Response
     */
    public function createImport()
    {
        return view('suppliers.import');
    }

    /**
     * Import supplier from excel file
     * @return \Illuminate\Http\Response
     */

    //  public function saveImport(Request $request){
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,xls'
    //     ]);

    //     $import = new SuppliersImport;

    //     Excel::import($import, $request->file('file'));

    //     $successes       = $import->getSuccesses();
    //     $fails          = $import->getFails();

    //     if (count($fails) > 0) {
    //         $export = new CarsExport;
    //         $export->setFails(collect($fails));
    //         $export->setSuccessesCount(count($sucesses));
    //         $export->setFailsCount(count($fails));

    //         return Excel::download($export, 'results.xlsx');
    //     }

    //     return redirect()
    //         ->route('suppliers.index')
    //         ->with('success', 'Imported ' . count($successes) . ' suppliers successfully');
    // }

    public function saveImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $import = new SuppliersImport;

        Excel::import($import, $request->file('file'));

        $successes = $import->getSuccesses();
        // $fails = $import->getFails();

        // if (count($fails) > 0) {
        //     $export = new SuppliersExport;
        //     $export->setFails(collect($fails));
        //     $export->setSuccessesCount(count($successes));
        //     $export->setFailsCount(count($fails));

        //     return Excel::download($export, 'results.xlsx');
        // }

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Successfully imported ' . count($successes) . ' suppliers');
    }


    /**
     * Export products to Excel file.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new SuppliersExport, 'suppliers.xlsx');
    }
}
