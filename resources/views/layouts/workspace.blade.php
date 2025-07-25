<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- tailwind --}}
    @vite('resources/css/app.css')

    {{-- Alpine --}}
    @vite(['resources/js/app.js'])

    <title>Stager - @yield('title')</title>
</head>
<body class="bg-blanco">
    <main>
        <div class="md:h-full w-full md:w-52 lg:w-64 2xl:w-80 md:pt-3 md:px-3 fixed bg-rclaro">
            <div class="h-full flex flex-col justify-between">
                <div class="md:mt-5 flex justify-center">
                    <div class="w-4/5 my-3">
                        {{-- nombre y foto usuario --}}
                        <div class="flex items-center">
                            <div class="w-2/3 md:w-full text-blanco">
                                <x-links.nav-link-param route="user.profile" param="user_id" :paramValue="auth()->user()->user_id">
                                    <div class="md:w-full flex items-center 2xl:justify-start">
                                        @if ($user->user_image === NULL)
                                            <div class="w-12 h-12 md:w-14 md:h-14 2xl:w-20 2xl:h-20 bg-roscuro rounded-full">
                                                <img src='/images/landing/logo.svg' class="w-full h-full object-cover rounded-full">
                                            </div>
                                        @else
                                            <div class="w-12 h-12 md:w-14 md:h-14 2xl:w-20 2xl:h-20 bg-slate-300 rounded-full">
                                                <img src='/storage/{{ $user->user_image }}' class="w-full h-full object-cover rounded-full">
                                            </div>
                                        @endif

                                        <span class="ms-5 2xl:ms-5 md:text-lg text-blanco font-kanit">{{ auth()->user()->name }}</span>
                                    </div>
                                </x-links.nav-link-param>
                            </div>

                            <div class="w-1/3 md:hidden flex justify-end">
                                <img src="/images/logo/logo_white.png" class="h-10" alt="">
                            </div>
                        </div>

                        {{-- links --}}
                        <ul class="h-fit pt-3 md:h-72 mt-3 md:mt-5 2xl:pt-10 flex md:flex-col justify-between text-blanco font-kanit text-md text-center md:text-start md:text-base 2xl:text-lg sm:border-t border-blanco">
                            <li class="flex gap-x-3 group items-center">
                                <img src="/../images/star_point.svg" alt="" class="w-5 hidden md:inline md:group-hover:animate-spin">
                                <x-links.nav-link route="espacio.crear.form">Cargar comisión</x-links.nav-link>
                            </li>

                            <li class="flex gap-x-3 group items-center">
                                <img src="/../images/star_point.svg" alt="" class="w-5 hidden md:inline md:group-hover:animate-spin">
                                <x-links.nav-link-param route="espacio.trabajo" param="user_id" :paramValue="auth()->user()->user_id" >Comisiones en proceso</x-links.nav-link-param>
                            </li>

                            <li class="flex gap-x-3 group items-center">
                                <img src="/../images/star_point.svg" alt="" class="w-5 hidden md:inline md:group-hover:animate-spin">
                                <x-links.nav-link-param route="espacio.completas" param="user_id" :paramValue="auth()->user()->user_id" >Comisiones completas</x-links.nav-link-param>
                            </li>

                            <li class="flex gap-x-3 group items-center">
                                <img src="/../images/star_point.svg" alt="" class="w-5 hidden md:inline md:group-hover:animate-spin">
                                <a href="{{ route('landing.page') }}" class="hover:underline hover:underline-offset-2 hover:decoration-2">Volver al Inicio</a>
                            </li>

                            <li class="flex gap-x-3 group items-center">
                                <img src="/../images/star_point.svg" alt="" class="w-5 hidden md:inline md:group-hover:animate-spin">
                                <form action="{{ route('auth.logout.process') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="hover:underline hover:underline-offset-2 hover:decoration-2">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="sm:hidden my-5 md:flex justify-center 2xl:items-center">
                    <img src="/images/logo/logo_white.png" class="h-10 2xl:h-3/5" alt="">
                </div>
            </div>
        </div>

        <div class="lg:w-4/5 md:mx-3 md:ms-52 lg:ms-64 pt-3 2xl:ms-80">
            <div class="w-full h-24 mt-[8.3rem] md:mt-0 fixed md:top-0 bg-[url('/../../../public/images/top_curtain.svg')] z-20">
                <h1 class="mt-5 md:ms-8 font-kanit text-3xl font-semibold text-blanco text-center md:text-start">@yield('sectionTitle')</h1>
            </div>

            @yield('content')
        </div>

        <style>
            [x-cloak] { display: none !important; }
        </style>
        <div x-cloak x-data="{isModalOpen: @if(session('feedback')) true @else false @endif}" x-on:keydown.escape="isModalOpen=false" class="relative">
            {{-- Fondo --}}
            <div x-show="isModalOpen === true" class="w-full h-full fixed top-0 left-0 bg-black/20"></div>

            <div x-show="isModalOpen === true" x-on:click.away="isModalOpen = false" x-cloak x-transition class="w-full 2xl:w-4/5 fixed inset-y-[5rem] 2xl:inset-y-[10rem] start-0 2xl:start-[11.7rem] z-40" tabindex="-1">
                <div class="flex justify-center items-center">
                    <div class="w-4/5 2xl:w-3/5 p-4 rounded-md shadow-md bg-white">
                        <div class="flex flex-col items-center gap-y-5 font-kanit">
                            <div class="w-full pb-2 flex justify-between items-center border-b-2 border-rclaro ">
                                <h1 class="font-kanit font-semibold text-xl text-roscuro">¡No tenes más comisiones disponibles!</h1>

                                <div x-on:click="isModalOpen = false">
                                    <img src="/images/task_icons/close.svg" alt="" class="w-8">
                                </div>
                            </div>

                            <p class="text-center">Llegaste al limite de comisiones para el plan de prueba. Para poder crear otra comisión, completa una de tus comisiones activas o subite al plan premium.</p>

                            <div class="flex gap-x-8">
                                <p class="btn-principal" x-on:click="isModalOpen = false">Cerrar</p>

                                <a href="{{ route('checkout', ['plan_id'=>1]) }}" class="btn-secundario">Suscribirme</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
