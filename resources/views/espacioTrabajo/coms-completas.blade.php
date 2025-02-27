@extends('layouts.workspace')

@section('title', auth()->user()->name)

@section('section', 'Comisiones Completas')

@section('content')
    <div class="mt-10 ms-10 flex flex-wrap gap-x-6 gap-y-8">

        @foreach ($coms_completas as $comision)
            <x-tarjeta-comision>
                <x-slot name="titulo">{{ $comision->com_title }}</x-slot>
                <x-slot name="fecha_entrega"> <span class="text-roscuro font-extrabold">Completada</span> </x-slot>
                <x-slot name="id_ruta">{{$comision->com_id}}</x-slot>
                {{ $comision->com_description }}
                <x-progress-bar :percent="$comision->com_percent" />
            </x-tarjeta-comision>
        @endforeach

    </div>
@endsection
