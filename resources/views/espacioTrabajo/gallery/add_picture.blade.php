@extends('layouts.comisionForm')

@section('title', 'Añadir Fotos')

@section('back')
    <div class="mt-10 ms-10">
        <a href="{{ route( 'espacio.details', ['id'=>$comision->com_id] ) }}" class="flex items-center">
            <img src="{{ url('/images/back_arrow.svg') }}" class="w-10" alt="Flecha negra que apunta a la izquierda.">
            <p class="ms-3 font-kanit font-semibold text-2xl text-negro" >Volver</p>
        </a>
    </div>
@endsection

@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-4/5 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Añadir a Galeria</h1>
        </div>
    </div>

    <div class="mt-4 flex justify-center">
        <div class="w-4/5">
            <form action="{{route('picture.add.process', ['id'=>$comision->com_id])}}" method="POST" enctype="multipart/form-data">
                @csrf

                <x-inputs.label-form>
                    <x-slot name="forName">pic_route[]</x-slot>
                    <x-slot name="title">Subir fotos</x-slot>
                    Subi las fotos que necesites como referencias
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
                    type="file" name="pic_route[]" multiple>

                @error('pic_route')
                <div class="text-rclaro">
                    {{ $message }}
                </div>
                @enderror
                @error('pic_route.*')
                <div class="text-rclaro">
                    {{ $message }}
                </div>
                @enderror

                <div class="flex w-full justify-center my-10 ">
                    <div class="w-4/5 flex justify-center">
                        <button
                        class="btn-principal w-1/3"
                        >Crear</button>
                    </div>
                </div>
            </form>


        </div>
    </div>

@endsection
