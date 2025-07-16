@extends('layouts.profile')

@section('title', 'Perfil')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/5 mt-28 md:mt-0 flex justify-between items-center">
            <div class="flex flex-wrap items-center gap-x-6 gap-y-8">
                @if(!auth()->user()->user_image)
                    <div class="w-12 h-12 md:w-14 md:h-14 2xl:w-20 2xl:h-20 bg-roscuro rounded-full shadow-md">
                        <img src='/images/landing/logo.svg' class="w-full h-full object-cover rounded-full">
                    </div>
                @else
                    <div class="w-16 h-16 md:w-20 md:h-20 ">
                        <img src='/storage/{{ auth()->user()->user_image }}' class="w-full h-full object-cover rounded-full shadow-md">
                    </div>
                @endif
                <p class="font-kanit font-semibold text-2xl text-negro">{{ auth()->user()->name }}</p>
            </div>

            <a href="{{route('user.edit', ['user_id'=>$user->user_id])}}" class="link-style">Editar perfil</a>
        </div>
    </div>

    <div class="my-10 flex justify-center">
        <div class="w-4/5 2xl:w-3/4">
            <div class="min-h-32 flex flex-col justify-between gap-x-3 gap-y-3">
                <div class="flex flex-col lg:flex-row gap-y-3 lg:gap-y-0 lg:gap-x-3">
                    <div class="lg:w-1/2 h-32 p-4 flex flex-col justify-evenly border-2 border-rclaro rounded-md font-kanit text-lg">
                        <p><span class="text-roscuro font-semibold">Email:</span> {{ $user->email }}</p>
                        <p><span class="text-roscuro font-semibold">Usuario desde:</span> {{ $user->created_at->format('d/m/Y') }}</p>
                    </div>

                    <div class="lg:w-1/2 h-32 p-4 flex flex-col justify-evenly border-2 border-rclaro rounded-md font-kanit text-lg">
                        <p><span class="text-roscuro font-semibold">Plan:</span> {{ ucfirst($user->plan->plan_name) }}</p>
                        @if ($user->plan->plan_name === 'Prueba')
                            <p><span class="text-roscuro font-semibold">Fin de suscripción:</span> - </p>

                            <a href="{{ route('checkout', ['plan_id'=>1]) }}" class="mt-3 link-style">Suscribirse a Premium</a>
                        @else
                            <p><span class="text-roscuro font-semibold">Fin de suscripción:</span> {{

                            $user->end_sub->format('d/m/Y') }}</p>

                            <a href="{{ route('checkout', ['plan_id'=>1]) }}" class="mt-3 link-style">Renovar Subscripción</a>
                        @endif

                    </div>
                </div>

                <div class="p-4 flex flex-col justify-evenly border-2 border-rclaro rounded-md font-kanit text-lg">
                    <div class="pb-2 flex justify-evenly items-center border-b-2 border-rclaro font-semibold">
                        <p>Actualmente, hay {{ count($comision) }} comisiones registradas</p>
                    </div>

                    <div class="lg:flex lg:justify-between xl:justify-evenly">
                        <div class="mt-5 lg:me-3 text-lg text-negro font-kanit">
                            <canvas id="chart"></canvas>
                            <script>
                                var ctx = document.getElementById('chart').getContext('2d');
                                var chart = new Chart(ctx, {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['Completa', 'No completa'],
                                        datasets: [{
                                            data: [
                                                {{ count($comision->where('is_complete', true)) != 0 ? ( count($comision->where('is_complete', true)) ) : 1 }},
                                                {{ count($comision->where('is_complete', false)) != 0 ? ( count($comision->where('is_complete', false)) ) : 1 }}
                                            ],
                                            backgroundColor: [
                                                '#CC0428',
                                                '#FEF9EF',
                                            ],
                                            borderColor: [
                                                '#9A031E',
                                                '#0A100D',
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        plugins: {
                                            legend: {
                                                display: false
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>

                        <div class="mt-7 flex justify-center lg:order-first">
                            <div class="w-3/5 md:w-2/3 lg:w-full flex flex-col lg:justify-center gap-y-4 lg:gap-y-10">
                                <div class="flex items-center gap-x-3">
                                    <div class="w-8 h-8 bg-blanco rounded-md shadow-md border-2"></div>
                                    <p>Comisiones Incompletas: <span class="font-semibold text-xl">{{ count($comision->where('is_complete', false)) }}</span></p>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <div class="w-8 h-8 bg-rclaro rounded-md shadow-md"></div>
                                    <p>Comisiones Completas: <span class="font-semibold text-xl">{{ count($comision->where('is_complete', true)) }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
