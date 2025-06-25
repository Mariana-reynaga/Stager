@extends('layouts.auth')

@section('title', 'Seleccionar plan')

@section('content')
    <div class="mt-10 flex justify-center ">
            <div class="w-4/5 pt-10 flex flex-col items-center">
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
                                <a href="{{ route('auth.register.plan') }}" class="mt-6 btn-principal">Elegir Plan</a>
                            </div>

                            <ul class="mt-5 h-24 flex flex-col justify-between list-disc font-kanit text-lg">
                                <li>Máximo <span class="text-roscuro">3</span> comisiones activas</li>
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
@endsection
