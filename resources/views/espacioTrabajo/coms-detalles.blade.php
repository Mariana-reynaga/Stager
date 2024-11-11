@extends('layouts.comision')

@section('title', 'Detalles')
                {{-- Aca iria la var con el titulo --}}
@section('section', 'titulo de comision')

@section('content')
    <div class="flex flex-col items-center w-full mt-10">
        <div class="flex justify-between font-kanit text-negro w-4/5 border-t-4 border-rclaro pt-5">
            <div class="w-1/2">
                <h2 class="text-xl text-rclaro">Descripción:</h2>
                <p>Esta es una descripcion de comision, es para mostrar como se ve en la pantalla de detalles.</p>
            </div>

            <div class="w-1/2 flex items-center">
                <h2 class="text-xl text-rclaro me-2">Fecha de entrega:</h2>
                <p>25/01/2024</p>
            </div>
        </div>

        <div class="w-1/2 flex justify-evenly">
            <a href="" class="btn-secundario">Eliminar</a>
            <a href="" class="btn-principal">Marcar como completado</a>
        </div>
    </div>

@endsection
