@extends('layouts.comision')

@section('title', 'Crear')

{{-- @section('section', 'Crear comision') --}}

@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-4/5">
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
                        <x-label-form>
                            <x-slot name="forName">com_title</x-slot>
                            <x-slot name="title">Título de la Comisión</x-slot>
                            Intenta que sea descriptivo y conciso
                        </x-label-form>

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
                        <x-label-form>
                            <x-slot name="forName">com_description</x-slot>
                            <x-slot name="title">Descripción de la comisión</x-slot>
                            Describí la comisión en una oración
                        </x-label-form>

                        <textarea
                            name="com_description"
                            id="com_description"
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
                                focus:outline-rclaro"
                        >{{ old('com_description') }}</textarea>

                        @error('com_description')
                            <div class="text-rclaro">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Fecha de entrega --}}
                    <div class="w-4/5 mt-4">
                        <x-label-form>
                            <x-slot name="forName">com_entrega</x-slot>
                            <x-slot name="title">Fecha de entrega</x-slot>
                            Cuando tenés que entregar el producto final
                        </x-label-form>

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
                            <x-label-form>
                                <x-slot name="forName">social_fk</x-slot>
                                <x-slot name="title">Red social</x-slot>
                                Método de comunicación con el cliente
                            </x-label-form>

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
                            <x-label-form>
                                <x-slot name="forName">com_client</x-slot>
                                <x-slot name="title">Nombre de usuario</x-slot>
                                Nombre de usuario del cliente
                            </x-label-form>

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
                        <x-label-form>
                            <x-slot name="forName">pagos_fk</x-slot>
                            <x-slot name="title">Método de pago</x-slot>
                            Método de pago del cliente
                        </x-label-form>

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
                        <x-label-form>
                            <x-slot name="forName">com_tasks</x-slot>
                            <x-slot name="title">Lista de tareas</x-slot>
                            Los pasos a completar, separar con comas sin espacios
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
