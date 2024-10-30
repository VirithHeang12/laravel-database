<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::all();
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
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Doctor::create([
                'full_name' => $request['full_name'],
                'specialty' => $request['specialty'],
                'phone_number' => $request['phone_number'],
            ]);

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
    public function update(Request $request, Doctor $doctor)
    {
        DB::beginTransaction();
        try {
            $doctor->update([
                'full_name' => $request->full_name,
                'specialty' => $request->specialty,
                'phone_number' => $request->phone_number,
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
}
