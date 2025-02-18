@extends('layouts.comision')

@section('title', 'Detalles')
                {{-- Aca iria la var con el titulo --}}
@section('section', $comision->com_title)

@section('content')
    <div class="flex justify-center mt-5">
        <div class="flex justify-between w-4/5 border-b-4 border-rclaro pb-6">
            <h1 class="font-kanit font-semibold text-2xl text-negro">{{$comision->com_title}}</h1>
            @if ($comision->is_complete == false)
                <a href="{{ route('espacio.edit', ['id'=>$comision->com_id]) }}" class="text-rclaro" >Editar comisión</a>
            @endif
        </div>
    </div>

    <div class="flex flex-col items-center w-full mt-5">
        <div class="flex justify-between font-kanit text-negro w-4/5 pt-5 min-h-80">
            <div class="w-2/5 flex flex-col">

                <div class="flex flex-col">
                    <h2 class="text-xl font-bold text-rclaro">Descripción:</h2>
                    <p>{{ $comision->com_description }}</p>
                </div>

                <div class="flex flex-col mt-5">
                    <h2 class="text-xl font-bold text-rclaro">Tareas</h2>


                    @foreach ($tareas as $key => $tarea )
                        @if ($tarea->is_complete === false)
                            <div class="flex">
                                <p class="me-5">"{{ $tarea->task }}"</p>
                                <p>no estoy completo!</p>
                            </div>
                        @else
                            <div class="flex">
                                <p class="me-5">"{{ $tarea->task }}"</p>
                                <p>si estoy completo!</p>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>

            <div class="w-2/5 flex flex-col justify-between">
                <div class="h-fit flex">
                    <h2 class="text-xl font-bold text-rclaro me-2">Fecha de entrega:</h2>
                    @if ($comision->is_complete == false)
                        <p>{{ $comision->com_entrega->format('d/m/Y') }}</p>
                    @else
                        <p>Completada</p>
                    @endif
                </div>

                <div class="flex flex-col mt-5">
                    <h2 class="text-xl font-bold text-rclaro me-2">Cliente</h2>

                    <ul class="min-h-24 flex flex-col justify-evenly">
                        <li><span class="text-roscuro" >Contacto:</span> {{ $comision->com_client }}</li>
                        <li><span class="text-roscuro" >Método:</span> {{ $comision->social->red_social }}</li>
                        <li><span class="text-roscuro" >Método de pago:</span> {{ $comision->pago->metodo_pago }}</li>
                    </ul>

                </div>

                <div class="flex justify-evenly mt-5">
                    <form action="{{ route('espacio.details.delete',['id'=>$comision->com_id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn-secundario">Eliminar</button>
                    </form>

                    @if ($comision->is_complete == false)
                        <form action="{{ route('espacio.details.complete',['id'=>$comision->com_id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="btn-principal">Marcar como completado</button>
                        </form>

                    @endif
                </div>
            </div>

        </div>

    </div>

@endsection
