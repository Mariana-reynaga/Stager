<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- tailwind --}}
    @vite('resources/css/app.css')

    <title>@yield('title')</title>
</head>
<body>
    <main>
        <div class="mt-10 ms-10">
            <a href="{{ route('espacio.trabajo', ['user_id'=>auth()->user()->user_id] ) }}" class="flex items-center">
                <div class="w-10 h-10 rounded-lg bg-slate-300"></div>
                <p class="ms-3 font-kanit font-semibold text-2xl text-negro" >Volver</p>
            </a>
        </div>

        <div class="">
            @yield('content')
        </div>
    </main>
</body>
</html>
