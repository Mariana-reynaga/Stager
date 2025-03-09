@extends('layouts.comisionForm')

@section('title', 'Editar Perfil')

@section('back')
    <div class="mt-10 ms-10">
        <a href="{{ route('user.profile', ['user_id'=>auth()->user()->user_id] ) }}" class="flex items-center">
            <img src="{{ url('/images/back_arrow.svg') }}" class="w-10" alt="Flecha negra que apunta a la izquierda.">
            <p class="ms-3 font-kanit font-semibold text-2xl text-negro" >Volver</p>
        </a>
    </div>
@endsection

@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-4/5 py-2 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Editar Perfil</h1>
        </div>
    </div>

    <div class="flex justify-center">
        <div class="w-4/5">
            <div class="mt-5 flex justify-evenly">
                <h2 class="w-1/5 font-kanit font-semibold text-xl">Usuario:</h2>
                <div class="w-4/5 p-6 border-2 border-rclaro rounded-md">
                    <form action="{{ route('user.edit.process', ['user_id'=>$user->user_id]) }}" method="POST" x-data="formSubmit" @submit.prevent="submit">
                        @method('PUT')
                        @csrf
                        <div class="flex gap-x-3">
                            {{-- Nombre de usuario --}}
                            <div class="w-1/2">
                                <x-inputs.label-form>
                                    <x-slot name="forName">name</x-slot>
                                    <x-slot name="title">Nombre de usuario</x-slot>

                                </x-inputs.label-form>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
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
                                    value="{{ old('name', $user->name) }}"
                                >

                                @error('name')
                                    <div class="text-rclaro">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="w-1/2">
                                <x-inputs.label-form>
                                    <x-slot name="forName">email</x-slot>
                                    <x-slot name="title">E-mail</x-slot>

                                </x-inputs.label-form>

                                <input
                                    type="text"
                                    name="email"
                                    id="email"
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
                                    value="{{ old('email', $user->email) }}"
                                >

                                @error('email')
                                    <div class="text-rclaro">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn-principal" x-ref="btn">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-5 flex justify-evenly">
                <h2 class="w-1/5 font-kanit font-semibold text-xl">Contraseña:</h2>
                <div class="w-4/5 p-6 border-2 border-rclaro rounded-md">
                    <form action="{{ route('password.edit.process', ['user_id'=>$user->user_id]) }}" method="POST" x-data="formSubmit" @submit.prevent="submit">
                        @method('PUT')
                        @csrf
                        <div class="flex gap-x-3">
                            {{-- Contraseña 1 --}}
                            <div class="w-1/2">
                                <x-inputs.label-form>
                                    <x-slot name="forName">password</x-slot>
                                    <x-slot name="title">Contraseña</x-slot>

                                </x-inputs.label-form>

                                <div x-data="{type: true, hide: '/images/password_eyes/eye_closed.svg' , show:'/images/password_eyes/eye_open.svg' }" class="flex">
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

                        <div class="mt-5">
                            <button type="submit" class="btn-principal" x-ref="btn">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
