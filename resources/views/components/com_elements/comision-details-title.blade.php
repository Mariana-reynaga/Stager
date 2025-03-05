<div>
    <div class="flex justify-between items-center">
        <h2 class="me-3 text-xl font-bold text-rclaro">{{$title}}</h2>
        @if ($status == false)
            <a href="{{ route($route, ['id'=>$param]) }}" class="pb-2 no-underline hover:underline text-roscuro font-kanit">Agregar</a>
        @endif
    </div>
</div>
