@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="w-full flex justify-center mt-20">
        <div class="h-fit">
            <a href="/">
                <img src="images/back_arrow.svg" class="w-20">
            </a>
        </div>

        <div class="w-1/2 flex flex-col items-center">
            <div class="border-solid border-2 border-negro p-3 rounded-md min-w-80 w-3/5">
                <h2 class="font-kanit text-xl text-negro ">Iniciar sesión</h2>

                <form action="{{ route('auth.login.process') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
                    @csrf

                    <div class="mt-5">
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
                        <button type="submit" class="btn-principal" x-ref="btn">Iniciar Sesión</button>
                    </div>
                </form>

                <div class="mt-6 flex justify-center text-negro font-kanit">
                    <x-links.nav-link route="auth.register.form">¿No tenés cuenta? Registrate ahora</x-links.nav-link>
                </div>

            </div>
        </div>
    </div>
@endsection
