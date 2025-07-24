<div>
    <div x-data="{isModalOpen: false}" x-on:keydown.escape="isModalOpen=false" class="relative">
        {{-- Fondo --}}
        <div x-show="isModalOpen === true" class="w-full h-full fixed top-0 left-0 bg-black/20 z-20"></div>

        {{-- Modal --}}
        <div x-show="isModalOpen === true" x-on:click.away="isModalOpen = false" x-cloak x-transition class="w-full 2xl:w-4/5 fixed inset-y-[5rem] 2xl:inset-y-[10rem] start-0 2xl:start-[11.7rem] z-40" tabindex="-1">
            <div class="flex justify-center items-center">
                <div class="w-4/5 2xl:w-3/5 h-56 p-4 rounded-md shadow-md bg-white">
                    <div class="pb-2 flex justify-between items-center border-b-2 border-rclaro ">
                        <h1 class="font-kanit font-semibold text-xl text-roscuro">{{ $title }}</h1>

                        <div x-on:click="isModalOpen = false">
                            <img src="/images/task_icons/close.svg" alt="" class="w-8">
                        </div>
                    </div>

                    <div class="ms-5 mt-5">
                        <p class="text-lg">{{ $tagline }}</p>
                    </div>

                    <div class="mt-4 lg:mt-10 2xl:mt-4 flex justify-center">
                        <div class="w-4/5">
                            <div class="flex justify-center gap-x-7">
                                <p class="btn-secundario" x-on:click="isModalOpen = false">Cancelar</p>

                                <form action="{{ route($route, [$param=>$paramValue]) }}" method="POST">
                                    @csrf
                                    @method($method)
                                    <button type="submit" class="btn-principal">{{ $submitTxt }}</button>
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
