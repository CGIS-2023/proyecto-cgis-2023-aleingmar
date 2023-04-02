<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accesos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


            <!-- solo lo pueden crear el admin y la direccion -->

            @if(\Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 2 || \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 1 )
                <div class="flex items-center mt-4 ml-2">
                    <form method="GET" action="{{ route('accesos.create') }}">
                        <x-button type="subit" class="ml-4">
                            
                            
                                {{ __('Crear acceso') }}
                            
                        </x-button>
                    </form>
                </div>
            @endif



            <!-- ///////////////////////////////////////////////// -->
            
                <form class="d-flex float-right" role="search" action="{{ route('accesos.index') }}">
                        <input name="buscarFecha" class="form-control me-2" type="date" placeholder="Search" aria-label="Search" >
                        <button class="btn btn-success" type="submit">Buscar</button>
                    </form>

            
            <!-- ///////////////////////////////////////////////// -->
            
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                        <tr class="bg-gray-200 text-gray-900 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">ID</th>

                            <th class="py-3 px-6 text-left">Nombre</th>

                            <th class="py-3 px-6 text-left">Profesion</th>

                           
                            <th class="py-3 px-6 text-left">Entrada</th>
                            
                           
                            <th class="py-3 px-6 text-left">Salida</th>

                            <th class="py-3 px-6 text-left">N_horas</th>
                            
                            
                            
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">

                        @foreach ($accesos as $acceso)
                            <tr class="border-b border-gray-200">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$acceso->id}}</span>
                                    </div>
                                </td>

                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$acceso->sanitario->user->name}}</span>
                                    </div>
                                </td>

                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$acceso->sanitario->profesion->name}}</span>
                                    </div>
                                </td>

                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$acceso->entrada->format('d/m/Y H:i')}}</span>
                                    </div>
                                </td>

                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$acceso->salida->format('d/m/Y H:i')}}</span>
                                    </div>
                                </td>
                                
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$acceso->getHorasJornadaAttribute()}}</span>
                                    </div>
                                </td>
                                
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-end">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{route('accesos.show', $acceso->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </div>

                                        <!-- solo lo pueden borrar y modificar el admin y la direccion -->

                                        @if(\Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 2 || \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 1 )
                            
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{route('accesos.edit', $acceso->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </div>
                                        @endif


                                        

                                        <!-- PRUEBA DE EXCLAMACION PARA PONER INCIDENCIA -->
                                        @if(\Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 4 || \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 3 || \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 1)
                            
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <form method="POST" action="{{route('incidencias.create')}}">
                                                <button id="{{$acceso->id}}" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                    </svg>
                                                </button>
                                               
                                            </form>
                                        </div>
                                        @endif
                                        <!-- PRUEBA DE EXCLAMACION PARA PONER INCIDENCIA -->
     












                                        @if(\Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 2 || \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 1 )
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <form id="delete-form-{{$acceso->id}}" method="POST" action="{{ route('accesos.destroy', $acceso->id) }}">
                                                @csrf
                                                @method('delete')
                                                <a class="cursor-pointer" onclick="getElementById('delete-form-{{$acceso->id}}').submit();">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                            </form>

                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $accesos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

