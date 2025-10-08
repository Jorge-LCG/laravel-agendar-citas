<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        return view('admin.roles.index');
    }

    public function create(): View
    {
        return view('admin.roles.create');
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Role::create($validated);
        
        return redirect()->route('admin.roles.index')->with('swal', [
            'icon' => 'success',
            'title' => 'Rol creado correctamente',
            'text' => 'El rol ha sido creado exitosamente'
        ]);
    }

    public function edit(Role $role): RedirectResponse | View
    {
        if ($role->id <= 4) {
            return redirect()->route('admin.roles.index')->with('swal', [
                'icon' => 'error',
                'title' => 'Rol Protegido',
                'text' => 'Este rol es necesario para el funcionamiento básico de la aplicación.'
            ]);
        }

        return view('admin.roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $validated = $request->validated();

        $role->update($validated);

        return redirect()->route('admin.roles.index')->with('swal', [
            'icon' => 'success',
            'title' => 'Rol actualizado correctamente',
            'text' => 'El rol ha sido actualizado exitosamente'
        ]);
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($role->id <= 4) {
            return redirect()->route('admin.roles.index')->with('swal', [
                'icon' => 'error',
                'title' => 'Rol Protegido',
                'text' => 'Este rol es necesario para el funcionamiento básico de la aplicación.'
            ]);
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('swal', [
            'icon' => 'success',
            'title' => 'Rol eliminado correctamente',
            'text' => 'El rol ha sido eliminado exitosamente'
        ]);
    }
}
