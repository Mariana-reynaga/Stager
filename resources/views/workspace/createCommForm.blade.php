@extends('layouts.Form')

@section('title', 'Nueva Comision')

@section('form')
    <form action="{{ route('newComm.process') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" id="user_id" value="2">
        
        <div class="flex">
            <div class="w-1/3">
                {{-- titulo de la comision --}}
                <div class="mb-4">
                    <x-label-de-form>
                        <x-slot name="forName">comm_title</x-slot>
                        <x-slot name="title">Título de la comisión</x-slot>
                        Intenta que sea descriptivo y consiso
                    </x-label-de-form>

                    <div class="mt-3 h-2/5">
                        <input
                            class="border border-solid border-gray-600 rounded-md p-2 w-full"
                            type="text"
                            name="comm_title"
                            id="comm_title"
                            value="{{old('comm_title')}}"
                        >
                    </div>
                </div>

                {{-- Descripcion abreviada --}}
                <div class="mb-4">
                    <x-label-de-form>
                        <x-slot name="forName">comm_short_desc</x-slot>
                        <x-slot name="title">Descripción</x-slot>
                        Describí la comisión en una oración
                    </x-label-de-form>

                    <div class="mt-3 h-2/5">
                        <textarea
                            class="border border-solid border-gray-600 rounded-md p-2 w-full"
                            name="comm_short_desc"
                            id="comm_short_desc"
                            cols="30"
                            rows="3"></textarea>
                    </div>
                </div>

                {{-- Fecha de entrega --}}
                <div class="mb-4">
                    <x-label-de-form>
                        <x-slot name="forName">due_date</x-slot>
                        <x-slot name="title">Fecha de entrega</x-slot>
                        Cuando tenes que entregar el producto final
                    </x-label-de-form>

                    <div class="mt-3 h-2/5">
                        <input
                            class="border border-solid border-gray-600 rounded-md p-2 w-full"
                            type="date"
                            name="due_date"
                            id="due_date"
                        >
                    </div>
                </div>
            </div>

            <div class="w-2/3">
                <div class="mb-4">
                    <div class="flex justify-evenly">
                        <div class="">
                            <x-label-de-form>
                                <x-slot name="forName">comm_client_social</x-slot>
                                <x-slot name="title">Cliente</x-slot>
                                Metodo de comunicación con el cliente
                            </x-label-de-form>

                            <div class="mt-3 h-2/5">
                                <select
                                        class="border border-solid border-gray-600 rounded-md p-2 w-full"
                                        name="comm_client_social"
                                        id="comm_client_social"
                                        value="{{old('comm_client_social')}}"
                                >
                                    <option value="">Elija una opción</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="twitter / X">twitter / X</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Pixiv">Pixiv</option>
                                    <option value="Artstation">Artstation</option>
                                    <option value="Tumblr">Tumblr</option>
                                    <option value="Discord">Discord</option>
                                    <option value="Bluesky">Bluesky</option>
                                    <option value="Email">Email</option>
                                </select>
                            </div>

                        </div>

                        <div class="">
                            <x-label-de-form>
                                <x-slot name="forName">comm_client</x-slot>
                                <x-slot name="title">Handler del Cliente</x-slot>
                                El nombre / nombre de usuario que el cliente utiliza en esa plataforma
                            </x-label-de-form>

                            <div class="mt-3 h-2/5">
                                <input
                                    class="border border-solid border-gray-600 rounded-md p-2 w-full"
                                    type="text"
                                    name="comm_client"
                                    id="comm_client"
                                    value="{{old('comm_client')}}"
                                >
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <button type="submit" class="border-4 border-red-400 px-5 py-2 rounded-md text-xl">
            Crear
        </button>
    </form>
@endsection
