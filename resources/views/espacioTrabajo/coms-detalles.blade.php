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
            <div class="lg:w-1/2 flex flex-col">
                {{-- Descripción --}}
                <div class="flex flex-col break-words overflow-hidden">
                    <h2 class="text-xl font-bold text-rclaro">Descripción:</h2>
                    <p class="mt-2">{{ $comision->com_description }}</p>
                </div>

                {{-- Progreso --}}
                <div class="mt-5 xl:w-2/3 flex flex-col break-words overflow-hidden">
                    <h2 class="text-xl font-bold text-rclaro">Progreso:</h2>

                    <x-com_elements.progress-bar :percent="$comision->com_percent" />
                </div>

            </div>

            <div class="lg:w-1/2 flex flex-col gap-y-6">
                {{-- Fecha de entrega --}}
                <div class="h-fit flex items-center">
                    <h2 class="text-xl font-bold text-rclaro me-2">Fecha de entrega:</h2>
                    @if ($comision->is_complete == false)
                        <p>{{ $comision->com_due->format('d/m/Y') }}</p>
                    @else
                        <p>Completada</p>
                    @endif
                </div>

                <div class="flex gap-x-10">
                    {{-- Cliente --}}
                    <div class="w-1/3 flex flex-col">
                        <h2 class="text-xl font-bold text-rclaro">Cliente</h2>

                        <ul class="min-h-24 mt-2 flex flex-col gap-y-5">
                            <li><span class="text-roscuro" >Contacto:</span> {{ $comision->com_client }}</li>
                            <li><span class="text-roscuro" >Método:</span> {{ $comision->social->social_media_name }}</li>
                        </ul>
                    </div>

                    {{-- Pago --}}
                    <div class="w-2/3 flex flex-col">
                        <div class="flex items-center gap-x-5">
                            <h2 class="text-xl font-bold text-rclaro">Pago</h2>
                            @if ($comision->com_reciept == null)
                                <a href="{{ route('reciept.upload', ['id'=>$comision->com_id] ) }}" class="link-style">Subir comprobante de pago</a>
                            @else
                                <div class="flex justify-center">
                                    <div
                                        x-data="{
                                            open: false,
                                            toggle() {
                                                if (this.open) {
                                                    return this.close()
                                                }

                                                this.$refs.button.focus()

                                                this.open = true
                                            },
                                            close(focusAfter) {
                                                if (! this.open) return

                                                this.open = false

                                                focusAfter && focusAfter.focus()
                                            }
                                        }"
                                        x-on:keydown.escape.prevent.stop="close($refs.button)"
                                        x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                        x-id="['dropdown-button']"
                                        class="relative"
                                    >
                                        <button
                                            x-ref="button"
                                            x-on:click="toggle()"
                                            :aria-expanded="open"
                                            :aria-controls="$id('dropdown-button')"
                                            type="button"
                                            class="relative flex items-center justify-center gap-2 link-style"
                                        >
                                            <span>Opciones</span>
                                        </button>
                                        <div
                                            x-ref="panel"
                                            x-show="open"
                                            x-transition.origin.top.left
                                            x-on:click.outside="close($refs.button)"
                                            :id="$id('dropdown-button')"
                                            x-cloak
                                            class="min-w-48 mt-2 p-1.5 absolute left-0 rounded-lg shadow-sm origin-top-left bg-white outline-none border border-gray-200 z-10 font-kanit"
                                        >
                                            <a href="{{ route('reciept.download', ['id'=>$comision->com_id]) }}" class="px-2 lg:py-1.5 py-2 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                                Descargar recibo
                                            </a>

                                            <a href="{{ route('reciept.upload', ['id'=>$comision->com_id]) }}" class="px-2 lg:py-1.5 py-2 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                                Editar recibo
                                            </a>

                                            <x-modals.confirm-modal title="¿Eliminar Recibo?" tagline="¿Esta seguro? Una vez eliminada, el recibo no puede recuperarse." route="reciept.delete" param="id" :paramValue="$comision->com_id"  method="DELETE" submitTxt="Eliminar">
                                                <button x-on:click="isModalOpen = true" class="px-2 lg:py-1.5 py-2 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-rclaro/20 hover:text-roscuro focus-visible:bg-rclaro/20 focus-visible:text-roscuro disabled:opacity-50 disabled:cursor-not-allowed">Eliminar recibo</button>
                                            </x-modals.confirm-modal>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <ul class="min-h-24 mt-2 flex flex-col gap-y-5">
                            <li><span class="text-roscuro" >Método de pago:</span> {{ $comision->payment->payment_method_name }}</li>
                            <li><span class="text-roscuro" >Precio:</span> {{ $comision->currency->payment_currency_name}}$ {{ number_format($comision->com_price,0,',','.')}}</li>
                            @if ($comision->is_payed == true)
                                <li><span class="text-roscuro" >Estado:</span> Pagado</li>
                            @else
                                <li><span class="text-roscuro" >Estado:</span> Sin Pagar</li>
                            @endif

                        </ul>
                    </div>
                </div>

                {{-- Acciones --}}
                <div class="mt-8 flex justify-evenly gap-x-3">
                    {{-- Eliminar --}}
                    <x-modals.confirm-modal title="¿Eliminar Comisión?" tagline="¿Esta seguro? Una vez eliminada, la comisión no puede recuperarse." route="espacio.details.delete" param="id" :paramValue="$comision->com_id"  method="DELETE" submitTxt="Eliminar">
                        <button x-on:click="isModalOpen = true" class="btn-secundario">Eliminar</button>
                    </x-modals.confirm-modal>

                    {{-- Marcar como completo --}}
                    @if ($comision->is_complete == false)
                        <x-modals.confirm-modal title="¿Completar Comisión?" tagline="Una vez marcada como completa, la comisión no puede volver al estado de incompleta." route="espacio.details.complete" param="id" :paramValue="$comision->com_id"  method="PUT" submitTxt="Completar">
                            <button x-on:click="isModalOpen = true" class="btn-principal text-lg">Marcar como completado</button>
                        </x-modals.confirm-modal>
                    @else
                        <form action="{{ route('espacio.details.incomplete', ['id'=>$comision->com_id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn-principal">Marcar como incompleto</button>
                        </form>

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('tasks')
    <div class="mt-5 flex justify-center z-0">
        <div class="w-4/5">
            {{-- Tareas --}}
            <div class="flex flex-col">
                <div x-data="{addOpen: false}" class="relative">
                    {{-- Fondo --}}
                    <div x-show="addOpen === true" class="w-full h-full fixed top-0 left-0 bg-black/20 z-20"></div>

                    {{-- Modal agregar tarea --}}
                    <div x-show="addOpen === true" x-cloak x-transition class="w-4/5 fixed z-30" tabindex="-1">
                        <div class="flex justify-center items-center">
                            <div class="w-full lg:w-3/5 p-4 rounded-md shadow-md bg-white">
                                <div class="pb-2 flex justify-between items-center border-b-2 border-rclaro">
                                    <h2 class="font-kanit font-semibold text-xl text-roscuro">Agregar Tareas</h2>

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

                                        <div class="my-3">
                                            <button type="submit" class="btn-principal">Agregar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    @if ($comision->is_complete == false)
                        <p x-on:click="addOpen = true" class="w-fit link-style">Agregar Tarea</p>
                    @endif
                </div>

                <x-modals.delete-one-of-many-modal title="¿Eliminar la Tarea?" tagline="¿Esta seguro? Una vez eliminada no se puede recuperar." route="task.delete.process" param="id" :paramValue="$comision->com_id" valueName="tasks_id">

                    <div class="mt-5 flex flex-col gap-y-4">
                        @foreach ($tareas as $key => $tarea )
                            <div class="p-3 flex justify-between items-center border-2 border-rclaro rounded-md shadow-md">
                                <div class="w-1/2 lg:w-3/5 xl:w-2/3 font-kanit">
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

                                <div class="w-1/2 lg:w-1/3">
                                    <div class="grid grid-cols-4 gap-x-5">
                                        @if ($comision->is_complete == false)
                                            {{-- Marcar Tarea completa/Incompleta --}}
                                            @if ($tarea->is_complete === false)
                                                <x-com_elements.task-button route="task.complete" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="border-2 border-rclaro rounded-md">
                                                    <img src="{{url('/images/task_icons/check.svg')}}" class="w-10" alt="">
                                                </x-com_elements.task-button>
                                            @else
                                                <x-com_elements.task-button route="task.incomplete" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="border-2 border-rclaro bg-rclaro rounded-md">
                                                    <img src="{{url('/images/task_icons/close_white.svg')}}" class="w-10" alt="">
                                                </x-com_elements.task-button>
                                            @endif

                                            {{-- Mover la tarea arriba/abajo --}}
                                            @if (count($tareas) > 1 )
                                                @if ($key != 0 && $key != count($tareas)-1 )
                                                    <x-com_elements.task-button route="task.moveUP" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="border-2 border-rclaro rounded-md">
                                                        <img src="{{url('/images/task_icons/up.svg')}}" class="w-10" alt="">
                                                    </x-com_elements.task-button>

                                                    <x-com_elements.task-button route="task.moveDOWN" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="border-2 border-rclaro rounded-md">
                                                        <img src="{{url('/images/task_icons/down.svg')}}" class="w-10" alt="">
                                                    </x-com_elements.task-button>

                                                @elseif ($key === 0)
                                                    <div class="col-start-3">
                                                        <x-com_elements.task-button route="task.moveDOWN" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="border-2 border-rclaro rounded-md">
                                                            <img src="{{url('/images/task_icons/down.svg')}}" class="w-10" alt="">
                                                        </x-com_elements.task-button>
                                                    </div>

                                                @elseif ($key === count($tareas)-1)
                                                    <x-com_elements.task-button route="task.moveUP" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="col-span-2 border-2 border-rclaro rounded-md">
                                                        <img src="{{url('/images/task_icons/up.svg')}}" class="w-10" alt="">
                                                    </x-com_elements.task-button>
                                                @endif
                                            @endif

                                            {{-- Eliminar la tarea --}}
                                            <div x-on:click="isModalOpen = true, objectId = {{$key}} " class="w-12 col-start-4 flex justify-center border-2 border-rclaro bg-rclaro rounded-md">
                                                <img src="{{url('/images/task_icons/trash.svg')}}" class="w-10">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="">
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
            @if ($comision->is_complete == false)
                <a href="{{ route('note.add', ['id'=>$comision->com_id]) }}">
                    <h2 class="link-style">Agregar Nota</h2>
                </a>
            @endif

            @if ((count($notas)) === 0)
                <div class="mt-5 flex justify-center items-center">
                    <h3 class="font-kanit text-roscuro text-xl">Parece que no hay nada ....</h3>
                </div>
            @else
                <x-modals.delete-one-of-many-modal title="¿Eliminar la Nota?" tagline="¿Esta seguro? Una vez eliminada no se puede recuperar." route="note.delete.process" param="id" :paramValue="$comision->com_id" valueName="note_id">
                    <div class="my-5 flex flex-col md:grid md:grid-cols-2 xl:grid-cols-3 md:gap-x-3 gap-y-4">
                        @foreach ($notas as $key => $nota )
                            <div class="min-h-52 border border-rclaro rounded-md">
                                <div class="py-2 px-3 bg-rclaro text-white">
                                    <h3 class="font-kanit text-lg">{{ $nota->title }}</h3>
                                </div>

                                <div class="flex flex-col justify-between">
                                    <div class="h-48 md:h-56 lg:h-40 xl:h-52 2xl:h-40 mt-3 px-4 py-2 break-words overflow-hidden font-kanit">
                                        <p>{{ $nota->note }}</p>
                                    </div>

                                    @if ($comision->is_complete == false)
                                        <div class="my-5 flex justify-evenly">
                                            <button  x-on:click="isModalOpen = true, objectId = {{$key}} "  class="btn-secundario">Eliminar</button>

                                            <form action="{{route('note.edit', ['id'=>$comision->com_id])}}">
                                                @csrf
                                                <input type="hidden" name="noteId" id="noteId" value="{{$key}}">
                                                <button type="submit" class="btn-principal">Editar</button>
                                            </form>

                                        </div>
                                    @endif
                                </div>
                            </div>

                        @endforeach
                    </div>
                </x-modals.delete-one-of-many-modal>
            @endif

        </div>
    </div>
@endsection

@section('gallery')
    <div class="mt-5 flex justify-center">
        <div class="w-4/5">
            @if ($comision->is_complete == false)
                <a href="{{ route('picture.add', ['id'=>$comision->com_id]) }}">
                    <h2 class="link-style">Agregar Imagen</h2>
                </a>
            @endif

            @if ((count($gallery)) === 0)
                <div class="mt-5 flex justify-center items-center">
                    <h3 class="font-kanit text-roscuro text-xl">Parece que no hay nada ....</h3>
                </div>
            @else
                <x-modals.delete-one-of-many-modal
                        title="¿Eliminar la Imagen?"
                        tagline="¿Esta seguro? Una vez eliminada no se puede recuperar."
                        route="picture.delete"
                        param="id"
                        :paramValue="$comision->com_id"
                        valueName="pic_id"
                    >
                    <div class="my-5 grid grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-3 gap-y-4">
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
            @endif
        </div>
    </div>
@endsection
