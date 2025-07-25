@extends('layouts.comisionForm')

@section('title', 'Crear')

@section('back', route('espacio.trabajo', ['user_id'=>auth()->user()->user_id]))

@section('content')
    <div class="mt-20 flex justify-center">
        <div class="w-4/5 py-2 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Crear comisión</h1>
        </div>
    </div>

    <form action="{{ route('espacio.crear.process') }}" method="POST" x-data="formSubmit" @submit.prevent="submit">
        @csrf
        <div class="w-full flex justify-center">
            <div class="w-4/5 mt-4 flex flex-col lg:flex-row 2xl:justify-evenly gap-y-8 lg:gap-x-5 xl:gap-x-10">
                {{-- detalles --}}
                <div class="lg:w-1/2 flex flex-col gap-y-5">
                    <div class="mt-5 xl:mt-0 px-2 py-3 flex items-center bg-rclaro font-kanit text-lg text-blanco rounded-md">
                        <p class="ms-5 me-5 px-3 text-xl border-2 border-blanco rounded-2xl">1</p>
                        <p>Detalles de la comisión</p>
                    </div>
                    {{-- Título de la comisión --}}
                    <div class="">
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
                            <div class="error-notice">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Descripción de la comisión --}}
                    <div class="">
                        <x-inputs.new-text-area
                            colName="com_description"
                            labelTitle="Descripción de la comisión"
                            labelTagline="Describí la comisión brevemente"
                            maxlength="150">

                            @error('com_description')
                                <div class="error-notice">
                                    {{ $message }}
                                </div>
                            @enderror

                        </x-inputs.new-text-area>
                    </div>

                    {{-- Lista de tareas --}}
                    <div class="">
                        <x-inputs.label-form>
                            <x-slot name="forName">com_tasks</x-slot>
                            <x-slot name="title">Lista de tareas</x-slot>
                            Los pasos a completar, separar con comas
                        </x-inputs.label-form>

                        <textarea name="com_tasks" id="com_tasks" class="w-full h-32 xl:h-20 p-2 border border-solid border-gray-600 rounded-md focus:outline focus:outline-2 focus:outline-rclaro">{{ old('com_tasks') }}</textarea>

                        @error('com_tasks')
                        <div class="error-notice">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Fecha de entrega --}}
                    <div class="">
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
                            <div class="error-notice">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="lg:w-1/2 flex flex-col gap-y-5">
                    <div class="mt-5 xl:mt-0 px-2 py-3 flex items-center bg-rclaro font-kanit text-lg text-blanco rounded-md">
                        <p class="ms-5 me-5 px-3 text-xl border-2 border-blanco rounded-2xl">2</p>
                        <p>Detalles del cliente</p>
                    </div>
                    {{-- Cliente --}}
                    <div class="flex lg:flex-col xl:flex-row gap-x-4 lg:gap-x-0 lg:gap-y-5 xl:gap-x-4">
                        {{-- Red social del cliente --}}
                        <div class="w-1/2 lg:w-full">
                            <x-inputs.label-form>
                                <x-slot name="forName">social_fk</x-slot>
                                <x-slot name="title">Red social</x-slot>
                                Forma de comunicación con el cliente
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
                                <div class="error-notice">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Username del cliente --}}
                        <div class="w-1/2 lg:w-full flex flex-col">
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
                                <div class="error-notice">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-5 xl:mt-0 px-2 py-3 flex items-center bg-rclaro font-kanit text-lg text-blanco rounded-md">
                        <p class="ms-5 me-5 px-3 text-xl border-2 border-blanco rounded-2xl">3</p>
                        <p>Detalles del pago</p>
                    </div>
                    {{-- Método de pago --}}
                    <div class="">
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
                            <div class="error-notice">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Precio --}}
                    <div class="flex lg:flex-col xl:flex-row gap-x-4 lg:gap-x-0 lg:gap-y-5 xl:gap-x-4">
                        {{-- Moneda --}}
                        <div class="w-1/2 lg:w-full">
                            <x-inputs.label-form>
                                <x-slot name="forName">currency_id_fk</x-slot>
                                <x-slot name="title">Moneda</x-slot>
                                La moneda utilizada
                            </x-inputs.label-form>

                            <select
                                name="currency_id_fk"
                                id="currency_id_fk"
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
                                ">

                                <option value="">Elija una opción</option>
                                @foreach ( $currency as $coin )
                                    <option value="{{ $coin->id_payment_currency }}" @selected( $coin->id_payment_currency == old('currency_id_fk')) >{{ $coin->payment_currency_name }}</option>
                                @endforeach
                            </select>

                            @error('currency_id_fk')
                                <div class="error-notice">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- Precio --}}
                        <div class="w-1/2 lg:w-full">
                            <x-inputs.label-form>
                                <x-slot name="forName">com_price</x-slot>
                                <x-slot name="title">Precio</x-slot>
                                Precio de la comisión, sin puntos.
                            </x-inputs.label-form>

                            <div class="ps-2 flex items-center border border-solid border-gray-600 rounded-md focus:outline focus:outline-2 focus:outline-rclaro font-kanit">
                                <div class="text-lg">$</div>
                                <input type="number" name="com_price" id="com_price" value="{{ old('com_price') }}" class="ms-1 py-2 ps-2 pe-4 w-full rounded-r-md focus:outline focus:outline-2 focus:outline-rclaro">
                            </div>

                            @error('com_price')
                                <div class="error-notice">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-10 flex w-full justify-center">
            <div class="w-4/5 flex justify-center">
                <button class="w-1/3 btn-principal" x-ref="btn">Crear</button>
            </div>
        </div>
    </form>
@endsection
