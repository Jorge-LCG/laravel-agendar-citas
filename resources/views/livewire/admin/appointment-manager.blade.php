<div x-data="data()">
    <x-wire-card class="mb-8">
        <p class="text-xl font-semibold mb-1 text-slate-800">
            Buscar disponibiidad
        </p>

        <p>Encuentra el horario perfecto para tu cita</p>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <x-wire-input
                label="Fecha"
                type="date"
                wire:model='search.date'
                placeholder="Seleccione una fecha"
            />

            <x-wire-select
                label="Hora"
                wire:model='search.hour'
                placeholder="Seleccione una hora"
            >
                @foreach ($this->hourBlocks as $hourBlock)
                    <x-wire-select.option
                        :label="$hourBlock->format('H:i:s') . ' - ' . $hourBlock->copy()->addHour()->format('H:i:s')"
                        :value="$hourBlock->format('H:i:s')"
                    />
                @endforeach
            </x-wire-select>
            
            <x-wire-select
                label="Especialidad (Opcional)"
                wire:model='search.speciality_id'
                placeholder="Seleccione una especialidad"
            >
                @foreach ($specialities as $speciality)
                    <x-wire-select.option
                        :label="$speciality->name"
                        :value="$speciality->id"
                    />
                @endforeach
            </x-wire-select>

            <div class="lg:pt-6.5">
                <x-wire-button
                    wire:click='searchAvailability'
                    class="w-full"
                    color="blue"
                >
                    Buscar Disponibilidad
                </x-wire-button>
            </div>
        </div>
    </x-wire-card>

    @if ($appointment['date'])
        @if (count($availabilities))
            <div class="grid lg:grid-cols-3 gap-4 lg:gap-8">
                <div class="col-span-1 lg:col-span-2 space-y-6">
                    @foreach ($availabilities as $availability)  
                        <x-wire-card>
                            <div class="flex items-center space-x-4 mb-5">
                                <img
                                    class="h-16 w-16 rounded-full object-cover"
                                    src="{{ $availability['doctor']->user->profile_photo_url }}" 
                                    alt="{{ $availability['doctor']->user->name }}"
                                />

                                <div>
                                    <p class="text-xl font-bold text-slate-800">
                                        {{ $availability['doctor']->user->name }}
                                    </p>

                                    <p class="text-sm text-blue-600 font-medium">
                                        {{ $availability['doctor']->speciality?->name ?? 'Sin especialidad' }}
                                    </p>
                                </div>
                            </div>

                            <hr class="my-5" />

                            <div>
                                <p class="text-sm text-gray-600 mb-2 font-semibold">
                                    Horarios disponibles:
                                </p>

                                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                                    @foreach ($availability['schedules'] as $schedule)
                                        <li>
                                            <x-wire-button blue
                                                x-on:click="selectSchedule({{ $availability['doctor']->id }}, '{{ $schedule['start_time'] }}')"
                                                x-bind:class="selectedSchedules.doctor_id === {{ $availability['doctor']->id }} && selectedSchedules.schedules.includes('{{ $schedule['start_time'] }}') ? 'bg-opacity-50' : ''" 
                                                class="w-full"
                                            >
                                                {{ $schedule['start_time'] }}
                                            </x-wire-button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </x-wire-card>
                    @endforeach
                </div>

                <div class="col-span-1">
                    @json($selectedSchedules)
                </div>
            </div>
        @else
            <x-wire-card>
                <p>No hay disponibilidad para la fecha y hora seleccionada</p>
            </x-wire-card>
        @endif
    @endif

    @push('js')
        <script>
            function data() {
                return {
                    selectedSchedules: @entangle('selectedSchedules').live,
                    selectSchedule(doctorId, schedule) {
                        if (this.selectedSchedules.doctor_id !== doctorId) {
                            this.selectedSchedules = {
                                doctor_id: doctorId,
                                schedules: [schedule]
                            }

                            return;
                        }

                        let currentSchedules = this.selectedSchedules.schedules;
                        let newSchedules = [];

                        if (currentSchedules.includes(schedule)) {
                            newSchedules = currentSchedules.filter(s => s !== schedule);
                        } else {
                            newSchedules = [...currentSchedules, schedule];
                        }

                        if (this.isContiguous(newSchedules)) {
                            this.selectedSchedules = {
                                doctor_id: doctorId,
                                schedules: newSchedules
                            }
                        } else {
                            this.selectedSchedules = {
                                doctor_id: doctorId,
                                schedules: [schedule]
                            }
                        }
                    },
                    isContiguous(schedules) {
                        if(schedules.length < 2) {
                            return true;
                        }

                        let sortedSchedules = schedules.sort();

                        for(let i = 0; i < sortedSchedules.length - 1; i++) {
                            let currentTime = sortedSchedules[i];
                            let nextTime = sortedSchedules[i + 1];

                            if (this.calculateNextTime(currentTime) !== nextTime) {
                                return false;
                            }
                        }

                        return true;
                    },
                    calculateNextTime(time) {
                        let date = new Date(`1970-01-01T${time}`);
                        let duration = parseInt("{{ config('schedule.appointment_duration') }}");

                        date.setMinutes(date.getMinutes() + duration);
                        return date.toTimeString().split(' ')[0];
                    }
                }
            }
        </script>
    @endpush
</div>
