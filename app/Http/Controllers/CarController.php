<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
                ->paginate(7);

            $cars->appends(['price' => $request->price, 'year' => $request->year, 'model' => $request->model]);

        } else {
            $cars = Car::paginate(7)->withQueryString();
        }

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
    public function store(StoreCarRequest $request)
    {
        DB::beginTransaction();

        try {
            Car::create([
                'model'         => $request['model'],
                'year'          => $request['year'],
                'color'         => $request['color'],
                'engine_type'   => $request['engine_type'],
                'price'         => $request['price']
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
    public function update(Request $request, Car $car)
    {
        $data = $request->validate([
            'model'         => ['required', 'string', 'unique:cars,model,' . $car->id],
            'year'          => ['required', 'integer', 'min:1900', 'max:2024'],
            'color'         => ['nullable', 'string'],
            'engine_type'   => ['nullable', 'string'],
            'price'         => ['required', 'numeric', 'min:0']
        ]);

        DB::beginTransaction();

        try {
            $car->update([
                'model'          => $data['model'],
                'year'           => $data['year'],
                'color'          => $data['color'],
                'engine_type'    => $data['engine_type'],
                'price'          => $data['price']
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
