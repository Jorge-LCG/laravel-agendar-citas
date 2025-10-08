<x-admin-layout 
    title="Dentify | Crear Rol"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Roles',
            'href' => route('admin.roles.index')
        ],
        [
            'name' => 'Nuevo'
        ]
    ]
">
    <x-wire-card class="border">
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

            <x-wire-input 
                icon="user"
                label="Nombre"    
                name="name"
                placeholder="Nombre del rol"
                value="{{ old('name') }}"
            />

            <div class="flex justify-end mt-4">
                <x-wire-button type="submit" blue>
                    Guardar
                </x-wire-button>
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>