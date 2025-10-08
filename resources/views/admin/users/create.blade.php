<x-admin-layout 
    title="Dentify | Crear Usuario"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Usuarios',
            'href' => route('admin.users.index')
        ],
        [
            'name' => 'Nuevo'
        ]
    ]
">
    <x-wire-card class="border">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <div class="grid lg:grid-cols-2 gap-4">
                    <x-wire-input
                        label="Nombre"    
                        name="name"
                        placeholder="Nombre del usuario"
                        :value="old('name')"
                    />
        
                    <x-wire-input
                        label="Correo electrónico"
                        name="email"
                        type="email"
                        placeholder="Correo electrónico de usuario"
                        :value="old('email')"
                    />
                    
                    <x-wire-input
                        label="Contraseña"
                        name="password"
                        type="password"
                        placeholder="Ingrese contraseña del usuario"
                    />
        
                    <x-wire-input
                        label="Contraseña"
                        name="password_confirmation"
                        type="password"
                        placeholder="Confirme la contraseña del usuario"
                    />
        
                    <x-wire-input
                        label="DNI"
                        name="dni"
                        placeholder="Ingrese el DNI del usuario"
                        :value="old('dni')"
                    />
        
                    <x-wire-input
                        label="Teléfono"
                        name="phone"
                        type="tel"
                        placeholder="Ingrese el teléfono del usuario"
                        :value="old('phone')"
                    />
                </div>
    
                <x-wire-input
                    label="Dirección"
                    name="address"
                    placeholder="Confirme la contraseña del usuario"
                    :value="old('address')"
                />

                <x-wire-native-select name="role_id">
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $role)
                        <option 
                            value="{{ $role->id }}"
                            @selected(old('role_id') == $role->id)
                        >{{ $role->name }}</option>
                    @endforeach
                </x-wire-native-select>
                
                <div class="flex justify-end">
                    <x-wire-button type="submit" blue>
                        Guardar
                    </x-wire-button>
                </div>
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>