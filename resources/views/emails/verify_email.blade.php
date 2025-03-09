<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- tailwind --}}
    @vite('resources/css/app.css')

    <title>Verificar e-mail</title>
</head>
<body>
    <main class="bg-rclaro">
        <div class="flex flex-col justify-evenly items-center">

            <div class="w-4/5 p-4 m-10 flex flex-col items-center bg-blanco font-kanit rounded-md shadow-lg">

                <div class="flex flex-col items-center">
                    <img src="{{ $message->embed('images/logo/stager_navbar_logo.png') }}" class="w-1/3">

                    <h1 class="mt-3 text-negro text-3xl">¡Bienvenido a Stager!</h1>

                    <p class="mt-5">Para poder utilizar nuestros servicios, por favor hacer click en el botón que se encuentra abajo para verificar su cuenta.</p>

                    <a href="{{$url}}" class="btn-principal mt-5">Verificar cuenta</a>
                </div>

                <div class="pt-4 mt-10 flex flex-col items-center border-t-2 border-rclaro">
                    <p>Si estás teniendo problemas con el botón, podés utilizar este link para verificar tu cuenta: <span class="text-rclaro underline underline-offset-4">{{$url}}</span></p>
                </div>
            </div>

            <p class="my-5 text-center font-kanit font-semibold text-blanco">¿No te registraste a Stager? Ignora este e-mail</p>
        </div>

    </main>
</body>
</html>
