@extends('layouts.comision')

@section('title', 'Detalles')
                {{-- Aca iria la var con el titulo --}}
@section('section', $comision->com_title)

@section('content')
    <div class="flex flex-col items-center w-full mt-10">
        <div class="flex justify-between font-kanit text-negro w-4/5 border-t-4 border-rclaro pt-5">
            <div class="w-1/2">
                <h2 class="text-xl text-rclaro">Descripción:</h2>
                <p>{{ $comision->com_description }}</p>
            </div>

            <div class="w-1/2 flex items-center">
                <h2 class="text-xl text-rclaro me-2">Fecha de entrega:</h2>
                @if ($comision->is_complete == false)
                    <p>{{ $comision->com_entrega->format('d/m/Y') }}</p>
                @else
                    <p>Completada</p>
                @endif
            </div>
        </div>

        <div class="w-1/2 flex justify-evenly mt-10">
            <a href="" class="btn-secundario">Eliminar</a>

            @if ($comision->is_complete == false)
                <a href="" class="btn-principal">Marcar como completado</a>
            @endif
        </div>
    </div>

@endsection
