<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- tailwind --}}
    @vite('resources/css/app.css')

    {{-- Alpine --}}
    @vite(['resources/js/app.js'])

    <title>@yield('title')</title>
</head>
<body>
    <main>
        <div class="mt-10 ms-10">
            <a href="{{ route('espacio.trabajo', ['user_id'=>auth()->user()->user_id] ) }}" class="flex items-center">
                <img src="{{ url('/images/back_arrow.svg') }}" class="w-10" alt="Flecha negra que apunta a la izquierda.">
                <p class="ms-3 font-kanit font-semibold text-2xl text-negro" >Volver</p>
            </a>
        </div>

        <style>
            [x-cloak] { display: none !important; }
        </style>
        <div x-cloak x-data="{
            activeTab: @if (session('tabNum')) {{(int) session('tabNum')}} @else 1  @endif,
            active: 'mx-5 py-2 px-5 text-white rounded-t-lg bg-rclaro',
            inactive: 'mx-5 py-2 px-5 border-2 border-b-0 border-rclaro rounded-t-lg'
        }">
            <div class="flex flex-col items-center mt-5">

                <div class="w-4/5 flex justify-between border-b-2 border-rclaro">
                    @yield('content')

                    <div class="flex">
                        <p x-on:click="activeTab = 1" :class="activeTab === 1 ? active : inactive">Detalles</p>
                        <p x-on:click="activeTab = 2" :class="activeTab === 2 ? active : inactive">Tareas</p>
                        <p x-on:click="activeTab = 3" :class="activeTab === 3 ? active : inactive">Notas</p>
                        <p x-on:click="activeTab = 4" :class="activeTab === 4 ? active : inactive">Galeria</p>
                    </div>
                </div>

                <div class="w-full">
                    <div x-show="activeTab === 1" x-transition>
                        @yield('details')
                    </div>
                    <div x-show="activeTab === 2" x-transition>
                        @yield('tasks')
                    </div>
                    <div x-show="activeTab === 3" x-transition>
                        @yield('notes')
                    </div>
                    <div x-show="activeTab === 4" x-transition>
                        @yield('gallery')
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
