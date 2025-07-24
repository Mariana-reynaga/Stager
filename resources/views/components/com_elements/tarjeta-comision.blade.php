<div>
    <div class="min-h-[2rem] w-[30rem] p-5 flex flex-col justify-between bg-white shadow-lg shadow-negro/30 rounded-xl font-kanit transition delay-150 duration-100 ease-in-out hover:-translate-y-2 hover:shadow-[11px_11px_9px_3px_rgba(10,_16,_13,_0.3)]">

        <div class="pb-2 flex justify-between gap-x-2 items-center border-b-2 border-roscuro">
            <h2 class="font-caramel text-2xl">{{ $titulo }}</h2>
            <p>{{ $creationDate }}</p>
        </div>

        <div class="">
            <div class="mt-5 flex flex-col gap-y-2">
                <div class="flex justify-center items-center gap-x-16">
                    <div class="w-1/3 flex flex-col items-center">
                        <div class="flex gap-x-2">
                            <img src="/images/landing/icons/black/community.svg" alt="" class="w-5">
                            <p class="text-roscuro font-bold">Cliente:</p>
                        </div>
                        <p class="text-lg">{{$clientName}}</p>
                    </div>
                    <div class="w-1/3 flex flex-col items-center">
                        <div class="flex gap-x-2">
                            <img src="/images/landing/icons/black/calendar.svg" alt="" class="w-5">
                            <p class="text-roscuro font-bold">Entrega:</p>
                        </div>
                        <p class="text-lg">{{ $fecha_entrega }}</p>
                    </div>
                </div>

                <div class="mt-3 min-h-[6rem] break-words overflow-hidden">
                    <p class="indent-8">{{$desc}}</p>
                </div>
            </div>

            {{$slot}}
        </div>

        <div class="mt-5 flex justify-center">
            <a href="{{ route('espacio.details', ['id'=>$id_ruta]) }}" class="btn-principal text-center">Detalles</a>
        </div>
    </div>
</div>
