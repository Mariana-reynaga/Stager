@extends('layouts.comisionForm')

@section('title', 'Crear')

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
        <div class="w-4/5 py-2 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Crear comision</h1>
        </div>
    </div>

    <form action="{{ route('espacio.crear.process') }}" method="POST">
        @csrf
        <div class="flex w-full justify-center">
            <div class="flex justify-evenly w-4/5 mt-4">
                <div class="flex flex-col w-1/2">
                    {{-- Título de la comisión --}}
                    <div class="w-4/5">
                        <x-inputs.label-form>
                            <x-slot name="forName">com_title</x-slot>
                            <x-slot name="title">Título de la Comisión</x-slot>
                            Intenta que sea descriptivo y conciso
                        </x-inputs.label-form>

                        <input
                            type="text"
                            name="com_title"
                            id="com_title"
                            class="
                                border
                                border-solid
                                border-gray-600
                                rounded-md
                                p-2
                                w-full
                                focus:outline
                                focus:outline-2
                                focus:outline-rclaro"
                            value={{ old('com_title') }}
                        >

                        @error('com_title')
                            <div class="text-rclaro">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Descripción de la comisión --}}
                    <div class="w-4/5 mt-4">
                        <x-inputs.new-text-area
                            colName="com_description"
                            labelTitle="Descripción de la comisión"
                            labelTagline="Describí la comisión brevemente"
                            maxlength="150">

                            @error('com_description')
                                <div class="text-rclaro">
                                    {{ $message }}
                                </div>
                            @enderror

                        </x-inputs.new-text-area>
                    </div>

                    {{-- Fecha de entrega --}}
                    <div class="w-4/5 mt-4">
                        <x-inputs.label-form>
                            <x-slot name="forName">com_entrega</x-slot>
                            <x-slot name="title">Fecha de entrega</x-slot>
                            Cuando tenés que entregar el producto final
                        </x-inputs.label-form>

                        <input
                            type="date"
                            name="com_entrega"
                            id="com_entrega"
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
                            value={{ old('com_entrega') }}
                        >

                        @error('com_entrega')
                            <div class="text-rclaro">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col w-1/2">
                    <div class="flex justify-between">
                        {{-- Red social del cliente --}}
                        <div class="w-1/3">
                            <x-inputs.label-form>
                                <x-slot name="forName">social_fk</x-slot>
                                <x-slot name="title">Red social</x-slot>
                                Método de comunicación con el cliente
                            </x-inputs.label-form>

                            <select
                                name="social_fk"
                                id="social_fk"
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
                                value={{ old('social_fk') }}
                            >
                                <option value="">Elija una opción</option>
                                @foreach ( $redes_sociales as $red )
                                    <option value="{{ $red->id_social }}">{{ $red->red_social }}</option>
                                @endforeach
                            </select>

                            @error('social_fk')
                                <div class="text-rclaro">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Username del cliente --}}
                        <div class="w-2/3 flex flex-col justify-between ms-3">
                            <x-inputs.label-form>
                                <x-slot name="forName">com_client</x-slot>
                                <x-slot name="title">Nombre de usuario</x-slot>
                                Nombre de usuario del cliente
                            </x-inputs.label-form>

                            <input
                                type="text"
                                name="com_client"
                                id="com_client"
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
                                value={{ old('com_client') }}
                            >

                            @error('com_client')
                                <div class="text-rclaro">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Método de pago --}}
                    <div class="w-2/3 mt-4">
                        <x-inputs.label-form>
                            <x-slot name="forName">pagos_fk</x-slot>
                            <x-slot name="title">Método de pago</x-slot>
                            Método de pago del cliente
                        </x-inputs.label-form>

                        <select
                            name="pagos_fk"
                            id="pagos_fk"
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
                            value={{ old('pagos_fk') }}
                        >
                            <option value="">Elija una opción</option>
                            @foreach ($metodos_pagos as $metodo)
                                <option value="{{ $metodo->id_metodo_pago }}">{{ $metodo->metodo_pago }}</option>
                            @endforeach
                        </select>

                        @error('pagos_fk')
                            <div class="text-rclaro">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Lista de tareas --}}
                    <div class="w-2/3 mt-4">
                        <x-inputs.label-form>
                            <x-slot name="forName">com_tasks</x-slot>
                            <x-slot name="title">Lista de tareas</x-slot>
                            Los pasos a completar, separar con comas sin espacios
                        </x-inputs.label-form>

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
                                value={{ old('com_tasks') }}
                            >

                            @error('com_tasks')
                            <div class="text-rclaro">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                </div>

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
@endsection
