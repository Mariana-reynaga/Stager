@extends('layouts.Workspace')

@section('username', 'User12243')

@section('Content')
    <h1>Comisones completadas</h1>

    @foreach ($all_comisiones as $comision )
        <div class="bg-gray-300 p-3 rounded-sm w-60 h-60 flex flex-col mx-3 my-3">

            <h2 class="text-xl">{{ $comision->comm_title }}</h2>

            <div class="h-full flex flex-col justify-evenly">
                <p>{{ $comision->comm_short_desc }}</p>

                <p>Fecha de entrega : {{ $comision->due_date }}</p>

                <div class="flex justify-center">
                    <a href="" class="bg-gray-400 p-3 rounded-md">Ver más</a>
                </div>
            </div>
        </div>
    @endforeach
@endsection
