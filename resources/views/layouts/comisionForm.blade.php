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

    <title>@yield('title')</title>
</head>
<body>
    <main>
        @yield('back')

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
