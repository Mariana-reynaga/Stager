@extends('layouts.comisionForm')

@section('title', 'Editar Perfil')

@section('back')
    <div class="mt-10 ms-10">
        <a href="{{ route('user.profile', ['user_id'=>auth()->user()->user_id] ) }}" class="flex items-center">
            <img src="{{ url('/images/back_arrow.svg') }}" class="w-10" alt="Flecha negra que apunta a la izquierda.">
            <p class="ms-3 font-kanit font-semibold text-2xl text-negro" >Volver</p>
        </a>
    </div>
@endsection

@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-4/5 py-2 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Editar Perfil</h1>
        </div>
    </div>
@endsection
