<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorController extends Controller
{
    public function index(): View
    {
        return view('admin.doctors.index');
    }


    public function edit(Doctor $doctor): View
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
