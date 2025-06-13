@extends('layouts.auth')

@section('title', 'Crear cuenta')

@section('content')
    <x-inputs.auth-card title="Crear Cuenta">
        <form action="{{ route('auth.register.process') }}" method="POST" x-data="formSubmit" @submit.prevent="submit">
            @csrf

            <div class="mt-5 mx-3">
                {{-- Nombre --}}
                <div class="flex flex-col">
                    <x-inputs.label-auth>
                        <x-slot name="forName">name</x-slot>
                        Nombre de usuario
                    </x-inputs.label-auth>

                    <x-inputs.form-input
                        type="text"
                        inputName="name"
                    />

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

                    <x-inputs.form-input
                        type="email"
                        inputName="email"
                    />

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

                    <div x-data="{type: true, hide: 'images/password_eyes/eye_closed.svg' , show:'images/password_eyes/eye_open.svg' }" class="h-12 flex">
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
                                focus:outline-rclaro"
                            name="password"
                            id="password"
                        >
                        <div class="w-1/6 flex justify-end" x-on:click="type ? type = false : type = true">
                            <img x-bind:src="type ? hide : show" alt="" class="p-2 bg-rclaro rounded-md">
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
                <button type="submit" class="btn-principal" x-ref="btn">Crear cuenta</button>
            </div>
        </form>

        <div class="mt-6 flex justify-center font-kanit font-medium text-rclaro underline underline-offset-4 hover:text-roscuro">
            <x-links.nav-link route="login">¿Ya tenés cuenta? Inicia sesión</x-links.nav-link>
        </div>
    </x-inputs.auth-card>
@endsection
