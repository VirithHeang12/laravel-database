<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            Product::create([
                'name'          => $request->name,
                'description'   => $request->description,
                'price'         => $request->price,
                'category_id'   => 1,
            ]);

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('products.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        DB::beginTransaction();

        try {
            $product->update([
                'name'          => $request->name,
                'description'   => $request->description,
                'price'         => $request->price,
                'category_id'   => 1,
            ]);

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('products.index')->with('error', 'Product update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();

        try {
            // $product->delete();
            DB::table('products')->where('id', $product->id)->delete();

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('products.index')->with('error', 'Product deletion failed');
        }
    }

    /**
    * Show the form for importing products.
    * @return \Illuminate\Http\Response
    */
    public function createImport()
    {
        return view('products.import');
    }

    /**
     * Import products from excel file.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveImport(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $import = new ProductsImport;

        Excel::queueImport($import, $request->file('file'));

        return redirect()->route('products.index')->with('success', 'Products imported successfully');
    }

    /**
     * Export products to Excel file.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        activity()
            ->causedByAnonymous()
            ->performedOn(new Product)
            ->log('Exported products to Excel file');

        return Excel::download(new ProductsExport, 'products.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    /**
     * Export products using FromView.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportView(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new ProductsExport, 'products.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    /**
     * Display all logs.
     *
     * @return \Illuminate\Http\Response
     */
    public function logs(): \Illuminate\View\View
    {
        $logs = Activity::all();

        return view('products.logs', [
            'logs'  => $logs
        ]);
    }
}
