@extends('layouts.comisionForm')

@section('title', 'Subir recibo')

@section('back', route('espacio.details', ['id'=>$comision->com_id]))

@section('content')
    <div class="mt-20 flex justify-center">
        <div class="w-4/5 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Añadir Comprobante</h1>
        </div>
    </div>

    <div class="mt-4 flex justify-center">
        <div class="w-4/5">
            <form action="{{ route('reciept.upload.process', ['id'=>$comision->com_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <x-inputs.label-form>
                    <x-slot name="forName">com_reciept</x-slot>
                    <x-slot name="title">Subir recibo</x-slot>
                    El recibo puede ser en formato pdf, jpg o png y pueden ser como máximo 2 MB.
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
                    type="file" name="com_reciept">

                @error('com_reciept')
                <div class="error-notice">
                    {{ $message }}
                </div>
                @enderror
                @error('com_reciept.*')
                <div class="error-notice">
                    {{ $message }}
                </div>
                @enderror

                <div class="flex w-full justify-center my-10 ">
                    <div class="w-4/5 flex justify-center">
                        <button
                        class="btn-principal w-1/3"
                        >Subir</button>
                    </div>
                </div>
            </form>


        </div>
    </div>

@endsection
