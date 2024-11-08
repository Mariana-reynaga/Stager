@extends('layouts.Workspace')

@section('username', 'User12243')

@section('Content')
    <h1 class="text-2xl">Comisiones en Progreso</h1>


    <div class="mt-5 flex flex-wrap">
        @foreach ($all_comisiones as $comision )
            <div class="bg-gray-300 p-3 rounded-sm w-60 h-60 flex flex-col mx-3 my-3">

                <h2 class="text-xl">{{ $comision->comm_title }}</h2>

                <div class="h-full flex flex-col justify-evenly">
                    <p>{{ $comision->comm_short_desc }}</p>

                    <div class="flex">
                        <p class="me-2">Fecha de entrega</p>
                        <p> {{ $comision->due_date }}</p>
                    </div>

                    <div class="flex justify-center">
                        <a href="" class="bg-gray-400 p-3 rounded-md">Ver más</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
