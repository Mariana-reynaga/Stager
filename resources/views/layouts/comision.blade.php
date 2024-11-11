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
        <div class="mt-10 ms-10 flex items-center">
            <a href="/workspace">
                <div class="w-10 h-10 rounded-lg bg-slate-300"></div>
            </a>
            <h1 class="ms-3 font-kanit font-semibold text-2xl text-negro">@yield('section')</h1>
        </div>

        <div class="">
            @yield('content')
        </div>
    </main>
</body>
</html>
