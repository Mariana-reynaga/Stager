@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
    <x-inputs.auth-card title="Iniciar sesión">
        <form action="{{ route('auth.login.process') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
            @csrf

            <div class="mt-5 mx-3">
                {{-- Email --}}
                <div class="flex flex-col">
                    <x-inputs.label-auth>
                        <x-slot name="forName">email</x-slot>
                        Email
                    </x-inputs.label-auth>

                    <x-inputs.form-input
                        type="email"
                        inputName="email"
                    />

                    @error('email')
                        <div class="error-notice">
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
                            name="password"
                            id="password"
                            x-bind:type="type ? 'password' : 'text'"
                            class="
                                w-5/6
                                p-2
                                border
                                border-solid
                                border-gray-600
                                rounded-md
                                focus:outline
                                focus:outline-2
                                focus:outline-rclaro"
                        >

                        <div class="w-1/6 flex justify-end" x-on:click="type ? type = false : type = true">
                            <img x-bind:src="type ? hide : show" alt="" class="p-2 bg-rclaro rounded-md">
                        </div>
                    </div>

                    @error('password')
                        <div class="error-notice">
                            {{ $message }}
                        </div>
                    @enderror

                    @error('wrongpass')
                        <div class="error-notice">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-center">
                <button type="submit" class="btn-principal" x-ref="btn">Iniciar Sesión</button>
            </div>
        </form>

        <div class="mt-6 flex justify-center font-kanit font-medium text-rclaro underline underline-offset-4 hover:text-roscuro">
            <x-links.nav-link route="auth.register.form">¿No tenés cuenta? Registrate</x-links.nav-link>
        </div>
    </x-inputs.auth-card>
@endsection
