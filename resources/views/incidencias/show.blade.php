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
                    <a href="#" class="text-gray-500" aria-current="page">Ver incidencia</a>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="font-semibold text-lg px-6 py-4 bg-white border-b border-gray-200">
                    Información de la incidencia
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        @csrf
                        @method('put')

                        <div class="mt-4">
                            <x-label for="sanitario_id" :value="__('Sanitario')" />

                                <x-input class="block mt-1 w-full"
                                         type="text"
                                         disabled
                                         value="{{$incidencia->sanitario->user->name}} (ID: {{$incidencia->sanitario->id}})"
                                />

                        </div>

                        <div class="mt-4">
                            <x-label for="acceso_id" :value="__('ID Acceso__Fecha y hora Entrada')" />

                                <x-input class="block mt-1 w-full"
                                         type="text"
                                         disabled
                                         value="ID: {{$incidencia->acceso->id}} Entrada: {{$incidencia->acceso->entrada}}"
                                />

                        </div>

                        <div class="mt-4">
                            <x-label for="estado" :value="__('Estado Incidencia')" />

                                <x-input class="block mt-1 w-full"
                                         type="text"
                                         disabled
                                         value="{{$incidencia->getEstadoAttribute()}}"
                                />

                        </div>



                        
                        

                        <div class="mt-4">
                            <x-label for="fechaPresentacion" :value="__('Fecha y hora de Presentacion')" />

                            <x-input id="fechaPresentacion" class="block mt-1 w-full"
                                     type="datetime-local"
                                     name="fechaPresentacion"
                                     disabled
                                     :value="$incidencia->fechaPresentacion->format('Y-m-d\TH:i:s')"
                                     required />
                        </div>




                        <div class="mt-4">
                            <x-label for="motivoPresentacion" :value="__('Motivo Presentacion')" />

                                <x-input class="block mt-1 w-full"
                                         type="text"
                                         disabled
                                         value="{{$incidencia->motivoPresentacion}}"
                                />

                        </div>

                        <div class="mt-4">
                            <x-label for="fechaRespuesta" :value="__('Fecha y hora de Respuesta')" />

                            <x-input id="fechaRespuesta" class="block mt-1 w-full"
                                     type="datetime-local"
                                     name="fechaRespuesta"
                                     disabled
                                     :value="$incidencia->getFechaRespuestaAttribute()->format('Y-m-d\TH:i:s')"
                                     required />
                        </div>

<!-- /////////////////////////////////////////////////////////////////////////////// -->
                        @if( $incidencia->motivoRespuesta != Null)
                        <div class="mt-4">
                            <x-label for="motivoRespuesta" :value="__('Motivo Respuesta')" />

                                <x-input class="block mt-1 w-full"
                                         type="text"
                                         disabled
                                         value="{{$incidencia->motivoRespuesta}}"
                                />

                        </div>
                        @else
                        <div class="mt-4">
                            <x-label for="motivoRespuesta" :value="__('Motivo Respuesta')" />

                                <x-input class="block mt-1 w-full"
                                         type="text"
                                         disabled
                                         value="No hay motivo"
                                />

                        </div>
                        @endif

<!-- /////////////////////////////////////////////////////////////////////////////// -->

                        <div class="flex items-center justify-end mt-4">
                            <x-button type="button" class="bg-red-800 hover:bg-red-700">
                                <a href={{route('incidencias.index')}}>
                                    {{ __('Volver') }}
                                </a>
                            </x-button>
                        </div>
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>
