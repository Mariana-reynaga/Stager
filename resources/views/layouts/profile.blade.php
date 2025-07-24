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

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Stager - @yield('title')</title>
</head>
<body>
    <main>
        <div class="md:h-full w-full md:w-48 lg:w-48 2xl:w-80 md:pt-3 md:px-3 fixed bg-rclaro">
            <div class="md:mt-5 flex justify-center">
                <div class="w-4/5 my-3 text-blanco">
                    {{-- nombre y foto usuario --}}
                    <x-links.nav-link-param route="user.profile" param="user_id" :paramValue="auth()->user()->user_id">
                        <div class="w-1/4 md:w-full flex items-center 2xl:justify-start">
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
        </div>

        <div class="lg:w-4/5 md:ms-48 lg:ms-48 me-3 pt-3 2xl:ms-80 ">
            <div class="w-full h-24 mt-[8.3rem] md:mt-0 fixed md:top-0 bg-[url('/../../../public/images/top_curtain.svg')]">
            </div>

            <div class="pb-2 mt-32 md:mt-24">
                <h1 class="font-kanit text-3xl font-semibold text-negro mt-5 ms-5">@yield('sectionTitle')</h1>
            </div>

            @yield('content')
        </div>

    </main>
</body>
</html>
