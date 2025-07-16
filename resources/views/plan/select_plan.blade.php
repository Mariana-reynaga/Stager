@extends('layouts.auth')

@section('title', 'Seleccionar plan')

@section('content')
    <div class="mt-10 flex justify-center ">
            <div class="w-4/5 pt-10 flex flex-col items-center">
                <h2 class="text-roscuro font-caramel text-3xl">Elegí un plan que se adapte a vos</h2>

                <div class="w-4/5 xl:w-4/5 lg:w-full mt-10 flex flex-col lg:flex-row justify-center lg:justify-evenly">
                    @foreach ($plans as $plan )
                        <div class="mb-5 lg:w-1/2  lg:me-10 xl:me-10">
                            <div class="p-5 flex flex-col items-center bg-roscuro text-blanco font-kanit rounded-t-lg">
                                <h2 class="font-bold text-xl">{{$plan->plan_name}}</h2>
                            </div>

                            <div class="py-5 flex flex-col items-center border-2 border-roscuro rounded-b-md">
                                <p class="font-kanit font-bold text-3xl"><span class="text-lg">AR</span>$ {{$plan->plan_price}}/<span class="text-lg">mes</span></p>
                                <div class="flex justify-center">
                                    <a href="{{ route('checkout', ['plan_id'=> $plan->plan_id]) }}" class="mt-6 btn-principal">Elegir Plan</a>
                                </div>

                                <ul class="mt-5 w-1/2 flex flex-col justify-center list-disc font-kanit text-lg">
                                    @foreach ( json_decode($plan->plan_perks) as $key )
                                        <li>{{ $key->perk }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
@endsection
