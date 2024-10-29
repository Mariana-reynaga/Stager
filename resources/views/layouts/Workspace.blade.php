<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Stager - @yield('username')</title>
</head>
<body>
    <main class="flex">
        <div class="min-w-32 w-1/6">
            <x-nav-bar-work />
        </div>

        <div class="mx-3 pt-5 ps-5 w-5/6">
            @yield('Content')
        </div>
    </main>
</body>
</html>
