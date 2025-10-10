@props([
    'title' => config('app.name', 'Laravel'),
    'breadcrumbs' => []
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        {{-- Google Fonts --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- FontAwesome --}}
        <script src="https://kit.fontawesome.com/f20898c6a0.js" crossorigin="anonymous"></script>
        
        {{-- SweetAlert --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- Wireui --}}
        <wireui:scripts />
        
        {{-- Styles / Scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        {{-- Livewire / Styles --}}
        @livewireStyles

        @stack('css')
    </head>
    <body class="font-sans antialiased bg-[#F1F5FF]">

        @include('layouts.includes.admin.navigation')

        @include('layouts.includes.admin.sidebar')

        <div class="p-4 sm:ml-64">
            <div class="bg-white rounded-lg p-6 mt-14">
                <div class="flex items-center">
                    @include('layouts.includes.admin.breadcrumb')
                    @isset($action)
                        <div class="ml-auto">
                            {{ $action }}
                        </div>
                    @endisset
                </div>
    
                {{ $slot }}
            </div>
        </div>

        @stack('modals')

        {{-- Livewire / Scripts --}}
        @livewireScripts

        {{-- Flowbite --}}
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

        {{-- SweetAlert --}}
        @if (session('swal'))
            <script>
                Swal.fire(@json(session('swal')));
            </script>
        @endif

        <script>
            Livewire.on('swal', (data) => {
                Swal.free(data[0]);
            });
        </script>

        <script>
            forms = document.querySelectorAll('.delete-form');

            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "¡No podrás revertir esto!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, eliminar!",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>

        @stack('js')
    </body>
</html>
