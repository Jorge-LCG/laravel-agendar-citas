<x-admin-layout 
    title="Dentify | Doctores"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Doctores',
            'href' => route('admin.doctors.index')
        ],
        [
            'name' => 'Editar'
        ]
    ]
">
</x-admin-layout>