<div class="w-full fixed top-0" x-data="{showBar: false}">
    <div class="p-3 min-h-20"
        :class="{ 'bg-white shadow-lg shadow-rclaro/50 transition duration-100' : showBar }"
        @scroll.window="showBar = (window.pageYOffset > 20) ? true : false"
    >
        <div class="flex justify-between mx-4 min-h-12 items-center">
            <div class="w-1/3">
                <img src="images/logo/stager_navbar_logo.png" alt="Logotipo de Stager en letras blancas" class="w-2/5">
            </div>

            <div class="w-1/3 flex justify-end text-negro font-kanit">
                @guest
                        <x-links.nav-link route="login">Iniciar Sesión</x-links.nav-link>
                @else
                    <div class="w-3/5 flex justify-between">
                        <x-links.nav-link-param route="espacio.trabajo" param="user_id" :paramValue="auth()->user()->user_id" >Comisiones</x-links.nav-link-param>

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
