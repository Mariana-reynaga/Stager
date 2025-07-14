@extends('layouts.auth')

@section('title', 'Checkout')

@section('content')
    <div class="mt-10 flex justify-center">
        <div class="w-4/5">
            <div class="flex items-center">
                <a href="{{ route('plan_select.index') }}" class="flex items-center">
                    <img src="{{ url('/images/back_arrow.svg') }}" class="w-10" alt="Flecha negra que apunta a la izquierda.">
                    <p class="ms-3 font-kanit font-semibold text-2xl text-negro" >Volver</p>
                </a>
                <h2 class="ms-10 text-2xl font-kanit text-roscuro font-bold">Detalles de suscripción</h2>
            </div>

            <div class="mt-10 flex gap-x-10 items-start">
                <div class="w-2/3">
                    <div class="pb-4 flex flex-col shadow-md rounded-md font-kanit">
                        <div class="ps-5 py-2 bg-roscuro text-2xl text-blanco rounded-t-md">
                            <h3>Subscipción plan {{$plan->plan_name}}</h3>
                        </div>

                        <div class="px-5 pt-4">
                            <p><span class="text-xl text-roscuro">Duración:</span> 30 días</p>
                        </div>
                    </div>
                </div>

                <div class="w-1/3">
                    <div class="py-2 shadow-md rounded-md">
                        <div class="flex flex-col items-center font-kanit gap-y-5">
                            <div class="flex flex-col items-center">
                                <p class="text-roscuro text-xl font-bold">Periodo de suscripción</p>
                                <p>{{date('d/m')}} - {{$endDate}}</p>
                            </div>

                            <p><span class="text-roscuro text-xl font-bold">Total</span> ${{$plan->plan_price}}</p>
                        </div>
                    </div>

                    <div class="mt-5" id="mercadopago-button"></div>

                    @if (session()->has('failure.msg'))
                        <div class="py-3 px-5 bg-rclaro/90 rounded-md font-kanit text-blanco">
                            <p>{!! session()->get('failure.msg') !!}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    {{-- Incluimos el SDK de JS de Mercado Pago --}}
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
            const mp = new MercadoPago('<?= $mpPublicKey;?>');
            mp.bricks().create('wallet', 'mercadopago-button', {
                initialization: {
                    preferenceId: '<?= $preference->id;?>',
                }
            });
    </script>
@endsection
