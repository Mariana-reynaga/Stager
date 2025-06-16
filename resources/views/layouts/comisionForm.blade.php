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
<body>
    <main>
        <div class="w-full shadow-md flex justify-center fixed top-0">
            <div class="w-5/6 p-3 flex justify-between bg-white">
                <a href="@yield('back')" class="flex items-center">
                    <img src="{{ url('/images/back_arrow.svg') }}" class="w-10" alt="Flecha negra que apunta a la izquierda.">
                    <p class="ms-3 font-kanit font-semibold text-2xl text-negro" >Volver</p>
                </a>

                <img src="/../images/logo/icon_black.svg" alt="" class="w-12">
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
