<div>
    <div x-data="{isModalOpen: false, objectId: 0, imageSrc: {{ 0 }}, lightbox: false }" x-on:keydown.escape="isModalOpen=false" class="relative">
        {{-- Fondo --}}
        <div x-show="isModalOpen === true || lightbox === true" class="w-full h-full fixed top-0 left-0 bg-black/20"></div>

        {{-- Imagen expandida modal --}}
        <div x-show="lightbox === true" x-on:click.away="lightbox = false" x-cloak x-transition class="w-4/5 fixed top-10 z-10" tabindex="-1">
            <div class="flex justify-center items-center">
                <div class="w-4/5 h-full p-4 rounded-md shadow-md bg-white" x-on:click.away="lightbox = false">
                    <img :src='imageSrc' class="h-full w-full">
                </div>
            </div>
        </div>

        {{-- Modal confirm --}}
        <div x-show="isModalOpen === true" x-on:click.away="isModalOpen = false" x-cloak x-transition class="w-4/5 fixed z-10" tabindex="-1">
            <div class="flex justify-center items-center">
                <div class="w-3/5 p-4 rounded-md shadow-md bg-white">
                    <div class="pb-2 flex justify-between border-b-2 border-rclaro rounded-md">
                        <h1 class="font-kanit font-semibold text-xl text-roscuro">{{ $title }}</h1>

                        <div x-on:click="isModalOpen = false">
                            <img src="/images/task_icons/close.svg" alt="" class="w-5">
                        </div>
                    </div>

                    <div class="ms-5 mt-5">
                        <p>{{ $tagline }}</p>
                    </div>

                    <div class="mt-4 flex justify-center">
                        <div class="w-1/3">
                            <div class="flex justify-between">
                                <p x-on:click="isModalOpen = false">Cancelar</p>

                                <form action="{{ route($route, [$param=>$paramValue]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="{{$valueName}}" id="{{$valueName}}" x-bind:value="objectId">
                                    <button type="submit" class="text-roscuro">Eliminar</button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{ $slot }}
    </div>
</div>
