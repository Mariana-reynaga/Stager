@extends('layouts.workspace')

@section('title', auth()->user()->name)

@section('sectionTitle', 'Comisiones en Proceso')

@section('content')
    <div class="mt-10 ms-10 flex flex-wrap gap-x-6 gap-y-8">
        @foreach ($coms_incompletas as $comision)
            <x-com_elements.tarjeta-comision>
                <x-slot name="titulo">{{ $comision->com_title }}</x-slot>
                <x-slot name="fecha_entrega">{{ $comision->com_entrega->format('d/m/Y') }}</x-slot>
                <x-slot name="id_ruta">{{$comision->com_id}}</x-slot>

                {{ $comision->com_description }}
                <x-com_elements.progress-bar :percent="$comision->com_percent" />
            </x-com_elements.tarjeta-comision>

        @endforeach

    </div>
@endsection
