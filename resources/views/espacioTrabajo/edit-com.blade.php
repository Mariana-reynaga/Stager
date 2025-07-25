@extends('layouts.comisionForm')

@section('title', 'Editar')

@section('back', route('espacio.details', ['id'=>$comision->com_id]))

@section('content')
    <div class="mt-24 flex justify-center">
        <div class="w-4/5 py-2 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Editar {{ $comision->com_title }}</h1>
        </div>
    </div>

    <form action="{{ route('espacio.edit.process', ['id'=> $comision->com_id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="flex w-full justify-center">
            <div class="w-4/5 mt-4 flex flex-col lg:flex-row 2xl:justify-evenly gap-y-8 lg:gap-x-5 xl:gap-x-10">
                <div class="lg:w-1/2 lg:h-fit pb-4 flex flex-col gap-y-5 bg-white rounded-md shadow-md shadow-negro/30">
                    <div class="xl:mt-0 px-2 py-3 flex items-center bg-rclaro font-kanit text-lg text-blanco rounded-t-md">
                        <p class="ms-5 me-5 px-[0.85rem] py-[0.20rem] text-xl border-2 border-blanco rounded-full">1</p>
                        <p>Detalles de la comisión</p>
                    </div>
                    {{-- Título de la comisión --}}
                    <div class="px-4">
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
                            value="{{ old('com_title', $comision->com_title) }}"
                        >

                        @error('com_title')
                            <div class="error-notice">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Descripción de la comisión --}}
                    <div class="px-4">
                        <x-inputs.edit-text-area
                            colName="com_description"
                            labelTitle="Descripción de la comisión"
                            labelTagline="Describí la comisión brevemente"
                            maxlength="150"
                            :colPastData="$comision->com_description">
                            @error('com_description')
                                <div class="error-notice">
                                    {{ $message }}
                                </div>
                            @enderror
                        </x-inputs.edit-text-area>
                    </div>

                    {{-- Fecha de entrega --}}
                    <div class="px-4">
                        <x-inputs.label-form>
                            <x-slot name="forName">com_due</x-slot>
                            <x-slot name="title">Fecha de entrega</x-slot>
                            Cuando tenés que entregar el producto final
                        </x-inputs.label-form>

                        <input
                            type="date"
                            name="com_due"
                            id="com_due"
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
                            value="{{ old('com_due', $comision->com_due->format('Y-m-d')) }}"
                        >

                        @error('com_due')
                            <div class="error-notice">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="lg:w-1/2 flex flex-col gap-y-5">
                    <div class="bg-white rounded-md shadow-md shadow-negro/30">
                        <div class="xl:mt-0 px-2 py-3 flex items-center bg-rclaro font-kanit text-lg text-blanco rounded-t-md">
                            <p class="ms-5 me-5 px-3 py-[0.20rem] text-xl border-2 border-blanco rounded-full">2</p>
                            <p>Detalles del cliente</p>
                        </div>
                        {{-- Detalles del cliente --}}
                        <div class="px-4 py-4 flex lg:flex-col xl:flex-row gap-x-4 lg:gap-x-0 lg:gap-y-5 xl:gap-x-4">
                            {{-- Red social del cliente --}}
                            <div class="w-1/2 lg:w-full">
                                <x-inputs.label-form>
                                    <x-slot name="forName">social_fk</x-slot>
                                    <x-slot name="title">Red social</x-slot>
                                    Método de comunicación con el cliente
                                </x-inputs.label-form>

                                <select name="social_fk" id="social_fk" class="border border-solid border-gray-600 rounded-md p-2 w-full focus:outline focus:outline-2 focus:outline-rclaro">
                                    <option value="">Elija una opción</option>
                                    @foreach ( $social_media as $red )
                                        <option
                                            value="{{ $red->id_social }}"
                                            @selected($red->id_social == old('social_fk', $comision->social_fk))
                                        >{{ $red->social_media_name }}</option>
                                    @endforeach
                                </select>

                                @error('social_fk')
                                    <div class="error-notice">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Username del cliente --}}
                            <div class="w-1/2 lg:w-full flex flex-col justify-between">
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
                                    value={{ old('com_client', $comision->com_client) }}
                                >

                                @error('com_client')
                                    <div class="error-notice">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-md shadow-md shadow-negro/30">
                        <div class="xl:mt-0 px-2 py-3 flex items-center bg-rclaro font-kanit text-lg text-blanco rounded-t-md">
                            <p class="ms-5 me-5 px-3 py-[0.20rem] text-xl border-2 border-blanco rounded-full">3</p>
                            <p>Detalles del pago</p>
                        </div>

                        {{-- Método de pago --}}
                        <div class="px-4 pb-4 pt-6 ">
                            <x-inputs.label-form>
                                <x-slot name="forName">payment_fk</x-slot>
                                <x-slot name="title">Método de pago</x-slot>
                                Método de pago del cliente
                            </x-inputs.label-form>

                            <select name="payment_fk" id="payment_fk" class=" border border-solid border-gray-600 rounded-md p-2 w-full focus:outline focus:outline-2 focus:outline-rclaro">
                                <option value="">Elija una opción</option>
                                @foreach ($metodos_pagos as $metodo)
                                    <option value="{{ $metodo->id_payment_method }}" @selected($metodo->id_payment_method == old('payment_fk', $comision->payment_fk))
                                    >{{ $metodo->payment_method_name }}</option>
                                @endforeach
                            </select>

                            @error('payment_fk')
                                <div class="error-notice">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Precio --}}
                        <div class="px-4 py-4 flex gap-x-4">
                            {{-- Moneda --}}
                            <div class="w-1/2 lg:w-full lg:flex lg:flex-col lg:justify-between">
                                <x-inputs.label-form>
                                    <x-slot name="forName">currency_id_fk</x-slot>
                                    <x-slot name="title">Moneda</x-slot>
                                    La moneda utilizada
                                </x-inputs.label-form>

                                <select name="currency_id_fk" id="currency_id_fk" class=" border border-solid border-gray-600 rounded-md p-2 w-full focus:outline focus:outline-2 focus:outline-rclaro">
                                    <option value="">Elija una opción</option>
                                    @foreach ( $currency as $coin )
                                        <option value="{{ $coin->id_payment_currency }}" @selected($coin->id_payment_currency == old('currency_id_fk', $comision->currency_id_fk)) >{{ $coin->payment_currency_name }}</option>
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
                                    <input type="number" name="com_price" id="com_price" class="ms-1 py-2 ps-2 pe-4 w-full rounded-r-md focus:outline focus:outline-2 focus:outline-rclaro" value={{ old('com_price', $comision->com_price) }}>
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
        </div>

        <div class="my-10 flex w-full justify-center">
            <div class="w-4/5 flex justify-center">
                <button class="w-1/3 btn-principal" x-ref="btn">Guardar</button>
            </div>
        </div>
    </form>
@endsection
