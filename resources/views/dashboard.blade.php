<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Series') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex items-center">
                        <x-application-logo class="block h-12 w-auto" />
                        <h1 class="ml-4 mt-2 text-2xl font-medium text-gray-900">
                            Series de videos
                        </h1>
                    </div>
                </div>

                <div class=""> <!-- Ajusta max-h-64 según el tamaño deseado -->
                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8">
                        @foreach($series as $serie)
                            <div class="bg-white p-4 rounded-lg shadow">
                                <img src="{{ $serie->imatge_url }}" alt="{{ $serie->nom }}" class="w-full h-auto object-cover">
                                <h2 class="mt-2 text-xl text-center font-semibold text-gray-800">{{ $serie->nom }}</h2>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
