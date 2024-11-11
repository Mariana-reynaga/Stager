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
        @yield('content')

        <footer class="bg-negro w-full min-h-40 p-5 flex flex-col items-center inset-x-0 bottom-0">
            <div class="w-4/5 flex">
                <div class="flex flex-col w-1/2">
                    <p class="text-blanco font-kanit font-bold text-xl">Stager</p>

                    <ul >
                        <li><a href="" class="text-blanco font-kanit">Crear una cuenta</a></li>
                        <li><a href="" class="text-blanco font-kanit">Quienes somos</a></li>
                        <li><a href="" class="text-blanco font-kanit">Caja de sugerencias</a></li>
                    </ul>

                </div>

                <div class="w-1/2 flex flex-col">
                    <h3 class="text-blanco font-kanit font-bold">Redes sociales</h3>
                    <ul>
                        <li><a href="" class="text-blanco font-kanit">Instagram</a></li>
                        <li><a href="" class="text-blanco font-kanit">Twitter / X</a></li>
                        <li><a href="" class="text-blanco font-kanit">Bluesky</a></li>
                    </ul>
                </div>
            </div>

            <p class="text-blanco font-kanit text-center mt-10"><span class="font-bold">Stager</span> es una marca registrada 2024.</p>
        </footer>
    </main>

</body>
</html>
