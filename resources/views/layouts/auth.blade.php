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
    <main class="h-fit">

        @yield('content')

        {{-- <footer class="bg-negro w-full min-h-20 p-5 flex flex-col items-center absolute inset-x-0 bottom-0">

        </footer> --}}
    </main>

</body>
</html>
