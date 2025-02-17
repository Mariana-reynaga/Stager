<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- tailwind --}}
    @vite('resources/css/app.css')

    <title>@yield('title')</title>
</head>
<body>
    <main class="flex w-full">
        <div class="bg-rclaro h-full md:w-40 lg:w-48 fixed pt-3 pe-3 2xl:w-80">
            <div class="flex justify-center mt-5">
                <div class="w-4/5">
                    {{-- nombre y foto usuario --}}
                    <div class="flex items-center justify-between 2xl:justify-start">
                        <div class="w-10 h-10 2xl:w-20 2xl:h-20 bg-slate-300 rounded-full  "></div>

                        <x-nav-link-param route="user.profile" param="user_id" :paramValue="auth()->user()->user_id"> <span class="text-blanco font-kanit 2xl:ms-5">{{ auth()->user()->name }}</span></x-nav-link-param>
                    </div>

                    {{-- links --}}
                    <ul class="text-blanco font-kanit text-sm 2xl:text-lg mt-10 h-40 2xl:h-52 flex flex-col justify-between">
                        <li>
                            <x-nav-link route="espacio.crear.form">Cargar comisión</x-nav-link>
                        </li>

                        <li>
                            <x-nav-link-param route="espacio.trabajo" param="user_id" :paramValue="auth()->user()->user_id" >Comisiones en progreso</x-nav-link-param>
                        </li>

                        <li>
                            <x-nav-link-param route="espacio.completas" param="user_id" :paramValue="auth()->user()->user_id" >Comisiones completas</x-nav-link-param>

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
            <h1 class="font-kanit text-xl font-semibold text-negro mt-5 ms-5">@yield('section')</h1>
            @yield('content')
        </div>

    </main>
</body>
</html>
