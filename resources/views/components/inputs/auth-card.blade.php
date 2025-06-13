<div>
    <div class="mt-20 flex flex-col lg:flex-row items-center lg:items-start justify-center">
        <div class="w-4/5 lg:w-1/2 flex flex-col items-center">
            <div class="w-full md:w-4/5 xl:w-3/4 2xl:w-2/3 p-3 shadow-lg shadow-negro/30  rounded-md">
                <h1 class="py-2 font-caramel text-2xl text-roscuro text-center border-b-2 border-roscuro">{{$title}}</h1>

                {{$slot}}

            </div>
        </div>
    </div>
</div>
