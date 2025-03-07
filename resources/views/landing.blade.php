@extends('layouts.landing')

@section('title', 'Stager')

@section('content')
    {{-- banner the stager --}}
    <div class="flex items-center flex-col p-3 my-4 min-h-52">
        <div class="w-4/5 h-52 bg-slate-500">.</div>
        <p class="text-negro text-xl"><strong class="font-normal">organización</strong> para artistas</p>
    </div>

    {{-- que es stager --}}
    <div class="flex justify-center bg-roscuro my-16 p-6" id="descripcion">
        <div class="w-4/5 flex flex-col lg:flex-row">
            {{-- descripción --}}
            <div class="lg:w-1/2 me-3 flex flex-col">
                <h2 class="text-blanco text-3xl mb-3 font-kanit font-bold">¿Qué es Stager?</h2>
                <p class="text-blanco my-3 font-kanit">Stager es una <strong class="font-normal">solución</strong> para todos los artistas que hacen trabajo <strong class="font-normal">freelance</strong> y tienen dificultades para <strong class="font-normal">llegar a tiempo</strong>.</p>

                <p class="text-blanco my-3 font-kanit">Con su diseño sencillo pero atractivo, buscamos ofrecer un ambiente que promueve la creatividad y organización para todo tipo de artistas.</p>
            </div>

            {{-- foto --}}
            <div class="lg:w-1/2 ms-3 flex justify-center">
                <div class="w-2/3 h-full bg-slate-300"></div>
            </div>
        </div>
    </div>

    {{-- beneficios de stager --}}
    <div class="flex justify-center my-20" id="beneficios">
        <div class="w-4/5 flex flex-col items-center">
            <h2 class="text-negro text-3xl font-kanit font-bold text-center">Beneficios</h2>

            {{-- <div
                x-data="{
                    currentSlide: 1,
                    slides: [
                        {id: 1, title: 'Conveniencia', tagline: 'Todos los detalles en un lugar.', img: `<img src='/images/landing/convinience.svg' class='w-10'>`},

                        {id: 2, title: 'Simpleza', tagline: 'Diseño simple y ordenado.', img: `<img src='/images/landing/calendar.svg'  class='w-10'>` },

                        {id: 3, title: 'Para artistas', tagline: 'Una plataforma creada especificamente para tus necesidades', img: `<img src='/images/landing/brush.svg'  class='w-10'>` },

                        {id: 4, title: 'Gran Comunidad', tagline: 'Siempre estamos abiertos a sugerencias para un mejor servicio', img: `<img src='/images/landing/community.svg'  class='w-10'>` },
                    ]
                }"
                >

                <template x-for="slide in slides" :key="slide.id">
                    <div class="flex justify-center my-5 md:my-0" x-show="currentSlide === slide.id">
                        <div class="bg-rclaro p-3 rounded-lg flex flex-col items-center">
                            <div class="flex flex-col items-center">
                                <h3 class="text-blanco text-kanit font-bold" x-text="slide.title"></h3>
                                <p class="text-blanco text-center mt-3" x-text="slide.tagline"></p>
                            </div>

                            <div class="w-1/2 min-h-20 mt-6">
                                <span x-html="slide.img"></span>
                            </div>
                        </div>
                    </div>
                </template>

                <div class="w-full flex items-center justify-center px-4">
                    <template x-for="slide in slides" :key="slide.id">
                      <button
                        class="flex-1 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out  hover:shadow-lg"
                        :class="{
                            'bg-rclaro hover:bg-rclaro': currentSlide === slide,
                            'border-rclaro border-2 bg-white': currentSlide !== slide
                        }"
                        x-on:click="currentSlide = slide.id"
                      ></button>
                    </template>
                </div>

            </div> --}}

            {{-- beneficios --}}
            <div class="flex flex-col md:grid md:grid-cols-2 md:gap-x-12 md:gap-y-6 xl:flex xl:flex-row xl:justify-evenly xl:w-full mt-12">

                <x-landing.beneficio-card titulo="Conveniencia" img="convinience.svg">
                    Todos los detalles en un lugar
                </x-landing.beneficio-card>

                <x-landing.beneficio-card titulo="Simpleza" img="calendar.svg">
                    Diseño simple y ordenado
                </x-landing.beneficio-card>

                <x-landing.beneficio-card titulo="Para artistas" img="brush.svg">
                    Una plataforma creada especificamente para tus necesidades
                </x-landing.beneficio-card>

                <x-landing.beneficio-card titulo="Gran Comunidad" img="community.svg">
                    Siempre estamos abiertos a sugerencias para un mejor servicio
                </x-landing.beneficio-card>

            </div>

        </div>
    </div>

    {{-- call to action --}}
    <div class="my-16 flex justify-center">
        <div class="w-4/5 bg-roscuro p-6">
            <div class="flex justify-center">
                <div class="flex flex-col items-center w-1/2">
                    <h3 class="text-blanco font-kanit font-bold text-xl">¡Toma control del show!</h3>
                    <a
                        href="{{ route('auth.register.form') }}"
                        class="
                            px-6 py-3
                            bg-blanco
                            text-negro
                            rounded-lg
                            font-kanit
                            font-extrabold
                            my-3"
                    >Crea tu cuenta</a>
                </div>

                <div class="w-1/2 flex justify-center">
                    <div class="bg-slate-200 w-4/5 h-full"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

