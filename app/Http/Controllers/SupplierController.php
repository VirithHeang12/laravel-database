<?php

namespace App\Http\Controllers;

use App\Http\Requests\Suppliers\StoreRequest;
use App\Http\Requests\Suppliers\UpdateRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     $suppliers = Supplier::all();
    //     if(($request->has('name') && isset($request->name)) || ($request->has('address') && isset($request->address))){
    //         $suppliers = DB::table('suppliers')
    //                     ->where(function ($query) use ($request){
    //                         $query->where('name',  '>=', $request->name);
    //                         $query->orWhere('address', 'like', '%'. $request->address.'%');
    //                     })
    //                     ->paginate(10);
    //     }
    //     else{
    //         $suppliers = Supplier::paginate(10);
    //     }

    //     return view('suppliers.index', [
    //         'suppliers' => $suppliers
    //     ]);
    // }

    public function index(Request $request)
{
    // Default query without filters
    $suppliersQuery = DB::table('suppliers');

    // Apply filters if the name or address fields are provided
    if (($request->has('name') && !empty($request->name)) || ($request->has('address') && !empty($request->address))) {
        $suppliersQuery->where(function ($query) use ($request) {
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('address')) {
                $query->orWhere('address', 'like', '%' . $request->address . '%');
            }
        });
    }

    // Paginate the final query
    $suppliers = $suppliersQuery->paginate(10);

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
            Supplier::create([
                'name'    => $request['name'],
                'email'   => $request['email'],
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
}
