<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    
                        <x-nav-link :href="route('accesos.index')" :active="request()->routeIs('accesos.index') or request()->routeIs('accesos.create') or request()->routeIs('accesos.edit') or request()->routeIs('accesos.show')">
                            {{ __('Mis accesos') }}
                        </x-nav-link>
                    
                    
                </div>
            </div>

            <!-- Settings Dropdown -->
            
                        <!-- Authentication -->
                        
            
        </div>
    </div>
</nav>
