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
            <div class="lg:w-1/2 flex flex-col gap-y-6">
                {{-- Descripción --}}
                <div class="p-5 flex flex-col break-words overflow-hidden bg-white rounded-md shadow-md shadow-negro/30">
                    <h2 class="text-xl font-bold text-rclaro">Descripción:</h2>
                    <p class="mt-2 indent-8">{{ $comision->com_description }}</p>
                </div>

                {{-- Progreso --}}
                <div class="p-5 flex flex-col bg-white rounded-md shadow-md shadow-negro/30">
                    <h2 class="text-xl font-bold text-rclaro">Progreso:</h2>
                    <x-com_elements.progress-bar :percent="$comision->com_percent" />
                </div>
            </div>

            <div class="lg:w-1/2 flex flex-col gap-y-6">
                <div class="flex flex-col gap-y-6">
                    <div class="flex gap-x-5">
                        {{-- Fecha de entrega --}}
                        <div class="w-1/2 h-full p-5 flex flex-col items-center bg-white rounded-md shadow-md shadow-negro/30">
                            <h2 class="text-xl font-bold text-rclaro me-2">Fecha de entrega:</h2>

                            @if ($is_Passed)
                                <p class="mt-2 text-xl text-roscuro underline underline-offset-4">{{ $comision->com_due->format('d/m/Y') }}</p>

                            @elseif($comision->is_complete == true)
                                <p class="text-xl">Completada</p>

                            @elseif ($is_Passed == false || $comision->is_complete == false)
                                <p class="text-xl">{{ $comision->com_due->format('d/m/Y') }}</p>

                            @endif
                        </div>
                        {{-- Cliente --}}
                        <div class="w-1/2 h-full p-5 flex flex-col bg-white rounded-md shadow-md shadow-negro/30">
                            <h2 class="text-xl font-bold text-rclaro">Cliente</h2>

                            <ul class="mt-2 flex gap-x-5">
                                <li><span class="text-roscuro" >Contacto:</span> {{ $comision->com_client }}</li>
                                <li><span class="text-roscuro" >Método:</span> {{ $comision->social->social_media_name }}</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Pago --}}
                    <div class="p-5 flex flex-col bg-white rounded-md shadow-md shadow-negro/30">
                        <div class="flex items-center justify-between">
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
                                            <a data-fancybox data-src="{{ Storage::url($comision->com_reciept) }}" class="px-2 lg:py-1.5 py-2 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 cursor-pointer">
                                                Ver recibo
                                            </a>

                                            <a href="{{ route('reciept.download', ['id'=>$comision->com_id]) }}" class="px-2 lg:py-1.5 py-2 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 ">
                                                Descargar recibo
                                            </a>

                                            <a href="{{ route('reciept.upload', ['id'=>$comision->com_id]) }}" class="px-2 lg:py-1.5 py-2 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 ">
                                                Editar recibo
                                            </a>

                                            <x-modals.confirm-modal title="¿Eliminar Recibo?" tagline="¿Esta seguro? Una vez eliminada, el recibo no puede recuperarse." route="reciept.delete" param="id" :paramValue="$comision->com_id"  method="DELETE" submitTxt="Eliminar">
                                                <button x-on:click="isModalOpen = true" class="px-2 lg:py-1.5 py-2 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-rclaro/20 hover:text-roscuro focus-visible:bg-rclaro/20 focus-visible:text-roscuro disabled:opacity-50 ">Eliminar recibo</button>
                                            </x-modals.confirm-modal>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <ul class="mt-2 flex flex-col gap-y-3">
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
                            <div class="p-3 flex justify-between items-center bg-white rounded-md shadow-md shadow-negro/30">
                                <div class="w-1/2 lg:w-3/5 xl:w-2/3 flex items-center font-kanit">
                                    @if ($comision->is_complete == false)
                                        {{-- Marcar la tarea como completa / incompleta --}}
                                        <div class="mx-5">
                                            @if ($tarea->is_complete === false)
                                                <x-com_elements.task-button route="task.complete" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="p-3 border-2 border-rclaro rounded-md">
                                                </x-com_elements.task-button>
                                            @else
                                                <x-com_elements.task-button route="task.incomplete" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="border-2 border-rclaro bg-rclaro rounded-md">
                                                    <img src="{{url('/images/task_icons/check.svg')}}" class="w-7" alt="">
                                                </x-com_elements.task-button>
                                            @endif
                                        </div>

                                        <p class="text-xl text-roscuro">{{$key+1}}.</p>
                                        @if ($tarea->is_complete === false)
                                            <p class="mx-5 text-lg">"{{ $tarea->task }}"</p>
                                        @else
                                            <p class="mx-5 text-lg text-slate-500 line-through">"{{ $tarea->task }}"</p>
                                        @endif
                                    @else
                                        <p class="mx-5 text-lg text-slate-500 line-through">"{{ $tarea->task }}"</p>
                                    @endif
                                </div>

                                <div class="w-1/3 2xl:w-[21%]">
                                    <div class="grid grid-cols-3">
                                        @if (count($tareas) > 1 )
                                            @if ($key != 0 && $key != count($tareas)-1 )
                                                <x-com_elements.task-button route="task.moveUP" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="hover:-translate-y-1 hover:rounded-full hover:shadow-[3px_5px_5px_0px_rgba(0,_0,_0,_0.2)]">
                                                    <img src="{{url('/images/task_icons/up.svg')}}" class="w-10" alt="">
                                                </x-com_elements.task-button>

                                                <x-com_elements.task-button route="task.moveDOWN" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="hover:translate-y-1 hover:rounded-full hover:shadow-[3px_-5px_5px_0px_rgba(0,_0,_0,_0.2)]">
                                                    <img src="{{url('/images/task_icons/down.svg')}}" class="w-10" alt="">
                                                </x-com_elements.task-button>

                                            @elseif ($key === 0)
                                                <div class="w-full h-full col-start-2 col-end-3">
                                                    <x-com_elements.task-button route="task.moveDOWN" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="hover:translate-y-1 hover:rounded-full hover:shadow-[3px_-5px_5px_0px_rgba(0,_0,_0,_0.2)]">
                                                        <img src="{{url('/images/task_icons/down.svg')}}" class="w-10" alt="">
                                                    </x-com_elements.task-button>
                                                </div>

                                            @elseif ($key === count($tareas)-1)
                                                <x-com_elements.task-button route="task.moveUP" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="hover:-translate-y-1 hover:rounded-full hover:shadow-[3px_5px_5px_0px_rgba(0,_0,_0,_0.2)]">
                                                    <img src="{{url('/images/task_icons/up.svg')}}" class="w-10" alt="">
                                                </x-com_elements.task-button>
                                            @endif
                                        @endif

                                        <div class="col-start-3 col-end-4 flex justify-center cursor-pointer">
                                            <div x-on:click="isModalOpen = true, objectId = {{$key}} " class="w-12 flex justify-center items-center group relative">
                                                <div class="w-full h-full bg-[url('/../../public/images/task_icons/trash.svg')] group-hover:opacity-0 transition-opacity duration-200 ease-in-out"></div>
                                                <div class="w-full h-full absolute top-0 left-0 bg-[url('/../../public/images/task_icons/trash_open.svg')] opacity-0 group-hover:opacity-100 transition-opacity duration-200 ease-in-out"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid gap-x-3">
                                        @if ($comision->is_complete == false)
                                            {{-- Mover la tarea arriba/abajo --}}
                                            {{-- @if (count($tareas) > 1 )
                                                @if ($key != 0 && $key != count($tareas)-1 )
                                                    <x-com_elements.task-button route="task.moveUP" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="border-2 border-rclaro rounded-md">
                                                        <img src="{{url('/images/task_icons/up.svg')}}" class="w-10" alt="">
                                                    </x-com_elements.task-button>

                                                    <x-com_elements.task-button route="task.moveDOWN" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="border-2 border-rclaro rounded-md">
                                                        <img src="{{url('/images/task_icons/down.svg')}}" class="w-10" alt="">
                                                    </x-com_elements.task-button>

                                                @elseif ($key === 0)
                                                    <x-com_elements.task-button route="task.moveDOWN" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="border-2 border-rclaro rounded-md">
                                                        <img src="{{url('/images/task_icons/down.svg')}}" class="w-10" alt="">
                                                    </x-com_elements.task-button>

                                                @elseif ($key === count($tareas)-1)
                                                    <x-com_elements.task-button route="task.moveUP" param="id" :paramValue="$comision->com_id" :valueKey="$key" inputName="tasks_id" method="PUT" classes="border-2 border-rclaro rounded-md">
                                                        <img src="{{url('/images/task_icons/up.svg')}}" class="w-10" alt="">
                                                    </x-com_elements.task-button>
                                                @endif
                                            @endif --}}

                                            {{-- Eliminar la tarea --}}
                                            {{-- <div x-on:click="isModalOpen = true, objectId = {{$key}} " class="w-12 col-start-4 flex justify-center border-2 border-rclaro bg-rclaro rounded-md">
                                                <img src="{{url('/images/task_icons/trash.svg')}}" class="w-10">
                                            </div> --}}
                                        @endif
                                    </div>
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
            @if ($comision->is_complete == false)
                <div class="w-fit">
                    <a href="{{ route('note.add', ['id'=>$comision->com_id]) }}">
                        <h2 class="link-style">Agregar Nota</h2>
                    </a>
                </div>
            @endif

            @if ((count($notas)) === 0)
                <div class="mt-5 flex justify-center items-center">
                    <h3 class="font-kanit text-roscuro text-xl">Parece que no hay nada ....</h3>
                </div>
            @else
                <x-modals.delete-one-of-many-modal title="¿Eliminar la Nota?" tagline="¿Esta seguro? Una vez eliminada no se puede recuperar." route="note.delete.process" param="id" :paramValue="$comision->com_id" valueName="note_id">
                    {{-- my-5 flex flex-col md:grid md:grid-cols-2 xl:grid-cols-3 md:gap-x-3 gap-y-4  --}}
                    <div class="my-5 columns-1 lg:columns-2 xl:columns-3 lg:break-after-column gap-4">
                        @foreach ($notas as $key => $nota )
                            <div class="h-fit mb-4 rounded-md bg-white shadow-md shadow-negro/30 lg:break-inside-avoid-column">
                                <div class="py-2 px-3 flex justify-between items-center bg-rclaro font-kanit text-white rounded-t-md">
                                    <h3 class="ms-3 text-xl">{{ $nota->title }}</h3>

                                    @if ($comision->is_complete == false)
                                        <div class="flex items-center gap-x-4">
                                            <form action="{{route('note.edit', ['id'=>$comision->com_id])}}">
                                                @csrf
                                                <input type="hidden" name="noteId" id="noteId" value="{{$key}}">
                                                <button type="submit" class="link-style text-blanco">Editar</button>
                                            </form>

                                            <div x-on:click="isModalOpen = true, objectId = {{$key}} " class="w-8 h-8 me-3 group relative cursor-pointer">
                                                <div class="w-full h-full bg-[url('/../../public/images/task_icons/trash_white.svg')] group-hover:opacity-0 transition-opacity duration-200 ease-in-out"></div>
                                                <div class="w-full h-full absolute top-0 left-0 bg-[url('/../../public/images/task_icons/trash_open_white.svg')] opacity-0 group-hover:opacity-100 transition-opacity duration-200 ease-in-out"></div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="">
                                    @if ($nota->image != NULL)
                                        <div class="h-56">
                                            <a data-fancybox data-src="{{ Storage::url($nota->image) }}">
                                                <img src="{{ Storage::url($nota->image) }}" alt="" class="w-full h-full object-cover object-top">
                                            </a>
                                        </div>
                                    @endif

                                    <div class="mt-3 flex flex-col justify-between">
                                        <p class="ms-3 px-4 py-2 font-kanit text-gray-500">{{ $nota->date }}</p>

                                            {{--  md:h-56 lg:h-40 xl:h-52 2xl:h-40 py-2  --}}
                                        <div class="h-fit p-4 break-words overflow-hidden font-kanit">
                                            <p class="indent-8">{{ $nota->note }}</p>
                                        </div>
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

@section('gallery')
    <div class="mt-5 flex justify-center">
        <div class="w-4/5">
            @if ($comision->is_complete == false)
                <div class="w-fit">
                    <a href="{{ route('picture.add', ['id'=>$comision->com_id]) }}">
                        <h2 class="link-style">Agregar Imagen</h2>
                    </a>
                </div>
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
                            <div class="w-full h-72 relative cursor-pointer">
                                <div class="h-10 w-10 hover:h-10 hover:w-10 p-2 bg-blanco rounded-md absolute bottom-3 right-3 group" x-on:click="isModalOpen = true, objectId = {{$gallery[$key]->pic_id}}">
                                    <div class="w-full h-full bg-[url('/../../public/images/task_icons/trash.svg')] group-hover:opacity-0 transition-opacity duration-200 ease-in-out"></div>

                                    <div class="h-10 w-10 absolute top-0 left-0 bg-[url('/../../public/images/task_icons/trash_open.svg')] opacity-0 group-hover:opacity-100 transition-opacity duration-200 ease-in-out"></div>
                                </div>

                                <a data-fancybox="gallery" data-src="{{ Storage::url($image->pic_route) }}">
                                    <img src="{{ Storage::url($image->pic_route) }}" class="w-full h-full object-cover object-top rounded-md shadow-md shadow-negro/30">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </x-modals.delete-one-of-many-modal>
            @endif
        </div>
    </div>
@endsection
