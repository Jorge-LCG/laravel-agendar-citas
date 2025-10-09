<x-admin-layout 
    title="Dentify | Pacientes"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Pacientes',
            'href' => route('admin.patients.index')
        ],
        [
            'name' => 'Editar'
        ]
    ]
">
    <form action="{{ route('admin.patients.update', $patient) }}" method="POST">
        @csrf
        @method('PUT')
        <x-wire-card class="border mb-8">
            <div class="lg:flex lg:justify-between lg:items-center">
                <div class="flex items-center space-x-5">
                    <img 
                        src="{{ $patient->user->profile_photo_url }}" 
                        alt="{{ $patient->user->name }}"
                        class="h-20 w-20 rounded-full object-cover object-center"    
                    />
    
                    <div>
                        <p class="text-2xl font-bold text-gray-900 mb-1">
                            {{ $patient->user->name }}
                        </p>

                        <p class="text-sm font-semibold text-gray-500">
                            DNI: {{ $patient->user->dni ?? 'N/A' }}
                        </p>
                    </div>
                </div>
    
                <div class="flex space-x-3 mt-5">
                    <x-wire-button outline black href="{{ route('admin.patients.index') }}">
                        Voler
                    </x-wire-button>
    
                    <x-wire-button blue type="submit">
                        <i class="fa-solid fa-check"></i>
                        Guardar cambios
                    </x-wire-button>
                </div>
            </div>
        </x-wire-card>

        <x-wire-card class="border">
            <x-tabs active="datos-personales">
                <x-slot name="header">
                    <x-tab-link tab="datos-personales">
                        <i class="fa-solid fa-user me-2"></i>
                        Datos Personales
                    </x-tab-link>
                    
                    <x-tab-link tab="actecedentes">
                        <i class="fa-solid fa-file-lines me-2"></i>
                        Antecedentes
                    </x-tab-link>
                    
                    <x-tab-link tab="informacion-general">
                        <i class="fa-solid fa-info me-2"></i>
                        Información General
                    </x-tab-link>
                    
                    <x-tab-link tab="contacto-emergencia">
                        <i class="fa-solid fa-heart me-2"></i>
                        Contacto de Emergencia
                    </x-tab-link>
                </x-slot>

                <div class="px-4 mt-4">
                    <x-tab-content tab="datos-personales">
                        <x-wire-alert title="Edición de Usuario" info padding="large" class="mb-4">
                            <x-slot name="slot">
                                Pata editar esta información, dirigete al 
                                <b>
                                    <a 
                                        href="{{ route('admin.users.edit', $patient->user) }}" 
                                        class="underline" 
                                        target="_blank"
                                    >
                                        perfil del usuario
                                    </a>
                                </b> 
                                asociado a este paciente.
                            </x-slot>
                        </x-wire-alert>
    
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div>
                                <span class="text-gray-500 font-semibold text-sm">
                                    Teléfono:
                                </span>
    
                                <span class="text-gray-900 text-sm ml-1">
                                    {{ $patient->user->phone }}
                                </span>
                            </div>
                            
                            <div>
                                <span class="text-gray-500 font-semibold text-sm">
                                    Correo electrónico:
                                </span>
    
                                <span class="text-gray-900 text-sm ml-1">
                                    {{ $patient->user->email }}
                                </span>
                            </div>
                            
                            <div>
                                <span class="text-gray-500 font-semibold text-sm">
                                    Dirección:
                                </span>
    
                                <span class="text-gray-900 text-sm ml-1">
                                    {{ $patient->user->address }}
                                </span>
                            </div>
                        </div>
                    </x-tab-content>
    
                    <x-tab-content tab="actecedentes">
                        <div class="grid lg:grid-cols-2 gap-4">
                            <x-wire-textarea label="Alergias Conocidas" name="allergies">
                                {{ old('allergies', $patient->allergies) }}
                            </x-wire-textarea>
    
                            <x-wire-textarea label="Enfermedades Crónicas" name="chronic_conditions">
                                {{ old('chronic_conditions', $patient->chronic_conditions) }}
                            </x-wire-textarea>
                            
                            <x-wire-textarea label="Antecedentes Quirúrgicos" name="surgical_history">
                                {{ old('surgical_history', $patient->surgical_history) }}
                            </x-wire-textarea>
                            
                            <x-wire-textarea label="Antecedentes Familiares" name="family_history">
                                {{ old('family_history', $patient->allergies) }}
                            </x-wire-textarea>
                        </div>
                    </x-tab-content>
                    
                    <x-tab-content tab="informacion-general">
                        <x-wire-native-select label="Tipo de sangre" name="blood_type_id" class="mb-4">
                            <option value="">Seleccionar tipo de sangre</option>
                            @foreach ($bloodTypes as $bloodType)
                                <option value="{{ $bloodType->id }}" @selected($bloodType->id === $patient->blood_type_id)>{{ $bloodType->name }}</option>
                            @endforeach
                        </x-wire-native-select>
    
                        <x-wire-textarea label="Observaciones" name="observations">
                            {{ old('observations', $patient->observations) }}
                        </x-wire-textarea>
                    </x-tab-content>
                    
                    <x-tab-content tab="contacto-emergencia">
                        <div class="space-y-4">
                            <x-wire-input
                                label="Nombre del contacto"
                                name="emergency_contact_name"
                                :value="old('emergency_contact_name', $patient->emergency_contact_name)"
                                placeholder="Ingrese nombre de contacto"
                            />
    
                            <x-wire-input
                                label="Teléfono del contacto"
                                name="emergency_contact_phone"
                                type="tel"
                                :value="old('emergency_contact_phone', $patient->emergency_contact_phone)"
                                placeholder="Ingrese teléfono de contacto"
                            />
                            
                            <x-wire-input
                                label="Relación con el contacto"
                                name="emergency_contact_relationship"
                                :value="old('emergency_contact_relationship', $patient->emergency_contact_relationship)"
                                placeholder="Ingrese relación de contacto"
                            />
                        </div>
                    </x-tab-content>
                </div>
            </x-tabs>
        </x-wire-card>
    </form>
</x-admin-layout>