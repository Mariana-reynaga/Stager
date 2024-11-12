@extends('layouts.workspace')

@section('title', 'Nom de user')

@section('section', 'Comisiones en Proceso')

@section('content')
    <div class="mt-10 ms-10 flex flex-wrap gap-x-6 gap-y-8">
        {{-- @for ($x = 0; $x <= 5; $x++)
            <x-tarjeta-comision>
                <x-slot name="titulo">Un titulo</x-slot>
                <x-slot name="fecha_entrega">12/04/2024</x-slot>
                esta es una comision de ejemplo, y esta es una descripción de ejemplo para poder ver las tarjetas.
            </x-tarjeta-comision>

        @endfor --}}

        @foreach ($coms_incompletas as $comision)
            <x-tarjeta-comision>
                <x-slot name="titulo">{{ $comision->com_title }}</x-slot>
                <x-slot name="fecha_entrega">{{ $comision->com_entrega->format('d/m/Y') }}</x-slot>
                {{ $comision->com_description }}
            </x-tarjeta-comision>
        @endforeach

    </div>
@endsection
