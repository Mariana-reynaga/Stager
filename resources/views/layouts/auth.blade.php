<!DOCTYPE html>
<html lang="en">
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
    <div class="w-full p-3 shadow-lg">
        <div class="w-1/3 md:w-1/4 lg:w-1/3 xl:w-1/4">
            <a href="/">
                <img src="images/logo/stager_navbar_logo_colors.png" alt="Logotipo de Stager en letras blancas" class="lg:w-2/3 2xl:1/6">
            </a>
        </div>
    </div>

    <main class="h-fit">
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
