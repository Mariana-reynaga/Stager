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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0/dist/fancybox/fancybox.css" />
    <title>Stager - @yield('title')</title>
</head>
<body class="bg-blanco">
    <main class="h-dvh flex flex-col justify-between">
        <div class="w-full h-20 flex justify-center fixed top-0 bg-[url('/../../../public/images/top_curtain.svg')] z-10">
            <div class="w-5/6 pb-4 flex justify-between items-center">
                <a href="{{ route('espacio.trabajo', ['user_id'=>auth()->user()->user_id] ) }}" class="flex items-center">
                    <img src="{{ url('/images/back_arrow.svg') }}" class="w-10" alt="Flecha negra que apunta a la izquierda.">
                    <p class="ms-3 font-kanit font-semibold text-2xl text-blanco" >Volver</p>
                </a>
                <img src="/../images/logo/logo_white.png" alt="" class="w-28">
            </div>
        </div>

        <style>
            [x-cloak] { display: none !important; }
        </style>
        <div x-cloak x-data="{
            activeTab: @if (session('tabNum')) {{(int) session('tabNum')}} @else 1  @endif,
            active: 'mx-5 lg:mx-3 py-2 px-5 font-kanit text-white rounded-t-lg bg-rclaro',
            inactive: 'mx-5 lg:mx-3 py-2 px-5 font-kanit border-2 border-b-0 border-rclaro rounded-t-lg bg-white',
            showMsgSuccess: @if(session('success.msg')) true @else false @endif,
            showMsgFail: @if(session('failure.msg')) true @else false @endif}">

            <div class="mt-24 flex flex-col items-center flex-1">
                <div class="w-4/5 flex flex-col lg:flex-row justify-between border-b-2 border-rclaro">
                    @yield('content')

                    <div class="flex">
                        <p x-on:click="activeTab = 1" :class="activeTab === 1 ? active : inactive">Detalles</p>
                        <p x-on:click="activeTab = 2" :class="activeTab === 2 ? active : inactive">Tareas</p>
                        <p x-on:click="activeTab = 3" :class="activeTab === 3 ? active : inactive">Notas</p>
                        <p x-on:click="activeTab = 4" :class="activeTab === 4 ? active : inactive">Galería</p>
                    </div>
                </div>

                <div class="w-full">
                    <div x-show="activeTab === 1" x-transition>
                        @yield('details')
                    </div>
                    <div x-show="activeTab === 2" x-transition>
                        <div x-show="showMsgSuccess === true" class="flex justify-center">
                            <div class="w-4/5 flex justify-center">
                                <div class="w-4/5 lg:w-1/2 2xl:w-1/3 mt-5 p-6 flex justify-between items-center bg-green-500/30 shadow-md font-kanit text-xl rounded-md">
                                    {!! session()->get('success.msg') !!}
                                    <div x-on:click="showMsgSuccess = false">
                                        <img src="/images/task_icons/close.svg" alt="" class="w-10">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('tasks')
                    </div>
                    <div x-show="activeTab === 3" x-transition>
                        <div x-show="showMsgSuccess === true" class="flex justify-center">
                            <div class="w-4/5 flex justify-center">
                                <div class="w-4/5 lg:w-1/2 2xl:w-1/3 mt-5 p-6 flex justify-between items-center bg-green-500/30 shadow-md font-kanit text-xl rounded-md">
                                    {!! session()->get('success.msg') !!}

                                    <div x-on:click="showMsgSuccess = false">
                                        <img src="/images/task_icons/close.svg" alt="" class="w-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="showMsgFail === true" class="flex justify-center">
                            <div class="w-4/5 flex justify-center">
                                <div class="w-4/5 lg:w-1/2 2xl:w-1/3 mt-5 p-6 flex justify-between items-center gap-x-3 bg-red-500/30 shadow-md font-kanit text-xl rounded-md">
                                    {!! session()->get('failure.msg') !!}
                                    <div x-on:click="showMsgFail = false">
                                        <img src="/images/task_icons/close.svg" alt="" class="w-10">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('notes')
                    </div>
                    <div x-show="activeTab === 4" x-transition>
                        <div x-show="showMsgSuccess === true" class="flex justify-center">
                            <div class="w-4/5 flex justify-center">
                                <div class="w-4/5 lg:w-1/2 2xl:w-1/3 mt-5 p-6 flex justify-between items-center bg-green-500/30 shadow-md font-kanit text-xl rounded-md">
                                    {!! session()->get('success.msg') !!}

                                    <div x-on:click="showMsgSuccess = false">
                                        <img src="/images/task_icons/close.svg" alt="" class="w-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="showMsgFail === true" class="flex justify-center">
                            <div class="w-4/5 flex justify-center">
                                <div class="w-4/5 lg:w-1/2 2xl:w-1/3 mt-5 p-6 flex justify-between items-center gap-x-3 bg-red-500/30 shadow-md font-kanit text-xl rounded-md">
                                    {!! session()->get('failure.msg') !!}
                                    <div x-on:click="showMsgFail = false">
                                        <img src="/images/task_icons/close.svg" alt="" class="w-10">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('gallery')
                    </div>
                </div>
            </div>
        </div>

        <footer class="w-full h-24 mt-10 relative shrink-0 bg-[url('/../../../public/images/landing/seats_footer.svg')]">
            <div class="w-full absolute bottom-0">
                <div class="w-full flex justify-center">
                    <p class="text-blanco font-kanit text-center mt-10"><span class="font-bold">Stager</span> es una marca registrada 2024.</p>
                </div>
            </div>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
      Fancybox.bind("[data-fancybox]", {
        // Your custom options
      });
    </script>
</body>
</html>
