@extends('layouts.comisionForm')

@section('title', 'Crear')

@section('back', route('espacio.trabajo', ['user_id'=>auth()->user()->user_id]))

@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-4/5 py-2 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Crear comisión</h1>
        </div>
    </div>

    <form action="{{ route('espacio.crear.process') }}" method="POST" x-data="formSubmit" @submit.prevent="submit">
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

                        <x-inputs.form-input
                                type="text"
                                inputName="com_title"
                        />

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
                            <x-slot name="forName">com_due</x-slot>
                            <x-slot name="title">Fecha de entrega</x-slot>
                            Cuando tenés que entregar el producto final
                        </x-inputs.label-form>

                        <x-inputs.form-input
                                type="date"
                                inputName="com_due"
                        />

                        @error('com_due')
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
                            >
                                <option value="">Elija una opción</option>
                                @foreach ( $social_media as $red )
                                    <option value="{{ $red->id_social }}" @selected( $red->id_social == old('social_fk')) >{{ $red->social_media_name }}</option>
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

                            <x-inputs.form-input
                                type="text"
                                inputName="com_client"
                            />

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
                            <x-slot name="forName">payment_fk</x-slot>
                            <x-slot name="title">Método de pago</x-slot>
                            Método de pago del cliente
                        </x-inputs.label-form>

                        <select
                            name="payment_fk"
                            id="payment_fk"
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
                            <option value="">Elija una opción</option>
                            @foreach ($metodos_pagos as $metodo)
                                <option value="{{ $metodo->id_payment_method }}" @selected( $metodo->id_payment_method == old('payment_fk'))>{{ $metodo->payment_method_name }}</option>
                            @endforeach
                        </select>

                        @error('payment_fk')
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
                            Los pasos a completar, separar con comas
                        </x-inputs.label-form>

                        <x-inputs.form-input
                                type="text"
                                inputName="com_tasks"
                        />

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
                x-ref="btn">Crear</button>
            </div>
        </div>
    </form>
@endsection
