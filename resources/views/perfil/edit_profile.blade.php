@extends('layouts.comisionForm')

@section('title', 'Editar Perfil')

@section('back', route('user.profile', ['user_id'=>auth()->user()->user_id]))

@section('content')
    <div class="mt-20 flex justify-center">
        <div class="w-4/5 py-2 border-b-2 border-rclaro">
            <h1 class="font-kanit font-semibold text-2xl text-negro">Editar Perfil</h1>
        </div>
    </div>

    <div class="mb-5 flex justify-center">
        <div class="w-4/5 flex flex-col gap-y-5">
            <div class="mt-5 flex flex-col lg:flex-row lg:justify-evenly">
                <h2 class="w-1/5 font-kanit font-semibold text-xl">Usuario:</h2>
                <div class="mt-2 lg:w-4/5 p-6 border-2 border-rclaro rounded-md">
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

            <div class="flex flex-col lg:flex-row lg:justify-evenly">
                <h2 class="w-1/5 font-kanit font-semibold text-xl">Contraseña:</h2>
                <div class="mt-2 lg:w-4/5 p-6 border-2 border-rclaro rounded-md">
                    <form action="{{ route('password.edit.process', ['user_id'=>$user->user_id]) }}" method="POST" x-data="formSubmit" @submit.prevent="submit">
                        @method('PUT')
                        @csrf
                        <div class="flex flex-col gap-x-3">
                            <x-inputs.label-form>
                                <x-slot name="forName">password</x-slot>
                                <x-slot name="title">Contraseña</x-slot>

                            </x-inputs.label-form>

                            <div x-data="{type: true, hide: '/images/password_eyes/eye_closed.svg' , show:'/images/password_eyes/eye_open.svg' }" class="xl:w-2/3 2xl:w-3/5 flex justify-between">
                                <input
                                    name="password"
                                    id="password"
                                    x-bind:type="type ? 'password' : 'text'"
                                    class="
                                        h-12
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

                                <div class="w-1/6 h-12 md:w-12 flex justify-end" x-on:click="type ? type = false : type = true">
                                    <img x-bind:src="type ? hide : show" alt="" class=" p-2 bg-rclaro rounded-md">
                                </div>
                            </div>

                            @error('password')
                                <div class="text-rclaro">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn-principal" x-ref="btn">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row lg:justify-evenly">
                <h2 class="w-2/3 lg:w-1/5 font-kanit font-semibold text-xl">Foto de perfil:</h2>
                <div class="lg:w-4/5 mt-2 p-6 border-2 border-rclaro rounded-md">
                    <form action="{{ route('user.image.edit', ['user_id'=>$user->user_id]) }}" method="POST" x-data="formSubmit" @submit.prevent="submit" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="">
                            <x-inputs.label-form>
                                <x-slot name="forName">user_image</x-slot>
                                <x-slot name="title">Foto de perfil</x-slot>

                            </x-inputs.label-form>

                            @if ($user->user_image)
                                <div class="my-5">
                                    <img src="/storage/{{ $user->user_image }}" alt="">
                                </div>
                            @endif

                            <input class="
                                file:bg-rclaro
                                file:text-white
                                file:border-0
                                file:rounded-l-md
                                file:py-2
                                file:px-3
                                file:me-10
                                w-full text-lg text-gray-900 border border-gray-300 rounded-md focus:outline-none"
                                type="file" name="user_image" id="user_image">

                            @error('user_image')
                                <div class="text-rclaro">
                                    {{ $message }}
                                </div>
                            @enderror
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
