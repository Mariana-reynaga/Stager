<div>
    <div x-data="{isModalOpen: false}" x-on:keydown.escape="isModalOpen=false" class="relative">
        {{-- Fondo --}}
        <div x-show="isModalOpen === true" class="w-full h-full fixed top-0 left-0 bg-black/20"></div>

        {{-- Modal --}}
        <div x-show="isModalOpen === true" x-on:click.away="isModalOpen = false" x-cloak x-transition class="w-4/5 fixed inset-y-[10rem] start-[11.7rem] z-40" tabindex="-1">
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
                                    @method($method)
                                    <button type="submit" class="text-roscuro">{{ $submitTxt }}</button>
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
