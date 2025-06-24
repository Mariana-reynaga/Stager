@extends('layouts.workspace')

@section('title', auth()->user()->name)

@section('sectionTitle', 'Comisiones en Proceso')

@section('content')
    <div class="mb-5 mt-52 md:mt-20 lg:ms-10 flex justify-center lg:justify-start flex-wrap gap-x-6 gap-y-8">
        @if ((count($coms_incompletas)) === 0)
            <div class="mt-5 flex justify-center items-center">
                <h3 class="font-kanit text-roscuro text-xl">Parece que no hay nada ....</h3>
            </div>
        @else
            @foreach ($coms_incompletas as $comision)
                <x-com_elements.tarjeta-comision>
                    <x-slot name="titulo">{{ $comision->com_title }}</x-slot>
                    <x-slot name="fecha_entrega">{{ $comision->com_due->format('d/m/Y') }}</x-slot>
                    <x-slot name="id_ruta">{{$comision->com_id}}</x-slot>

                    {{ $comision->com_description }}
                    <x-com_elements.progress-bar :percent="$comision->com_percent" />
                </x-com_elements.tarjeta-comision>

            @endforeach
        @endif
    </div>
@endsection
