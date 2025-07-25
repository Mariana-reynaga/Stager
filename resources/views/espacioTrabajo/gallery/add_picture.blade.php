@extends('layouts.comisionForm')

@section('title', 'Añadir Fotos')

@section('back', route('espacio.details', ['id'=>$comision->com_id]))

@section('content')
    <div class="mt-24 flex justify-center">
        <div class="w-4/5 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Añadir a Galeria</h1>
        </div>
    </div>

    <div class="mt-4 flex justify-center">
        <div class="w-4/5">
            <form action="{{route('picture.add.process', ['id'=>$comision->com_id])}}" method="POST" enctype="multipart/form-data" >
                @csrf

                <div class="p-4 bg-white rounded-md shadow-md shadow-negro/30">
                    <x-inputs.label-form>
                        <x-slot name="forName">pic_route[]</x-slot>
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
                        type="file" name="pic_route[]" multiple onchange="loadFile(event)"
                    >

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

                    <div class="mt-10 grid grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-3 gap-y-4" id="output">
                        <script>
                            const img = (src) => `<img src=${src} class="h-52 w-full object-cover object-top rounded-md shadow-md shadow-negro/30" />`;

                            var loadFile = function (event) {
                                var output = document.getElementById('output');
                                output.innerHTML = '';

                                [...event.target.files].forEach(
                                (file) => (output.innerHTML += img(URL.createObjectURL(file)))
                                );
                            };
                        </script>
                    </div>

                </div>

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
