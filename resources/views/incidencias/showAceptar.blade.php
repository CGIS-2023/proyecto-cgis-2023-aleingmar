<x-app-layout>
    <x-slot name="header">
        <nav class="font-semibold text-xl text-gray-800 leading-tight" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                {{-- <li class="flex items-center">
                  <a href="#">Home</a>
                  <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li> --}}
                <li class="flex items-center">
                    <a href="{{ route('incidencias.index') }}">incidencias</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li>
                <li>
                    <a href="#" class="text-gray-500" aria-current="page">Aceptar incidencia</a>
                </li>
            </ol>
        </nav>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="font-semibold text-lg px-6 py-4 bg-white border-b border-gray-200">
                    Información del incidencia
                </div>

                        
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('incidencias.updateAceptar', $incidencia->id) }}">
                        @csrf
                        @method('put')


                       



            <!-- ///////////////////////esto es el formulario de edicion de los normales y jefes de guard /////////////////-->


            @if(\Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 1 || \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 2 )

                        <!-- Value es lo que manda en el request -->
                    <!-- En este ejemplo, ambos botones de radio tienen el mismo atributo name, lo que significa que solo se puede seleccionar  -->
                   <!--  uno a la vez. Cuando un botón de radio se selecciona, el valor asociado se envía al servidor como parte del formulario. -->
                            <!-- si se pudiera clickar dos a la vez es tipo checkbox si no es radio -->
                       
                            
        

                        <div class="mt-4">
                                <x-label for="motivoRespuesta" :value="__('Motivo de la Respuesta')" />

                        <!-- el old, es que cuando se mande un motivo y de error, el validate devuelve el motivo por el que ha dado error, SI EXISTE lo pone en el value otra vez, si no pues sale el pordefecto -->

                                <x-input id="motivoRespuesta" class="block mt-1 w-full" type="text" name="motivoRespuesta" :value="old('motivoRespuesta') ? old('motivoRespuesta') : $respuestaPredeterminada" required />
                        </div>


            @endif

                        <div class="flex items-center justify-end mt-4">
                            <x-button type="button" class="bg-red-800 hover:bg-red-700">
                                <a href={{route('incidencias.index')}}>
                                    {{ __('Cancelar') }}
                                </a>
                            </x-button>
                            <x-button class="ml-4">
                                {{ __('Guardar') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>
