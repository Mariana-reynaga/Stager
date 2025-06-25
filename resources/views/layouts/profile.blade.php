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
                <div class="w-4/5 my-3">
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
                    <ul class="h-fit md:h-60 2xl:h-52 mt-3 md:mt-10 flex md:flex-col justify-between text-blanco font-kanit text-md text-center md:text-start md:text-base 2xl:text-lg">
                        <li>
                            <x-links.nav-link route="espacio.crear.form">Cargar comisión</x-links.nav-link>
                        </li>

                        <li>
                            <x-links.nav-link-param route="espacio.trabajo" param="user_id" :paramValue="auth()->user()->user_id" >Comisiones en proceso</x-links.nav-link-param>
                        </li>

                        <li>
                            <x-links.nav-link-param route="espacio.completas" param="user_id" :paramValue="auth()->user()->user_id" >Comisiones completas</x-links.nav-link-param>
                        </li>

                        <li>
                            <a href="{{ route('landing.page') }}">Volver al Inicio</a>
                        </li>

                        <li>
                            <form action="{{ route('auth.logout.process') }}" method="POST">
                                @csrf
                                <button type="submit">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="lg:w-4/5 md:ms-48 lg:ms-52 me-3 pt-3 2xl:ms-80">
            <div class="pb-2">
                <h1 class="font-kanit text-3xl font-semibold text-negro mt-5 ms-5">@yield('sectionTitle')</h1>
            </div>

            @yield('content')
        </div>

    </main>
</body>
</html>
