@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="w-full flex justify-center mt-20">
        <div class="h-fit">
            <a href="/">
                <div class="bg-slate-200 w-16 h-16 rounded-3xl"></div>
            </a>
        </div>

        <div class="w-1/2 flex flex-col items-center">
            <div class="bg-roscuro p-3 rounded-md min-w-80 w-3/5">
                <h2 class="font-kanit font-xl text-blanco ">¡Bienvenido a Stager!</h2>
                <form action="">
                    @csrf

                    <div class="mt-5">
                        {{-- Email --}}
                        <div class="flex flex-col">
                            <x-label-auth>
                                <x-slot name="forName">email</x-slot>
                                Email
                            </x-label-auth>

                            <input
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
                            >
                        </div>

                        {{-- Contraseña --}}
                        <div class="flex flex-col mt-5">
                            <x-label-auth>
                                <x-slot name="forName">password</x-slot>
                                Contraseña
                            </x-label-auth>

                            <input
                                type="password"
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
                            >
                        </div>
                    </div>

                    <div class="mt-6 flex justify-center">
                        <button type="submit" class="btn-secundario">Crear cuenta</button>
                    </div>

                    <div class="mt-6 flex justify-center text-blanco font-kanit">
                        <x-nav-link route="login">¿Ya tenés cuenta? Inicia sesión</x-nav-link>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
