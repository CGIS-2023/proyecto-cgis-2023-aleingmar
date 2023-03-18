<x-app-layout>
    <x-slot name="header">
        <nav class="font-semibold text-xl text-gray-800 leading-tight" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                {{-- <li class="flex items-center">
                  <a href="#">Home</a>
                  <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li> --}}
                <li class="flex items-center">
                    <a href="{{ route('citas.index') }}">Citas</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li>
                <li>
                    <a href="#" class="text-gray-500" aria-current="page">Editar cita</a>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="font-semibold text-lg px-6 py-4 bg-white border-b border-gray-200">
                    Información de la cita
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('citas.update', $cita->id) }}">
                        @csrf
                        @method('put')
                        <div class="mt-4">
                            <x-label for="fecha_contratacion" :value="__('Fecha y hora')" />

                            <x-input id="fecha_hora" class="block mt-1 w-full"
                                     type="datetime-local"
                                     name="fecha_hora"
                                     :value="$cita->fecha_hora->format('Y-m-d\TH:i:s')"
                                     required />
                        </div>

                        <div class="mt-4">
                            <x-label for="paciente_id" :value="__('Paciente')" />

                            @isset($paciente)
                                <x-input id="paciente_id" class="block mt-1 w-full"
                                         type="hidden"
                                         name="paciente_id"
                                         :value="$paciente->id"
                                         required />
                                <x-input class="block mt-1 w-full"
                                         type="text"
                                         disabled
                                         value="{{$paciente->user->name}} ({{$paciente->nuhsa}})"
                                />
                            @else
                                <x-select id="paciente_id" name="paciente_id" required>
                                    <option value="">{{__('Elige un paciente')}}</option>
                                    @foreach ($pacientes as $paciente)
                                        <option value="{{$paciente->id}}" @if ($cita->paciente_id == $paciente->id) selected @endif>{{$paciente->user->name}} ({{$paciente->nuhsa}})</option>
                                    @endforeach
                                </x-select>
                            @endisset
                        </div>

                        <div class="mt-4">
                            <x-label for="medico_id" :value="__('Médico')" />

                            @isset($medico)
                                <x-input id="medico_id" class="block mt-1 w-full"
                                         type="hidden"
                                         name="medico_id"
                                         :value="$medico->id"
                                         required />
                                <x-input class="block mt-1 w-full"
                                         type="text"
                                         disabled
                                         value="{{$medico->user->name}} ({{$medico->especialidad->nombre}})"
                                />
                            @else
                                <x-select id="medico_id" name="medico_id" required>
                                    <option value="">{{__('Elige un médico')}}</option>
                                    @foreach ($medicos as $medico)
                                        <option value="{{$medico->id}}" @if ($cita->medico_id == $medico->id) selected @endif>{{$medico->user->name}} ({{$medico->especialidad->nombre}})</option>
                                    @endforeach
                                </x-select>
                            @endisset
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button type="button" class="bg-red-800 hover:bg-red-700">
                                <a href={{route('citas.index')}}>
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
                    Prescripciones actuales
                </div>
                {{--<div class="flex items-center mt-4 ml-2">
                    <form method="GET" action="{{ route('medicamentos.create') }}">
                        <x-button type="subit" class="ml-4">
                            {{ __('Crear medicamento') }}
                        </x-button>
                    </form>
                </div>--}}
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                        <tr class="bg-gray-200 text-gray-900 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Medicamento</th>
                            <th class="py-3 px-6 text-left">Inicio</th>
                            <th class="py-3 px-6 text-left">Fin</th>
                            <th class="py-3 px-6 text-left">Tomas/día</th>
                            <th class="py-3 px-6 text-left">Comentarios</th>
                            <th class="py-3 px-6 text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($cita->medicamentos as $medicamento)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$medicamento->nombre}} ({{$medicamento->miligramos}} {{__('mg')}})</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$medicamento->pivot->inicio->format('d/m/Y')}} </span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$medicamento->pivot->fin->format('d/m/Y')}} </span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$medicamento->pivot->tomas_dia}} </span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$medicamento->pivot->comentarios}} </span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">

                                        {{--<div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{route('medicamentos.edit', $medicamento->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </div>--}}
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <form id="detach-form-{{$cita->id}}-{{$medicamento->id}}" method="POST" action="{{ route('citas.detachMedicamento', [$cita->id, $medicamento->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <a class="cursor-pointer" onclick="getElementById('detach-form-{{$cita->id}}-{{$medicamento->id}}').submit();">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                            </form>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="font-semibold text-lg px-6 py-4 bg-white border-b border-gray-200">
                    Añadir prescripción
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors->attach" />
                    <form method="POST" action="{{ route('citas.attachMedicamento', [$cita->id]) }}">
                        @csrf

                        <div class="mt-4">
                            <x-label for="medicamento_id" :value="__('Medicamento')" />


                            <x-select id="medicamento_id" name="medicamento_id" required>
                                <option value="">{{__('Elige un medicamento')}}</option>
                                @foreach ($medicamentos as $medicamento)
                                    <option value="{{$medicamento->id}}" @if (old('medicamento_id') == $medicamento->id) selected @endif>{{$medicamento->nombre}} ({{$medicamento->miligramos}} {{__('mg.')}})</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-label for="inicio" :value="__('Inicio del tratamiento')" />

                            <x-input id="inicio" class="block mt-1 w-full"
                                     type="date"
                                     name="inicio"
                                     :value="old('inicio')"
                                     required />
                        </div>

                        <div class="mt-4">
                            <x-label for="fin" :value="__('Fin del tratamiento')" />

                            <x-input id="fin" class="block mt-1 w-full"
                                     type="date"
                                     name="fin"
                                     :value="old('fin')"
                                     required />
                        </div>

                        <div class="mt-4">
                            <x-label for="tomas_dia" :value="__('Tomas al día')" />


                            <x-select id="tomas_dia" name="tomas_dia" required>
                                <option value="">{{__('Elige una opción')}}</option>
                                @for($i = 1; $i <= 12; $i++)
                                <option :value="$i" @if (old('tomas_dia') == $i) selected @endif>{{$i}}</option>
                                @endfor
                            </x-select>
                        </div>

                        <div>
                            <x-label for="comentarios" :value="__('Comentarios')" />

                            <x-input id="comentarios" class="block mt-1 w-full" type="text" name="comentarios" :value="old('name')" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button type="button" class="bg-red-800 hover:bg-red-700">
                                <a href={{route('medicos.index')}}>
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
