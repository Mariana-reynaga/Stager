<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title> @yield('title') </title>
</head>
<body>
    <main class="px-20 pt-12">
        <div class="mb-5">
            <x-nav-link route="workspace">Volver</x-nav-link>
        </div>

        @yield('form')
    </main>
</body>
</html>
