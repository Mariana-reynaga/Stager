<div>
    <div class="flex flex-col justify-evenly min-h-72 h-fit w-64 font-kanit text-negro p-3 border-2 border-rclaro rounded-md">
        <p class="font-bold text-lg mb-2">{{ $titulo }}</p>
        <div class="break-words overflow-hidden">
            <p class="my-1">{{ $slot }}</p>
        </div>
        <p class="mt-2"><span class="font-bold">Entrega:</span> {{ $fecha_entrega }}</p>

        <div class="flex justify-center mt-3">
            <a href="{{ route('espacio.details', ['id'=>$id_ruta]) }}" class="btn-principal text-center">Ver más</a>
        </div>
    </div>
</div>
