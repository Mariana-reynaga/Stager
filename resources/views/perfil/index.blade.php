@extends('layouts.workspace')

@section('title', 'Perfil')

@section('content')
    <div class="flex justify-between items-center">
        <div class="ms-10 flex flex-wrap items-center gap-x-6 gap-y-8">
            <div class="h-20 w-20 bg-slate-400 rounded-full"></div>
            <p class="font-kanit font-semibold text-2xl text-negro">{{ auth()->user()->name }}</p>
        </div>

        <a href="" class="text-roscuro underline underline-offset-4">Editar perfil</a>
    </div>
@endsection
