<x-app-layout>
    <x-slot name="header">
        <nav class="font-semibold text-xl text-gray-800 leading-tight" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                {{-- <li class="flex items-center">
                  <a href="#">Home</a>
                  <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li> --}}
                <li class="flex items-center">
                    <a href="{{ route('sanitarios.index') }}">sanitarios</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li>
                <li>
                    <a href="#" class="text-gray-500" aria-current="page">Editar sanitario</a>
                </li>
            </ol>
        </nav>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="font-semibold text-lg px-6 py-4 bg-white border-b border-gray-200">
                    Información del sanitario
                </div>

                        
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('sanitarios.update', $sanitario->id) }}">
                        <!-- el put se pone a parte porque no se podía en los formulario poner put solo post eso lo modifica -->
                        @csrf
                        @method('put')

                        
                        

                            <div>
                                <x-label for="name" :value="__('Nombre')" />

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$sanitario->user->name" required autofocus />
                            </div>


                            <div class="mt-4">
                                <x-label for="cargo_id" :value="__('Cargo')" />


                                <x-select id="cargo_id" name="cargo_id" required>
                                    <option value="">{{__('Elige una opción')}}</option>
                                    @foreach ($cargos as $cargo)
                                    <option value="{{$cargo->id}}" @if ($sanitario->cargo_id == $cargo->id) selected @endif>{{$cargo->name}}</option>
                                    @endforeach
                                </x-select>
                            </div>

                            <div class="mt-4">
                                <x-label for="profesion_id" :value="__('Profesion')" />


                                <x-select id="profesion_id" name="profesion_id" required>
                                    <option value="">{{__('Elige una opción')}}</option>
                                    @foreach ($profesiones as $profesion)
                                    <option value="{{$profesion->id}}" @if ($sanitario->profesion_id == $profesion->id) selected @endif>{{$profesion->name}}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            




                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$sanitario->user->email" required />
                            </div>



                        <div class="flex items-center justify-end mt-4">
                            <x-button type="button" class="bg-red-800 hover:bg-red-700">
                                <a href={{route('sanitarios.index')}}>
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


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="font-semibold text-lg px-6 py-4 bg-white border-b border-gray-200">
                    Añadir Especialidad
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors->attach" />
                    <form method="POST" action="{{ route('sanitarios.attachEspecialidad', [$sanitario->id]) }}">
                        @csrf

                        <div class="mt-4">
                            <x-label for="especialidad_id" :value="__('Especialidad')" />


                            <x-select id="especialidad_id" name="especialidad_id" required>
                                <option value="">{{__('Elige un especialidad')}}</option>
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{$especialidad->id}}" @if (old('especialidad_id') == $especialidad->id) selected @endif>{{$especialidad->nombre}} </option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-label for="fechaInicio" :value="__('Fecha en la que empezó la especialidad')" />

                            <x-input id="fechaInicio" class="block mt-1 w-full"
                                     type="date"
                                     name="fechaInicio"
                                     :value="old('fechaInicio')"
                                     required />
                        </div>

                        <div class="mt-4">
                            <x-label for="fechaFin" :value="__('Fecha en la que terminó la especialidad')" />

                            <x-input id="fechaFin" class="block mt-1 w-full"
                                     type="date"
                                     name="fechaFin"
                                     :value="old('fechaFin')"
                                     required />
                        </div>

                        

                        <div class="flex items-center justify-end mt-4">
                            <x-button type="button" class="bg-red-800 hover:bg-red-700">
                                <a href={{route('sanitarios.index')}}>
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
