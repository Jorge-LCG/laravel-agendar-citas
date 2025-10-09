<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PatientRequest;
use App\Models\BloodType;
use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function index(): View
    {
        return view('admin.patients.index');
    }

    public function edit(Patient $patient): View
    {
        $bloodTypes = BloodType::all();
        return view('admin.patients.edit', compact('patient', 'bloodTypes'));
    }

    public function update(PatientRequest $request, Patient $patient): RedirectResponse
    {
        $validated = $request->validated();

        $patient->update($validated);

        return redirect()->route('admin.patients.edit', $patient)->with('swal', [
            'icon' => 'success',
            'title' => 'Paciente actualizado',
            'text' => 'El paciente ha sido actualizado exitosamente'
        ]);
    }
}
