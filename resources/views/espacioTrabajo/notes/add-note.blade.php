@extends('layouts.comisionForm')

@section('title', 'Añadir Notas')

@section('back', route('espacio.details', ['id'=>$comision->com_id]) )

@section('content')
    <div class="mt-20 flex justify-center">
        <div class="w-4/5 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Añadir Nota</h1>
        </div>
    </div>

    <form action="{{ route('note.add.process', ['id'=>$comision->com_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex w-full justify-center">
            <div class="w-4/5 mt-4">
                <div class="">
                    <x-inputs.label-form>
                        <x-slot name="forName">title</x-slot>
                        <x-slot name="title">título</x-slot>
                        título de la tarea
                    </x-inputs.label-form>

                    <x-inputs.form-input
                        type="text"
                        inputName="title"
                    />

                    @error('title')
                    <div class="error-notice">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-3">
                    <x-inputs.new-text-area
                        colName="note"
                        labelTitle="Nota"
                        labelTagline="¿Que te gustaria guardar?"
                        maxlength="300">

                        @error('note')
                            <div class="error-notice">
                                {{ $message }}
                            </div>
                        @enderror

                    </x-inputs.new-text-area>
                </div>

                <div class="mt-3">
                    <x-inputs.label-form>
                        <x-slot name="forName">pic_route</x-slot>
                        <x-slot name="title">Subir fotos</x-slot>
                        Subí las fotos que necesites como referencias. Solo podés subir formatos PNG, JPG y JPEG y pueden ser como máximo 2 MB.
                    </x-inputs.label-form>

                    <input class="
                        file:bg-rclaro
                        file:text-white
                        file:border-0
                        file:rounded-l-md
                        file:py-2
                        file:px-3
                        file:me-10
                        w-full text-lg text-gray-900 border border-gray-300 rounded-md focus:outline-none"
                        type="file" name="pic_route">

                        @error('pic_route')
                        <div class="error-notice">
                            {{ $message }}
                        </div>
                        @enderror

                        @error('pic_route.*')
                        <div class="error-notice">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
            </div>
        </div>

        <div class="my-10 flex w-full justify-center">
            <div class="w-4/5">
                <button class="w-1/3 btn-principal" x-ref="btn">Crear</button>
            </div>
        </div>
    </form>
@endsection
