<div>
    <div class="bg-rclaro p-3 min-h-20">
        <div class="flex mx-4 min-h-12 items-center">
            <div class="w-1/3">
                <h1>stager</h1>
            </div>

            <ul class="flex flex-row w-2/3 justify-evenly">
                <li><a href="#descripcion" class="text-blanco font-kanit">Que es Stager</a></li>
                <li><a href="#beneficios" class="text-blanco font-kanit">Beneficios</a></li>
                {{-- <li><a href="" class="text-blanco font-kanit">Preguntas</a></li> --}}
            </ul>

            <div class="w-1/3 flex justify-end text-blanco font-kanit">
                @guest
                        <x-nav-link route="login">Iniciar Sesión</x-nav-link>
                @else
                    <div class="w-3/5 flex justify-between">
                        <x-nav-link-param route="espacio.trabajo" param="user_id" :paramValue="auth()->user()->user_id" >Comisiones</x-nav-link-param>

                        <form action="{{ route('auth.logout.process') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-blanco font-kanit">Cerrar sesión</button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</div>
