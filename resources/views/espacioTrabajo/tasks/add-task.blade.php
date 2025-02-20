@extends('layouts.comisionForm')

@section('title', 'Añadir Tarea')

@section('back')
    <div class="mt-10 ms-10">
        <a href="{{ route('espacio.trabajo', ['user_id'=>auth()->user()->user_id] ) }}" class="flex items-center">
            <img src="{{ url('/images/back_arrow.svg') }}" class="w-10" alt="Flecha negra que apunta a la izquierda.">
            <p class="ms-3 font-kanit font-semibold text-2xl text-negro" >Volver</p>
        </a>
    </div>
@endsection

@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-4/5 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Añadir tarea</h1>
        </div>
    </div>

    <form action="{{ route('task.add.process', ['id'=>$comision->com_id]) }}" method="POST">
        @csrf
        <div class="flex w-full justify-center">
            <div class="w-4/5 mt-4">
                <div class="">
                    <x-label-form>
                        <x-slot name="forName">com_tasks</x-slot>
                        <x-slot name="title">Nueva Tarea</x-slot>
                        Separar con comas sin espacios
                    </x-label-form>

                    <input
                        type="text"
                        name="com_tasks"
                        id="com_tasks"
                        class="
                            border
                            border-solid
                            border-gray-600
                            rounded-md
                            p-2
                            w-full
                            focus:outline
                            focus:outline-2
                            focus:outline-rclaro
                        "
                    >

                    @error('com_tasks')
                    <div class="text-rclaro">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex w-full justify-center my-10 ">
            <div class="w-4/5">
                <button
                class="btn-principal w-1/3"
                >Crear</button>
            </div>
        </div>
    </form>
@endsection
