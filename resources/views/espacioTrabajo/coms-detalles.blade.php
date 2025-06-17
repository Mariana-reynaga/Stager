@extends('layouts.comision')

@section('title', 'Detalles')

@section('section', $comision->com_title)

@section('content')
    <div class="mb-5 lg:mb-0 flex justify-between items-center">
        <h1 class="font-kanit font-semibold text-2xl text-negro">{{$comision->com_title}}</h1>
        @if ($comision->is_complete == false)
            <a href="{{ route('espacio.edit', ['id'=>$comision->com_id]) }}" class="ms-10 link-style" >Editar comisión</a>
        @endif
    </div>

@endsection

@section('details')
    <div class="w-full mt-5 flex flex-col items-center">
        <div class="w-4/5 min-h-80 pt-5 flex flex-col lg:flex-row justify-between gap-y-10 gap-x-10 font-kanit text-negro">
            <div class="w-1/2  flex flex-col">
                {{-- Descripción --}}
                <div class="flex flex-col break-words overflow-hidden">
                    <h2 class="text-xl font-bold text-rclaro">Descripción:</h2>
                    <p>{{ $comision->com_description }}</p>
                </div>

                {{-- Progreso --}}
                <div class="mt-5 flex flex-col break-words overflow-hidden">
                    <h2 class="text-xl font-bold text-rclaro">Progreso:</h2>

                    <x-com_elements.progress-bar :percent="$comision->com_percent" />
                </div>

            </div>

            <div class="w-1/2  flex flex-col justify-between">
                {{-- Fecha de entrega --}}
                <div class="h-fit flex items-center">
                    <h2 class="text-xl font-bold text-rclaro me-2">Fecha de entrega:</h2>
                    @if ($comision->is_complete == false)
                        <p>{{ $comision->com_due->format('d/m/Y') }}</p>
                    @else
                        <p>Completada</p>
                    @endif
                </div>

                {{-- Cliente --}}
                <div class="flex flex-col">
                    <h2 class="text-xl font-bold text-rclaro me-2">Cliente</h2>

                    <ul class="min-h-24 flex flex-col justify-evenly">
                        <li><span class="text-roscuro" >Contacto:</span> {{ $comision->com_client }}</li>
                        <li><span class="text-roscuro" >Método:</span> {{ $comision->social->social_media_name }}</li>
                        <li><span class="text-roscuro" >Método de pago:</span> {{ $comision->payment->payment_method_name }}</li>
                    </ul>

                </div>

                <div class="flex justify-evenly gap-x-3">
                    {{-- Eliminar --}}
                    <x-modals.confirm-modal title="¿Eliminar Comisión?" tagline="¿Esta seguro? Una vez eliminada, la comisión no puede recuperarse." route="espacio.details.delete" param="id" :paramValue="$comision->com_id"  method="DELETE" submitTxt="Eliminar">
                        <button x-on:click="isModalOpen = true" class="btn-secundario">Eliminar</button>
                    </x-modals.confirm-modal>

                    {{-- Marcar como completo --}}
                    @if ($comision->is_complete == false)
                        <x-modals.confirm-modal title="¿Completar Comisión?" tagline="Una vez marcada como completa, la comisión no puede volver al estado de incompleta." route="espacio.details.complete" param="id" :paramValue="$comision->com_id"  method="PUT" submitTxt="Completar">
                            <button x-on:click="isModalOpen = true" class="btn-principal text-lg">Marcar como completado</button>
                        </x-modals.confirm-modal>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('tasks')
    <div class="mt-5 flex justify-center">
        <div class="w-4/5">
            {{-- Tareas --}}
            <div class="flex flex-col">
                <div x-data="{addOpen: false}" class="relative">
                    {{-- Fondo --}}
                    <div x-show="addOpen === true" class="w-full h-full fixed top-0 left-0 bg-black/20"></div>

                    {{-- Modal agregar tarea --}}
                    <div x-show="addOpen === true" x-cloak x-transition class="w-4/5 fixed z-10" tabindex="-1">
                        <div class="flex justify-center items-center">
                            <div class="w-3/5 p-4 rounded-md shadow-md bg-white">
                                <div class="pb-2 flex justify-between items-center border-b-2 border-rclaro rounded-md">
                                    <h1 class="font-kanit font-semibold text-xl text-roscuro">Agregar Tareas</h1>

                                    <div x-on:click="addOpen = false">
                                        <img src="/images/task_icons/close.svg" alt="" class="w-10">
                                    </div>
                                </div>

                                <div class="ms-5 mt-5">
                                    <form action="{{ route('task.add.process', ['id'=>$comision->com_id]) }}" method="POST">
                                        @csrf
                                        <x-inputs.label-form>
                                            <x-slot name="forName">com_tasks</x-slot>
                                            <x-slot name="title">Nueva Tarea</x-slot>
                                            Los pasos a completar, separar con comas
                                        </x-inputs.label-form>

                                        <x-inputs.form-input
                                            type="text"
                                            inputName="com_tasks"
                                        />

                                        @error('com_tasks')
                                        <div class="text-rclaro">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <div class="my-3">
                                            <button type="submit" class="btn-principal">Agregar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <p x-on:click="addOpen = true">Agregar</p>

                </div>

                <x-modals.delete-one-of-many-modal title="¿Eliminar la Tarea?" tagline="¿Esta seguro? Una vez eliminada no se puede recuperar." route="task.delete.process" param="id" :paramValue="$comision->com_id" valueName="tasks_id">

                    <div class="mt-5 grid grid-cols-3 gap-y-4">
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
                                        <x-com_elements.task-button route="task.complete" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="px-4 py-2 bg-green-500 rounded-md">
                                            <img src="{{url('/images/task_icons/check.svg')}}" class="w-5" alt="">
                                        </x-com_elements.task-button>
                                    @else
                                        <x-com_elements.task-button route="task.incomplete" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="px-4 py-2 bg-red-500 rounded-md">
                                            <img src="{{url('/images/task_icons/close.svg')}}" class="w-5" alt="">
                                        </x-com_elements.task-button>
                                    @endif

                                    @if (count($tareas) > 1 )
                                        @if ($key != 0 && $key != count($tareas)-1 )
                                            <x-com_elements.task-button route="task.moveUP" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="px-4 py-2 bg-blue-500 rounded-md">
                                                <img src="{{url('/images/task_icons/up.svg')}}" class="w-5" alt="">
                                            </x-com_elements.task-button>

                                            <x-com_elements.task-button route="task.moveDOWN" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="px-4 py-2 bg-sky-500 rounded-md">
                                                <img src="{{url('/images/task_icons/down.svg')}}" class="w-5" alt="">
                                            </x-com_elements.task-button>

                                        @elseif ($key === 0)
                                            <x-com_elements.task-button route="task.moveDOWN" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="px-4 py-2 bg-sky-500 rounded-md">
                                                <img src="{{url('/images/task_icons/down.svg')}}" class="w-5" alt="">
                                            </x-com_elements.task-button>

                                        @elseif ($key === count($tareas)-1)
                                            <x-com_elements.task-button route="task.moveUP" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="px-4 py-2 bg-blue-500 rounded-md">
                                                <img src="{{url('/images/task_icons/up.svg')}}" class="w-5" alt="">
                                            </x-com_elements.task-button>
                                        @endif
                                    @endif

                                    <div x-on:click="isModalOpen = true, objectId = {{$key}} " class="px-4 py-2 bg-red-500 rounded-md">
                                        <img src="{{url('/images/task_icons/trash.svg')}}" class="w-5">
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </x-modals.delete-one-of-many-modal>
            </div>
        </div>
    </div>
@endsection

@section('notes')
    <div class="mt-5 flex justify-center">
        <div class="w-4/5">
            <x-comision-details-title
                    title="Notas"
                    route="note.add"
                    :status='$comision->is_complete'
                    :param='$comision->com_id'
            />

            <x-modals.delete-one-of-many-modal title="¿Eliminar la Nota?" tagline="¿Esta seguro? Una vez eliminada no se puede recuperar." route="note.delete.process" param="id" :paramValue="$comision->com_id" valueName="note_id">

                <div class="mt-5 grid grid-cols-3 gap-x-3 gap-y-4">
                    @foreach ($notas as $key => $nota )
                        <div class="min-h-52 border border-rclaro rounded-md">
                            <div class="py-2 px-3 bg-rclaro text-white">
                                <h3 class="font-kanit text-lg">{{ $nota->title }}</h3>
                            </div>

                            <div class="flex flex-col justify-between">
                                <div class="h-48 px-4 py-2 break-words overflow-hidden">
                                    <p class="mt-3">{{ $nota->note }}</p>
                                </div>

                                @if ($comision->is_complete == false)
                                    <div class="my-5 flex justify-evenly">
                                        <button  x-on:click="isModalOpen = true, objectId = {{$key}} "  class="font-semibold text-roscuro">Eliminar</button>

                                        <form action="{{route('note.edit', ['id'=>$comision->com_id])}}">
                                            @csrf
                                            <input type="hidden" name="noteId" id="noteId" value="{{$key}}">
                                            <button type="submit">Editar</button>
                                        </form>

                                    </div>
                                @endif
                            </div>
                        </div>

                    @endforeach
                </div>
            </x-modals.delete-one-of-many-modal>
        </div>
    </div>
@endsection

@section('gallery')
    <div class="mt-5 flex justify-center">
        <div class="w-4/5">
            <x-comision-details-title
                    title="Galería"
                    route="picture.add"
                    :status='$comision->is_complete'
                    :param='$comision->com_id'
            />
        </div>
    </div>

    <div class="mt-5 flex justify-center">
        <div class="w-4/5">
            <x-modals.delete-one-of-many-modal
                    title="¿Eliminar la Imagen?"
                    tagline="¿Esta seguro? Una vez eliminada no se puede recuperar."
                    route="picture.delete"
                    param="id"
                    :paramValue="$comision->com_id"
                    valueName="pic_id"
                >
                <div class="grid grid-cols-3 gap-x-3 gap-y-4">
                    @foreach ($gallery as $key => $image )
                        <div class="p-2 h-64 border-2 border-rclaro rounded-md">
                            <img src="{{ Storage::url($image->pic_route) }}" class="h-full w-full object-cover" x-on:click="lightbox = true, imageSrc = '{{ Storage::url($gallery[$key]->pic_route)}}'">

                            <div class="relative">
                                <div class="absolute bottom-3 right-3 bg-roscuro rounded-md" x-on:click="isModalOpen = true, objectId = {{$gallery[$key]->pic_id}}">

                                    <img src="/images/task_icons/trash.svg" class="w-10">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-modals.delete-one-of-many-modal>
        </div>
    </div>
@endsection
