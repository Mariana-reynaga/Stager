@extends('layouts.profile')

@section('title', 'Perfil')

@section('content')
    <div class="flex justify-between items-center">
        <div class="ms-10 flex flex-wrap items-center gap-x-6 gap-y-8">
            @if(!auth()->user()->user_image)
                <div class="w-10 h-10 2xl:w-20 2xl:h-20 bg-slate-300 rounded-full"></div>
            @else
                <div class="w-10 h-10 2xl:w-20 2xl:h-20">
                    <img src='/storage/{{ auth()->user()->user_image }}' class="w-full h-full object-cover rounded-full">
                </div>

            @endif
            <p class="font-kanit font-semibold text-2xl text-negro">{{ auth()->user()->name }}</p>
        </div>

        <a href="{{route('user.edit', ['user_id'=>$user->user_id])}}" class="text-roscuro underline underline-offset-4">Editar perfil</a>
    </div>

    <div class="mt-10 flex justify-center">
        <div class="w-4/5">
            <div class="min-h-32 flex justify-between gap-x-3">
                <div class="w-1/2 h-32 p-4 flex flex-col justify-evenly border-2 border-rclaro rounded-md font-kanit text-lg">
                    <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                    <p><span class="font-semibold">Usuario desde:</span> {{ $user->created_at->format('d/m/Y') }}</p>
                </div>

                <div class="w-1/2 p-4 flex flex-col justify-evenly border-2 border-rclaro rounded-md font-kanit text-lg">
                    <div class="pb-2 flex justify-evenly items-center border-b-2 border-rclaro">
                        <p><span class="font-semibold">Cantidad de comisiones:</span> {{ count($comision) }}</p>
                        <p><span class="font-semibold">Comisiones completadas:</span> {{ count($comision->where('is_complete', true)) }}</p>
                    </div>

                    <div class="mt-5 font-lg text-negro font-kanit">
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
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            fontColor: 'black',
                                            fontSize: 16,
                                            padding: 20
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
