<?php

namespace App\Http\Controllers;

use App\Exports\CarsExport;
use App\Http\Requests\Cars\StoreRequest;
use App\Http\Requests\Cars\UpdateRequest;
use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cars = Car::when($request->price, function ($query, $price) {
            return $query->where('price', '>=', $price);
        })->when($request->year, function ($query, $year) {
            return $query->where('year', '>=', $year);
        })->when($request->model, function ($query, $model) {
            return $query->where('model', 'like', '%' . $model . '%');
        })->paginate(7)->withQueryString();

        App::setlocale('km');

        return view('cars.index', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            Car::updateOrCreate([
                'model'         => $validated['model'],
                'year'          => $validated['year'],
            ], [
                'color'         => $validated['color'],
                'engine_type'   => $validated['engine_type'],
                'price'         => $validated['price']
            ]);
            DB::commit();

            return redirect()->route('cars.index')->with('success', 'Car created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('cars.index')->with('error', 'Car creation failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('cars.show', [
            'car' => $car
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('cars.edit', [
            'car' => $car
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Car $car)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $car->update([
                'model'         => $validated['model'],
                'year'          => $validated['year'],
                'color'         => $validated['color'],
                'engine_type'   => $validated['engine_type'],
                'price'         => $validated['price']
            ]);

            DB::commit();

            return redirect()->route('cars.index')->with('success', 'Car updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('cars.index')->with('error', 'Car update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        DB::beginTransaction();

        try {
            $car->delete();

            DB::commit();

            return redirect()->route('cars.index')->with('success', 'Car deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('car.index')->with('error', 'Car deletion failed');
        }
    }

    /**
     * Display a listing of popular cars.
     *
     * @return \Illuminate\Http\Response
     */
    public function popularCars()
    {
        $popularCars = DB::table('cars')
            ->where('price', '>=', 1000000)
            ->where('year', '>=', 2010)
            ->get();

        return view('cars.popular-cars', [
            'cars' => $popularCars
        ]);
    }

    /**
     * Display deleted cars.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function deletedCars()
    {
        $deletedCars = Car::onlyTrashed()->get();

        return view('cars.deleted-cars', [
            'cars' => $deletedCars
        ]);
    }

    public function restoreCar($id)
    {
        $car = Car::withTrashed()->find($id);

        DB::beginTransaction();

        try {
            $car->restore();

            DB::commit();

            return redirect()->route('cars.index')->with('success', 'Car restored successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('cars.index')->with('error', 'Car restoration failed');
        }
    }

    /**
     * Show the form for importing cars.
     *
     * @return \Illuminate\Http\Response
     */
    public function createImport()
    {
        return view('cars.import');
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

        Excel::import(new CarsImport, $request->file('file'));

        return redirect()->route('cars.index')->with('success', 'Cars imported successfully');
    }
}
