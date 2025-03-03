@extends('layouts.auth')

@section('title', 'Crear cuenta')

@section('content')
    <div class="w-full flex justify-center mt-20">
        <div class="h-fit">
            <a href="/">
                <div class="bg-slate-200 w-16 h-16 rounded-3xl"></div>
            </a>
        </div>

        <div class="w-1/2 flex flex-col items-center">
            <div class="border-solid border-2 border-negro p-3 rounded-md min-w-80 w-3/5">
                <h2 class="font-kanit text-xl text-negro ">Crear Cuenta</h2>
                <form action="{{ route('auth.register.process') }}" method="POST">
                    @csrf

                    <div class="mt-5">
                        {{-- Nombre --}}
                        <div class="flex flex-col">
                            <x-inputs.label-auth>
                                <x-slot name="forName">name</x-slot>
                                Nombre de usuario
                            </x-inputs.label-auth>

                            <input
                                name="name"
                                id="name"
                                type="string"
                                class="
                                    border
                                    border-solid
                                    border-gray-600
                                    rounded-md
                                    p-2
                                    w-full
                                    focus:outline
                                    focus:outline-2
                                    focus:outline-blanco
                                "
                                value="{{old('name')}}"
                            >
                            @error('name')
                                <div class="text-rclaro">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="flex flex-col mt-5">
                            <x-inputs.label-auth>
                                <x-slot name="forName">email</x-slot>
                                Email
                            </x-inputs.label-auth>

                            <input
                                name="email"
                                id="email"
                                type="email"
                                class="
                                    border
                                    border-solid
                                    border-gray-600
                                    rounded-md
                                    p-2
                                    w-full
                                    focus:outline
                                    focus:outline-2
                                    focus:outline-blanco
                                "

                                value="{{old('email')}}"
                            >
                            @error('email')
                                <div class="text-rclaro">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Contraseña --}}
                        <div class="flex flex-col mt-5">
                            <x-inputs.label-auth>
                                <x-slot name="forName">password</x-slot>
                                Contraseña
                            </x-inputs.label-auth>

                            <div x-data="{type: true, hide: 'images/password_eyes/eye_closed.svg' , show:'images/password_eyes/eye_open.svg' }" class="flex">
                                <input
                                    x-bind:type="type ? 'password' : 'text'"
                                    class="
                                        border
                                        border-solid
                                        border-gray-600
                                        rounded-md
                                        p-2
                                        w-full
                                        focus:outline
                                        focus:outline-2
                                        focus:outline-blanco
                                    "
                                    name="password"
                                    id="password"
                                >
                                
                                <div class="w-1/6 flex justify-end" x-on:click="type ? type = false : type = true">
                                    <img x-bind:src="type ? hide : show" alt="" class="w-1/2 p-2 bg-slate-400 rounded-md">
                                </div>
                            </div>


                            @error('password')
                                <div class="text-rclaro">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-center">
                        <button type="submit" class="btn-principal">Crear cuenta</button>
                    </div>

                    <div class="mt-6 flex justify-center text-negro font-kanit">
                        <x-links.nav-link route="login">¿Ya tenés cuenta? Inicia sesión</x-links.nav-link>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
