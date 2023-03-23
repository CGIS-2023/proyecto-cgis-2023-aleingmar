<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    
                        <x-nav-link :href="route('acceso_centros.index')" :active="request()->routeIs('acceso_centros.index') or request()->routeIs('acceso_centros.create') or request()->routeIs('acceso_centros.edit') or request()->routeIs('acceso_centros.show')">
                            {{ __('Mis acceso_centros') }}
                        </x-nav-link>
                    
                    
                </div>
            </div>

            <!-- Settings Dropdown -->
            
                        <!-- Authentication -->
                        
            
        </div>
    </div>
</nav>
