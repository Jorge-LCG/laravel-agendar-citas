<x-admin-layout 
    title="Dentify | Citas"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Citas'
        ]
    ]
">
    <x-slot name="action">
        <x-wire-button href="{{ route('admin.appointments.create') }}" blue>
            <i class="fa-solid fa-plus"></i>
            Nuevo
        </x-wire-button>
    </x-slot>
</x-admin-layout>