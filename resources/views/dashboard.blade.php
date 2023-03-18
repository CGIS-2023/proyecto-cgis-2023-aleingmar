<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Esta es la vista que puedes encontrar en resources/views/dashboard.blade.php. Si quisiéramos utilizar esta vista como panel de control inicial podríamos hacer un controlador como HomeController, comprobar el tipo de usuario (en este proyecto aún no hay) y renderizar una cosa u otra.</p>
                    <p>En este caso, navega en el menú superior para ver las opciones que os he creado de ejemplo</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
