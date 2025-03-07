<div class="flex justify-center my-5 md:my-0 ">
    <div class="w-2/3 md:w-full">
        <div class="group md:h-60 p-3 flex flex-col items-center md:justify-around border-2 border-rclaro rounded-lg hover:border-none hover:bg-rclaro hover:shadow-xl hover:shadow-negro/30 transition duration-300 ease-in-out">
            <div class="flex flex-col text-negro group-hover:text-blanco items-center font-kanit">
                <h3 class="text-2xl font-bold">{{ $titulo }}</h3>
                <p class="mt-3 text-center">{{ $slot }}</p>
            </div>

            <div class="w-1/2 min-h-20 mt-6 flex justify-center">
                <img src="/images/landing/{{$img}}" class="w-1/2">
            </div>
        </div>
    </div>
</div>
