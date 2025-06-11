@extends('layouts.landing')

@section('title', 'Stager')

@section('content')
    {{-- Banner --}}
    <div class="p-3 mx-4 flex flex-col lg:flex-row justify-center">
        <div class="mt-5 lg:w-2/5 me-5 flex flex-col items-center lg:items-start justify-center">
            <h1 class="text-roscuro font-caramel text-3xl">Organización para artistas</h1>
            <p class="mt-5 font-kanit text-center lg:text-start">
                Nuestra suite almacena todos los detalles que necesitas tener al alcance de tu mano para optimizar tu flujo de trabajo, manteniendo un diseño simple que te permite enfocarte en lo que más importa.
            </p>

            @guest
                <div class="w-full flex justify-center">
                    <a href="{{ route('auth.register.form') }}" class="mt-6 btn-principal">Crea tu cuenta</a>
                </div>
            @else
                <div class="flex justify-center">
                    <a href="{{ route('espacio.trabajo', ['user_id'=>auth()->user()->user_id]) }}" class="mt-6 btn-principal">Ver Comisiones</a>
                </div>
            @endguest
        </div>

        <div class="lg:w-1/3 flex justify-center order-first lg:order-last">
            <img class="w-3/5 lg:w-full ms-5" src="/images/landing/banner.svg" alt="">
        </div>

    </div>

    {{-- Planes --}}
    @guest
        <div class="my-20 flex justify-center ">
            <div class="w-4/5 pt-10 flex flex-col items-center border-t-4 border-roscuro">
                <h2 class="text-roscuro font-caramel text-3xl">Elegí un plan que se adapte a vos</h2>

                <div class="w-4/5 xl:w-4/5 lg:w-full mt-10 flex flex-col lg:flex-row justify-center lg:justify-evenly">
                    <div class="mb-5 lg:w-1/2  lg:me-10 xl:me-10">
                        <div class="p-5 flex flex-col items-center bg-roscuro text-blanco font-kanit rounded-t-lg">
                            <h2 class="font-bold text-xl">Prueba</h2>
                            <p class="lg:text-center">Una muestra de lo que tenemos para ofrecerte</p>
                        </div>

                        <div class="py-5 flex flex-col items-center border-2 border-roscuro rounded-b-md">
                            <p class="font-kanit font-bold text-3xl" >Gratis</p>
                            <div class="flex justify-center">
                                <a href="{{ route('auth.register.form') }}" class="mt-6 btn-principal">Elegir Plan</a>
                            </div>

                            <ul class="mt-5 h-24 flex flex-col justify-between list-disc font-kanit text-lg">
                                <li>Máximo <span class="text-roscuro">3</span> comisiones</li>
                                <li>Máximo <span class="text-roscuro">3</span> Notas por comisión</li>
                                <li>Máximo <span class="text-roscuro">4</span> Imágenes por comisión</li>
                            </ul>
                        </div>
                    </div>

                    <div class="mb-5 lg:w-1/2 ">
                        <div class="p-5 flex flex-col items-center bg-roscuro text-blanco font-kanit rounded-t-lg">
                            <h2 class="font-bold text-xl">Premium</h2>
                            <p class="lg:text-center">La completa suite de Stager</p>
                        </div>

                        <div class="py-5 flex flex-col items-center border-2 border-roscuro rounded-b-md">
                            <p class="font-kanit font-bold text-3xl"><span class="text-lg">AR</span>$ 4000/<span class="text-lg">mes</span></p>
                            <div class="flex justify-center">
                                <a href="{{ route('auth.register.form') }}" class="mt-6 btn-principal">Elegir Plan</a>
                            </div>

                            <ul class="mt-5 h-24 flex flex-col justify-between list-disc font-kanit text-lg">
                                <li>Comisiones <span class="text-roscuro">ilimitadas</span></li>
                                <li>Notas <span class="text-roscuro">ilimitadas</span></li>
                                <li>Imágenes <span class="text-roscuro">ilimitadas</span></li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    @endguest

    {{-- beneficios de stager --}}
    <div class="my-20 flex justify-center" id="beneficios">
        <div class="w-4/5 flex flex-col items-center">
            <h2 class="text-roscuro text-3xl font-caramel text-center">Decile adiós al caos del trabajo freelance</h2>

            <div class="lg:w-4/5">
                <div class="mt-10 grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <div class="group benefit-card flex justify-center" onmouseover="document.getElementById('convinience').src='/images/landing/icons/white/convinience.svg'" onmouseout="document.getElementById('convinience').src='/images/landing/icons/black/convinience.svg'">
                            <div class="lg:2/3 xl:w-2/5 me-10 group-hover:text-blanco flex flex-col justify-center font-kanit">
                                <h2>Conveniencia</h2>
                                <p>Todos los detalles en un solo lugar, con herramientas pensadas específicamente para artistas.</p>
                            </div>

                            <img class="w-1/4 xl:w-1/6" src="/images/landing/icons/black/convinience.svg" alt="" id="convinience">
                        </div>
                    </div>

                    <div class="grid-col-1">
                        <div class="group benefit-card flex flex-col" onmouseover="document.getElementById('community').src='/images/landing/icons/white/community.svg'" onmouseout="document.getElementById('community').src='/images/landing/icons/black/community.svg'">
                            <div class="w-full text-center group-hover:text-blanco">
                                <h2>Gran Comunidad</h2>
                                <p>Siempre estamos abiertos a sugerencias para un mejor servicio</p>
                            </div>

                            <div class="mt-5 flex justify-center">
                                <img class="w-2/3 lg:w-1/3 xl:w-1/3" src="/images/landing/icons/black/community.svg" alt="" id="community">
                            </div>
                        </div>
                    </div>

                    <div class="grid-col-1">
                        <div class="group h-full benefit-card flex justify-around lg:justify-start flex-col" onmouseover="document.getElementById('calendar').src='/images/landing/icons/white/calendar.svg'" onmouseout="document.getElementById('calendar').src='/images/landing/icons/black/calendar.svg'">
                            <div class="w-full flex flex-col items-center group-hover:text-blanco">
                                <h2>Simpleza</h2>
                                <p class="text-center">Diseño simple y ordenado</p>
                            </div>

                            <div class="mt-5 flex justify-center">
                                <img class="w-2/3 lg:w-1/2 xl:w-2/5 2xl:w-1/3" src="/images/landing/icons/black/calendar.svg" alt="" id="calendar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- que es stager --}}
    <div class="flex justify-center bg-roscuro my-16 p-6" id="descripcion">
        <div class="w-4/5 flex flex-col lg:flex-row justify-center lg:justify-between xl:justify-center">
            {{-- descripción --}}
            <div class="lg:w-1/2 flex flex-col justify-center">
                <h1 class="text-blanco text-3xl mb-3 font-caramel text-center lg:text-start">¿Qué es Stager?</h1>

                <div class="xl:w-4/5">
                    <p class="text-blanco my-3 font-kanit">Stager nació del deseo de que <strong class="font-normal">artistas</strong> pudieran tener una herramienta para manejar mejor su trabajo. Mientras que existen otras opciones y métodos para lograr el mismo resultado, sentimos que tienen una gran curva de aprendizaje o son molestos de mantener.</p>

                    <p class="text-blanco my-3 font-kanit">Por eso, con su diseño sencillo y accesible, buscamos ofrecer un ambiente que no solo ayude a artistas, pero también que los inspire a experimentar con sus medios artísticos en toda su extensión.</p>
                </div>
            </div>

            {{-- foto --}}
            <div class="flex justify-center">
                <img class="w-2/3 lg:w-4/5" src="/images/landing/logo.svg" alt="">
            </div>
        </div>
    </div>

    {{-- call to action --}}
    <div class="my-16 flex justify-center">
        <div class="w-4/5  p-6 bg-roscuro rounded-md">
            <div class="flex justify-center">
                <div class="xl:w-1/2 flex flex-col items-center">
                    <h2 class="text-blanco font-caramel text-3xl">¡Toma control del show!</h2>
                    @guest
                        <a href="{{ route('auth.register.form') }}" class="px-6 py-3 bg-blanco text-negro rounded-lg font-kanit font-bold my-3">Crea tu cuenta</a>
                    @else
                        <a href="{{ route('espacio.trabajo', ['user_id'=>auth()->user()->user_id]) }}" class="px-6 py-3 bg-blanco text-negro rounded-lg font-kanit font-bold my-3">Crea tu cuenta</a>
                    @endguest
                </div>
            </div>
        </div>

    </div>
@endsection

