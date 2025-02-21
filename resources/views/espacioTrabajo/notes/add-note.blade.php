@extends('layouts.comisionForm')

@section('title', 'Añadir Notas')

@section('back')
    <div class="mt-10 ms-10">
        <a href="{{ route('espacio.details', ['id'=>$comision->com_id] ) }}" class="flex items-center">
            <img src="{{ url('/images/back_arrow.svg') }}" class="w-10" alt="Flecha negra que apunta a la izquierda.">
            <p class="ms-3 font-kanit font-semibold text-2xl text-negro" >Volver</p>
        </a>
    </div>
@endsection

@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-4/5 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Añadir Nota</h1>
        </div>
    </div>

    <form action="{{ route('note.add.process', ['id'=>$comision->com_id]) }}" method="POST">
        @csrf
        <div class="flex w-full justify-center">
            <div class="w-4/5 mt-4">
                <div class="">
                    <x-label-form>
                        <x-slot name="forName">note_title</x-slot>
                        <x-slot name="title">Titulo</x-slot>
                        título de la tarea
                    </x-label-form>

                    <input
                        type="text"
                        name="note_title"
                        id="note_title"
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

                    @error('note_title')
                    <div class="text-rclaro">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-3">
                    <x-label-form>
                        <x-slot name="forName">note_content</x-slot>
                        <x-slot name="title">Nota</x-slot>
                        ¿Que te gustaria guardar?
                    </x-label-form>

                    <textarea
                        name="note_content"
                        id="note_content"
                        cols="30"
                        rows="5"
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
                    ></textarea>

                    @error('note_content')
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
