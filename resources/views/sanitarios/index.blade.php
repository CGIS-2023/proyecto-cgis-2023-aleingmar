<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sanitarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @if(\Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 2 || \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 1 )
                <div class="flex items-center mt-4 ml-2">
                    <form method="GET" action="{{ route('sanitarios.create') }}">
                        <x-button type="subit" class="ml-4">
                            
                            
                                {{ __('Crear sanitario') }}
                            
                        </x-button>
                    </form>
                    
                </div>
            @endif

                

                <!-- ////////////////////////////PRUEBA 2: FILTRADO//////////////////////////////// -->
                @if(\Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 2 || 
                \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 1)
                <!-- Filtrar por profesion PRUEBA -->

                <div class="flex items-center mt-4 ml-2" >
                    <form method="GET" action="{{ route('sanitarios.index') }}">
                        <x-select id="profesion_id" name="profesion_id" class="ml-4">
                                    <option value="">{{__('Filtrar por profesion')}}</option> <!-- value en blaco (es como si no tuviera) -->
                                    @foreach ($profesiones as $profesion)
                                    <option value="{{$profesion->id}}" @if (old('profesion_id') == $profesion->id) selected @endif>{{$profesion->name}}</option>
                                    @endforeach
                                    
                        </x-select>

                        <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                                {{ __('Filtrar') }}
                            </x-button>
                            <!-- <<br> -->
                            <!-- <button type="submit">Ver Usuarios</button> -->
                        </div>
                    </form>
                </div>
                
                @endif
                <!-- ///////////////////////FILTRO DE BUSQUEDA///////////////////////////////////// -->
                @if(\Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 2 || 
                \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 1 ||
                Auth::user()->sanitario->cargo->id == 3)

                    <form class="d-flex float-right" role="search" action="{{ route('sanitarios.filtrar') }}">
                        <input name="buscarpor" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" >
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                @endif
                
                <!-- //////////////////////////////////////////////////////////// -->

                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                        <tr class="bg-gray-200 text-gray-900 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">ID</th>
                           
                            <th class="py-3 px-6 text-left">Nombre</th>

                            <th class="py-3 px-6 text-left">Cargo</th>

                            <th class="py-3 px-6 text-left">Profesion</th>

                            <th class="py-3 px-6 text-left">Correo</th>

                            
                            
                            
                            
                            
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">

                        @foreach ($sanitarios as $sanitario)
                            <tr class="border-b border-gray-200">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$sanitario->id}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$sanitario->user->name}}</span>
                                    </div>
                                </td>

                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$sanitario->cargo->name}}</span>
                                    </div>
                                </td>

                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$sanitario->profesion->name}}</span>
                                    </div>
                                </td>

                                

                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$sanitario->user->email}}</span>
                                    </div>
                                </td> 

                                
                                
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-end">

                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{route('sanitarios.show', $sanitario->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </div>

                                        @if(\Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 2 || \Illuminate\Support\Facades\Auth::user()->sanitario->cargo->id == 1 )
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{route('sanitarios.edit', $sanitario->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </div>

                                        
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <form id="delete-form-{{$sanitario->id}}" method="POST" action="{{ route('sanitarios.destroy', $sanitario->id) }}">
                                                @csrf
                                                @method('delete')
                                                <a class="cursor-pointer" onclick="getElementById('delete-form-{{$sanitario->id}}').submit();">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                            </form>
                                        @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $sanitarios->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

