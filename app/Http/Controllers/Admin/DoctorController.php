<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DoctorRequest;
use App\Models\Doctor;
use App\Models\Speciality;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DoctorController extends Controller
{
    public function index(): View
    {
        return view('admin.doctors.index');
    }

    public function edit(Doctor $doctor): View
    {
        $specialities = Speciality::all();

        return view('admin.doctors.edit', compact('doctor', 'specialities'));
    }

    public function update(DoctorRequest $request, Doctor $doctor): RedirectResponse
    {
        $validated = $request->validated();

        $doctor->update($validated);

        return redirect()->route('admin.doctors.edit', $doctor)->with('swal', [
            'icon' => 'success',
            'title' => 'Doctor actualizado',
            'text' => 'El doctor ha sido actualizado exitosamente'
        ]);
    }

    public function schedules(Doctor $doctor): View 
    {
        return view('admin.doctors.schedules', compact('doctor'));
    }
}
