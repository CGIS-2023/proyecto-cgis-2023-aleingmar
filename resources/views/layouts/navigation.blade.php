<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                    <div class="flex-shrink-0">

                    @if(\Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 1 || \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 2 || \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 3 ) 
                            <a href="{{route('sanitarios.index')}}">
                                <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                </a>
                    </div>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 4 ) 
                            <a href="{{route('accesos.index')}}">
                                <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                </a>
                    </div>
                    @endif


                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    
                    
                        <x-nav-link :href="route('accesos.index')" :active="request()->routeIs('accesos.index') or request()->routeIs('accesos.create') or request()->routeIs('accesos.edit') or request()->routeIs('accesos.show')">
                            {{ __('Mis accesos') }}
                        </x-nav-link>
                        @if(\Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 2 || \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 1 || \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 3)
                        <x-nav-link :href="route('sanitarios.index')" :active="request()->routeIs('sanitarios.index') or request()->routeIs('sanitarios.create') or request()->routeIs('sanitarios.edit') or request()->routeIs('sanitarios.show')">
                            {{ __('Sanitarios') }}
                        </x-nav-link>
                        @endif
                        <x-nav-link :href="route('incidencias.index')" :active="request()->routeIs('incidencias.index') or request()->routeIs('incidencias.create') or request()->routeIs('incidencias.edit') or request()->routeIs('incidencias.show')">
                            {{ __('Mis incidencias') }}
                        </x-nav-link>
                        
                        

                    
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">

            <!-- x-dropdown es para hacer un desplegable, y los x-dropdown-link syon para cada desplegado dentro de la lista-->

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>{{ Auth::user()->name}} -> {{Auth::user()->email}} </div>
                        
                            
                            <div class="flex-shrink-0">
                            
                                <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                
                            </div>


                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log out') }}
                            </x-dropdown-link>
                        </form>

                        <!-- IMPORTANTE, le paso como parametro al show lo que pulso en el desplegable-->
                       
                        <x-dropdown-link :href="route('sanitarios.show', Auth::user()->sanitario->id)">
                            {{ __('Mi perfil') }}
                        </x-dropdown-link>
                       



                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    



        <!-- Responsive Settings Options -->
        
        <div class="pt-4 pb-1 border-t border-gray-200">
            

                
                
    </div>
</nav>
