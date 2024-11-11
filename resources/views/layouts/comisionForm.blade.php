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
    <main>
        <h1>Crear Comisión</h1>

        <div class="">
            @yield('content')
        </div>
    </main>
</body>
</html>
