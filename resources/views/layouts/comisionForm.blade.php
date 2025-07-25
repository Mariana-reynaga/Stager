<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- tailwind --}}
    @vite('resources/css/app.css')

    {{-- Alpine --}}
    @vite(['resources/js/app.js'])

    <title>Stager - @yield('title')</title>
</head>
<body class="bg-blanco">
    <main>
        <div class="w-full h-20 flex justify-center fixed top-0 bg-[url('/../../../public/images/top_curtain.svg')] z-10">
            <div class="w-5/6 pb-4 flex justify-between items-center">
                <a href="@yield('back')" class="flex items-center">
                    <img src="{{ url('/images/back_arrow.svg') }}" class="w-10" alt="Flecha negra que apunta a la izquierda.">
                    <p class="ms-3 font-kanit font-semibold text-2xl text-blanco" >Volver</p>
                </a>

                <img src="/../images/logo/logo_white.png" alt="" class="w-28">
            </div>
        </div>

        @yield('content')
    </main>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('formSubmit', () => ({
                submit() {
                    this.$refs.btn.disabled = true;
                    this.$refs.btn.classList.remove('btn-principal');
                    this.$refs.btn.classList.add('btn-secundario');
                    this.$refs.btn.innerHTML =
                        `Por favor espere...`;
                    this.$el.submit()
                }
            }))
        })
    </script>
</body>
</html>
