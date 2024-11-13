@extends('layouts.landing')

@section('title', 'Stager')

@section('content')
    {{-- banner the stager --}}
    <div class="flex items-center flex-col p-3 my-4 min-h-52">
    <div class=""></div>
    <p class="text-negro text-xl"><strong class="font-normal">organización</strong> para artistas</p>
    </div>

    {{-- que es stager --}}
    <div class="flex justify-center bg-roscuro my-16 p-6" id="descripcion">
    <div class="w-4/5 flex">
        {{-- descripción --}}
        <div class="flex flex-col w-1/2 me-3">
            <h2 class="text-blanco text-3xl mb-3 font-kanit font-bold">¿Qué es Stager?</h2>
            <p class="text-blanco my-3 font-kanit">Stager es una <strong class="font-normal">solución</strong> para todos los artistas que hacen trabajo <strong class="font-normal">freelance</strong> y tienen dificultades para <strong class="font-normal">llegar a tiempo</strong>.</p>

            <p class="text-blanco my-3 font-kanit">Con su diseño sencillo pero atractivo, buscamos ofrecer un ambiente que promueve la creatividad y organización para todo tipo de artistas.</p>
        </div>

        {{-- foto --}}
        <div class="w-1/2 ms-3 flex justify-center">
            <div class="w-2/3 h-full bg-slate-300"></div>
        </div>
    </div>
    </div>

    {{-- beneficios de stager --}}
    <div class="flex justify-center my-20" id="beneficios">
    <div class="w-4/5 flex flex-col items-center">
        <h2 class="text-negro text-3xl font-kanit font-bold">Beneficios</h2>

        {{-- beneficios --}}
        <div class="flex flex-col md:grid md:grid-cols-2 md:gap-x-12 md:gap-y-6 xl:flex xl:flex-row xl:justify-evenly xl:w-full mt-12">

            <x-beneficio-card>
                <x-slot name="titulo">Conveniencia</x-slot>
                Todos los detalles en un lugar
            </x-beneficio-card>

            <x-beneficio-card>
                <x-slot name="titulo">Simpleza</x-slot>
                Todos los detalles en un lugar
            </x-beneficio-card>

            <x-beneficio-card>
                <x-slot name="titulo">Para artistas</x-slot>
                Todos los detalles en un lugar
            </x-beneficio-card>

            <x-beneficio-card>
                <x-slot name="titulo">Gran comunidad</x-slot>
                Todos los detalles en un lugar
            </x-beneficio-card>


        </div>

    </div>
    </div>

    {{-- call to action --}}
    <div class="my-16 flex justify-center">
    <div class="w-4/5 bg-roscuro p-6">
        <div class="flex justify-center">
            <div class="flex flex-col items-center w-1/2">
                <h3 class="text-blanco font-kanit font-bold text-xl">¡Toma control del show!</h3>
                <a
                    href="{{ route('auth.register.form') }}"
                    class="
                        px-6 py-3
                        bg-blanco
                        text-negro
                        rounded-lg
                        font-kanit
                        font-extrabold
                        my-3"
                >Crea tu cuenta</a>
            </div>

            <div class="w-1/2 flex justify-center">
                <div class="bg-slate-200 w-4/5 h-full"></div>
            </div>
        </div>
    </div>

    </div>

    <div class="my-20">
    </div>
@endsection

