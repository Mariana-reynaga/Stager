@extends('layouts.comisionForm')

@section('title', 'Editar Nota')

@section('back', route('espacio.details', ['id'=>$comision->com_id]))

@section('content')
    <div class="mt-20 flex justify-center">
        <div class="w-4/5 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Editar Nota</h1>
        </div>
    </div>

    <form action="{{ route('note.edit.process', ['id'=>$comision->com_id]) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="noteId" id="noteId" value="{{$noteId}}" >

        <div class="flex w-full justify-center">
            <div class="w-4/5 mt-4">
                <div class="mt-3">
                    <x-inputs.label-form>
                        <x-slot name="forName">title</x-slot>
                        <x-slot name="title">título</x-slot>
                        título de la nota
                    </x-inputs.label-form>

                    <input
                        type="text"
                        name="title"
                        id="title"
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
                        value="{{ old('title', $noteDets->title) }}"
                    >

                    @error('title')
                    <div class="error-notice">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-3">
                    <x-inputs.edit-text-area
                            colName="note"
                            labelTitle="Nota"
                            labelTagline="¿Que te gustaria guardar?"
                            maxlength="300"
                            :colPastData="$noteDets->note">
                            @error('note')
                                <div class="error-notice">
                                    {{ $message }}
                                </div>
                            @enderror
                    </x-inputs.edit-text-area>
                </div>
            </div>
        </div>

        <div class="flex w-full justify-center my-10 ">
            <div class="w-4/5">
                <button class="w-1/3 btn-principal" x-ref="btn">Guardar</button>
            </div>
        </div>
    </form>
@endsection
