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

                {{-- Descripción --}}
                <div class="flex flex-col break-words overflow-hidden">
                    <h2 class="text-xl font-bold text-rclaro">Descripción:</h2>
                    <p>{{ $comision->com_description }}</p>
                </div>

                {{-- Tareas --}}
                <div class="flex flex-col mt-5">
                    <div class="flex justify-between items-center">
                        <h2 class="me-3 text-xl font-bold text-rclaro">Tareas</h2>
                        @if ($comision->is_complete == false)
                            <a href="{{ route('task.add', ['id'=>$comision->com_id]) }}" class="">agregar</a>
                        @endif
                    </div>

                    <div class="grid grid-cols-3 gap-y-4">
                        @foreach ($tareas as $key => $tarea )

                        <div class="">
                            @if ($comision->is_complete == false)
                                @if ($tarea->is_complete === false)
                                    <p class="me-5">"{{ $tarea->task }}"</p>
                                @else
                                    <p class="me-5 text-slate-500 line-through">"{{ $tarea->task }}"</p>
                                @endif
                            @else
                                <p class="me-5 text-slate-500 line-through">"{{ $tarea->task }}"</p>
                            @endif
                        </div>

                        <div class="col-span-2">
                            <div class="flex justify-between">
                                @if ($comision->is_complete == false)

                                    @if ($tarea->is_complete === false)
                                        <x-task-button route="task.complete" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="px-4 py-2 bg-green-500 rounded-md">
                                            <img src="{{url('/images/task_icons/check.svg')}}" class="w-5" alt="">
                                        </x-task-button>
                                    @else
                                        <x-task-button route="task.incomplete" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="px-4 py-2 bg-red-500 rounded-md">
                                            <img src="{{url('/images/task_icons/close.svg')}}" class="w-5" alt="">
                                        </x-task-button>
                                    @endif

                                    @if (count($tareas) > 1 )
                                        @if ($key != 0 && $key != count($tareas)-1 )
                                            <x-task-button route="task.moveUP" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="px-4 py-2 bg-blue-500 rounded-md">
                                                <img src="{{url('/images/task_icons/up.svg')}}" class="w-5" alt="">
                                            </x-task-button>

                                            <x-task-button route="task.moveDOWN" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="px-4 py-2 bg-sky-500 rounded-md">
                                                <img src="{{url('/images/task_icons/down.svg')}}" class="w-5" alt="">
                                            </x-task-button>

                                        @elseif ($key === 0)
                                            <x-task-button route="task.moveDOWN" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="px-4 py-2 bg-sky-500 rounded-md">
                                                <img src="{{url('/images/task_icons/down.svg')}}" class="w-5" alt="">
                                            </x-task-button>

                                        @elseif ($key === count($tareas)-1)
                                            <x-task-button route="task.moveUP" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="px-4 py-2 bg-blue-500 rounded-md">
                                                <img src="{{url('/images/task_icons/up.svg')}}" class="w-5" alt="">
                                            </x-task-button>
                                        @endif
                                    @endif


                                    <x-task-button route="task.delete.process" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="DELETE" classes="px-4 py-2 bg-red-500 rounded-md">
                                        <img src="{{url('/images/task_icons/trash.svg')}}" class="w-5" alt="">
                                    </x-task-button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
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
