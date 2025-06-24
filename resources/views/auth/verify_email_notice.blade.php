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

    <title>Vericar Email</title>
</head>
<body>
    <main>
        <nav class="min-h-20 mb-10 p-3 shadow-lg ">
            <div class="flex justify-between mx-4 min-h-12 items-center">
                <div class="w-1/3 md:w-1/4 lg:w-1/3 xl:w-1/4">
                    <img src="/images/logo/stager_navbar_logo.png" alt="Logotipo de Stager en letras negras" class="lg:w-2/3 2xl:1/6">
                </div>

                <div class="w-2/3 lg:w-1/3 flex justify-end text-xl text-negro font-kanit">
                    <x-links.nav-link route="landing.page">Volver a Inicio</x-links.nav-link>
                </div>
            </div>
        </nav>

        <div class="flex justify-center mt-10">
            <div class="w-4/5">
                <h1 class="text-center font-kanit text-3xl text-rclaro">¡Tu e-mail no está verificado!</h1>

                <div class="mt-5 flex justify-center text-lg">
                    <p>Para utilizar Stager, por favor verifica tu cuenta mediante el e-mail que mandamos a <span class="font-semibold text-roscuro">{{auth()->user()->email}}</span></p>
                </div>


                <div class="mt-10 flex flex-col items-center justify-center">
                    <p class="mb-5">¿No recibiste el e-mail?</p>
                    <form action="{{ route('verification.send') }}" method="POST">
                        @csrf

                        <button class="btn-principal" x-ref="btn">Reenviar el e-mail</button>
                    </form>
                </div>
            </div>
        </div>
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
