<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (($request->has('price') && isset($request->price)) || ($request->has('year') && isset($request->year)) || ($request->has('model') && isset($request->model))) {
            $cars = DB::table('cars')
                ->where(function ($query) use ($request) {
                    $query->where('price', '>=', $request->price)
                        ->orWhere('year', '>=', $request->year);
                })
                ->where('model', 'like', '%' . $request->model . '%')
                ->paginate(10);

        } else {
            $cars = Car::paginate(10);
        }

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
    public function store(Request $request)
    {
        Car::create([
            'model' => $request['model'],
            'year' => $request['year'],
            'color' => $request['color'],
            'engine_type' => $request['engine_type'],
            'price' => $request['price'],
        ]);

        return redirect()->route('cars.index');
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
    public function update(Request $request, Car $car)
    {
        DB::beginTransaction();

        try {
            $car->update([
                'model'          => $request->model,
                'year'   => $request->year,
                'color'         => $request->color,
                'engine_type'   => $request->engine_type,
                'price' => $request->price
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
}
