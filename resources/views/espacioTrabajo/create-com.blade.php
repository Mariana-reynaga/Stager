@extends('layouts.comisionForm')

@section('title', 'Crear')

@section('section', 'Crear comision')

@section('content')
    <form action="">
        <div class="flex w-full justify-center">
            <div class="flex justify-evenly w-4/5 mt-4">
                <div class="flex flex-col w-1/2">
                    {{-- Título de la comisión --}}
                    <div class="w-4/5">
                        <x-label-form>
                            <x-slot name="forName">titulo-com</x-slot>
                            <x-slot name="title">Título de la Comisión</x-slot>
                            Intenta que sea descriptivo y conciso
                        </x-label-form>

                        <input
                            type="text"
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
                        >
                    </div>

                    {{-- Descripción de la comisión --}}
                    <div class="w-4/5 mt-4">
                        <x-label-form>
                            <x-slot name="forName">descrip-com</x-slot>
                            <x-slot name="title">Descripción de la comisión</x-slot>
                            Describí la comisión en una oración
                        </x-label-form>

                        <textarea
                            name="descrip-com"
                            id="descrip-com"
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
                        ></textarea>
                    </div>

                    {{-- Fecha de entrega --}}
                    <div class="w-4/5 mt-4">
                        <x-label-form>
                            <x-slot name="forName">fecha-entrega</x-slot>
                            <x-slot name="title">Fecha de entrega</x-slot>
                            Cuando tenés que entregar el producto final
                        </x-label-form>

                        <input
                            type="date"
                            name="fecha-entrega"
                            id="fecha-entrega"
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
                    </div>
                </div>

                <div class="flex flex-col w-1/2">
                    <div class="flex justify-between">
                        {{-- Red social del cliente --}}
                        <div class="w-1/3">
                            <x-label-form>
                                <x-slot name="forName">contacto-cliente</x-slot>
                                <x-slot name="title">Red social</x-slot>
                                Método de comunicación con el cliente
                            </x-label-form>

                            <select
                                name="ontacto-cliente"
                                id="ontacto-cliente"
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
                            </select>
                        </div>

                        {{-- Username del cliente --}}
                        <div class="w-2/3 flex flex-col justify-between ms-3">
                            <x-label-form>
                                <x-slot name="forName">contacto-cliente</x-slot>
                                <x-slot name="title">Nombre de usuario</x-slot>
                                Nombre de usuario del cliente
                            </x-label-form>

                            <input
                                type="text"
                                name="comm_client"
                                id="comm_client"
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
                        </div>
                    </div>

                    {{-- Método de pago --}}
                    <div class="w-2/3 mt-4">
                        <x-label-form>
                            <x-slot name="forName">metodo-pago</x-slot>
                            <x-slot name="title">Método de pago</x-slot>
                            Método de pago del cliente
                        </x-label-form>

                        <select
                            name="metodo-pago"
                            id="metodo-pago"
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
                        </select>
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
