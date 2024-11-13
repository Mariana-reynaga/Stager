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
        <div class="bg-rclaro h-full md:w-40 lg:w-48 fixed pt-3 pe-3">
            <div class="flex justify-center mt-5">
                <div class="w-4/5">
                    {{-- nombre y foto usuario --}}
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 bg-slate-300 rounded-2xl"></div>
                        <p class="text-blanco font-kanit">Nombre user</p>
                    </div>

                    {{-- links --}}
                    <ul class="text-blanco font-kanit text-sm mt-10 h-40 flex flex-col justify-between">
                        <li>
                            <x-nav-link route="espacio.crear.form">Cargar comisión</x-nav-link>
                        </li>

                        <li>
                            <x-nav-link route="espacio.trabajo">Comisiones en progreso</x-nav-link>
                        </li>

                        <li>
                            <x-nav-link route="espacio.completas">Comisiones completas</x-nav-link>
                        </li>

                        <li>
                            <x-nav-link route="user.profile">Perfil</x-nav-link>
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

        <div class="lg:w-4/5 md:ms-48 lg:ms-52 me-3 pt-3">
            <h1 class="font-kanit text-xl font-semibold text-negro mt-5 ms-5">@yield('section')</h1>
            @yield('content')
        </div>

    </main>
</body>
</html>
