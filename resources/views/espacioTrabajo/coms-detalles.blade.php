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

                <div class="flex flex-col break-words overflow-hidden">
                    <h2 class="text-xl font-bold text-rclaro">Descripción:</h2>
                    <p>{{ $comision->com_description }}</p>
                </div>

                {{-- Tareas --}}
                <div class="flex flex-col mt-5">
                    <div class="">
                        <h2 class="text-xl font-bold text-rclaro">Tareas</h2>
                        <a href="{{ route('task.add', ['id'=>$comision->com_id]) }}">agregar</a>
                    </div>

                    @foreach ($tareas as $key => $tarea )
                        <div class="flex my-2">
                            @if ($tarea->is_complete === false)
                                <p class="me-5">"{{ $tarea->task }}"</p>

                                <form action="{{ route('task.complete', ['id'=>$comision->com_id]) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" value="{{ $key }}" name="tasks_id" id="tasks_id">
                                    <button type="submit" class="px-4 py-2 bg-green-500 rounded-md">comp</button>
                                </form>
    
                                @if ($key != 0 && $key != count($tareas)-1 )

                                    <form action="{{ route('task.moveUP', ['id'=>$comision->com_id]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" value="{{ $key }}" name="tasks_id" id="tasks_id">
                                        <button type="submit" class="px-4 py-2 bg-blue-500 rounded-md">up</button>
                                    </form>

                                    <form action="{{ route('task.moveDOWN', ['id'=>$comision->com_id]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" value="{{ $key }}" name="tasks_id" id="tasks_id">
                                        <button type="submit" class="px-4 py-2 bg-sky-500 rounded-md">down</button>
                                    </form>

                                @elseif ($key === 0)
                                    <form action="{{ route('task.moveDOWN', ['id'=>$comision->com_id]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" value="{{ $key }}" name="tasks_id" id="tasks_id">
                                        <button type="submit" class="px-4 py-2 bg-sky-500 rounded-md">down</button>
                                    </form>

                                @elseif ($key === count($tareas)-1)
                                    <form action="{{ route('task.moveUP', ['id'=>$comision->com_id]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" value="{{ $key }}" name="tasks_id" id="tasks_id">
                                        <button type="submit" class="px-4 py-2 bg-blue-500 rounded-md">up</button>
                                    </form>
                                @endif

                            @else
                                <p class="me-5">"{{ $tarea->task }}"</p>
                                <form action="{{ route('task.incomplete', ['id'=>$comision->com_id]) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" value="{{ $key }}" name="tasks_id" id="tasks_id">
                                    <button type="submit" class="px-4 py-2 bg-red-500 rounded-md" >Desmark</button>

                                </form>
                            @endif

                            <form action="{{ route('task.delete.process', ['id'=>$comision->com_id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" value="{{ $key }}" name="tasks_id" id="tasks_id">
                                <button type="submit" class="px-4 py-2 bg-red-500 rounded-md">delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="w-2/5 flex flex-col justify-between">
                {{-- Fecha de entrega --}}
                <div class="h-fit flex">
                    <h2 class="text-xl font-bold text-rclaro me-2">Fecha de entrega:</h2>
                    @if ($comision->is_complete == false)
                        <p>{{ $comision->com_entrega->format('d/m/Y') }}</p>
                    @else
                        <p>Completada</p>
                    @endif
                </div>

                {{-- Cliente --}}
                <div class="flex flex-col mt-5">
                    <h2 class="text-xl font-bold text-rclaro me-2">Cliente</h2>

                    <ul class="min-h-24 flex flex-col justify-evenly">
                        <li><span class="text-roscuro" >Contacto:</span> {{ $comision->com_client }}</li>
                        <li><span class="text-roscuro" >Método:</span> {{ $comision->social->red_social }}</li>
                        <li><span class="text-roscuro" >Método de pago:</span> {{ $comision->pago->metodo_pago }}</li>
                    </ul>

                </div>

                {{-- Eliminar --}}
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
