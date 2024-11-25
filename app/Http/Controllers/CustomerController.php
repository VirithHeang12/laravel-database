<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Http\Requests\Customers\StoreRequest;
use App\Http\Requests\Customers\UpdateRequest;
use App\Imports\CustomersImport;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $customers = Customer::all();
        // return view('customers.index', [
        //     'customers' => $customers
        // ]);
    // }
    
    public function index(Request $request){
        $customers = Customer::when($request->name, function($query, $name){
            return $query->where('name', 'like', '%' . $name . '%');
        })->paginate(10)->withQueryString();

        return view('customers.index', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        try {
            // Customer::create([
            //     'name'          => $request['name'],
            //     'phone'         => $request['phone']
            // ]);

            Customer::updateOrCreate(
                [
                    'phone' => $request['phone']
                ], 
                [
                    'name'          => $request['name'],
                    'gender'          => $request['gender']
                ]
            );

            DB::commit();

            return redirect()->route('customers.index')->with('success', 'Customer created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('customers.index')->with('error', 'Customer creation failed');
        }

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Customer $customer)
    {
        DB::beginTransaction();

        try {
            $customer->update([
                'name' => $request['name'],
                'gender' => $request['gender'],
                'phone' => $request['phone']
            ]);

            DB::commit();

            return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('customers.index')->with('error', 'Customer update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        DB::beginTransaction();

        try {
            $customer->delete();

            DB::commit();

            return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('customers.index')->with('error', 'Customer deletion failed');
        }
    }

    public function deletedCustomers(){
        $deletedCustomers = Customer::onlyTrashed()->get();

        return view('customers.deleted-customers', [
            'customers' => $deletedCustomers
        ]);
    }

    public function restoreCustomer($id){
        $customer = Customer::withTrashed()->find($id);

        DB::beginTransaction();

        try {
            $customer->restore();

            DB::commit();

            return redirect()->route('customers.index')->with('success', 'Customer restored successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('customers.index')->with('error', 'Customer restoration failed');
        }
    }

    
    public function restoreAllCustomer(){
        Customer::withTrashed()->restore();

        return redirect()->route('customers.index')->with('success', 'All customers restored successfully');
    }
    
    /**
     * Show the form for importing cars.
     *
     * @return \Illuminate\Http\Response
     */
    public function createImport()
    {
        return view('customers.import');
    }

    /**
     * Import cars from Excel file.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $import = new CustomersImport;

        Excel::import($import, $request->file('file'));

        $sucesses       = $import->getSucesses();
        // $fails          = $import->getFails();

        // if (count($fails) > 0) {
        //     $export = new CustomersExport;
        //     $export->setFails(collect($fails));
        //     $export->setSuccessesCount(count($sucesses));
        //     $export->setFailsCount(count($fails));

        //     return Excel::download($export, 'results.xlsx');
        // }

        return redirect()
            ->route('customers.index')
            ->with('success', 'Imported ' . count($sucesses) . ' customers successfully');
    }
    /**
     * Export products to Excel file.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }

     /**
     * Export products using FromView.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportView(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new CustomersExport, 'customers.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
