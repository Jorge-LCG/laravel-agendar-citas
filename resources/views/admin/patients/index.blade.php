<x-admin-layout 
    title="Dentify | Pacientes"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Pacientes'
        ]
    ]
">
    @livewire('admin.datatables.patient-table')
</x-admin-layout>