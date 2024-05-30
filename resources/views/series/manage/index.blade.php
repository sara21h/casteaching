<x-casteaching-layout>

    <!-- component -->
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-4xl mx-auto">
            <div class="py-12 px-4">
                @if(session()->has('success'))
                    <div id="success" class="bg-green-100 rounded-lg border-blue-500 text-green-700 mb-4 px-4 py-4 text-center" role="alert">
                        <p class="font-bold">{{ session('success') }}</p>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('success').style.display = 'none';
                        }, 2000);
                    </script>
                @endif
                @if(session()->has('deleted'))
                    <div id="deleted" class="bg-red-100 rounded-lg border-blue-500 text-red-700 mb-4 px-4 py-4 text-center" role="alert">
                        <p class="font-bold">{{ session('deleted') }}</p>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('deleted').style.display = 'none';
                        }, 2000);
                    </script>
                @endif

                <h2 class="mb-4 text-center text-xl tracking-wide">{{ isset($serie) ? 'Editar serie' : 'Crear serie' }}</h2>
                <div class="mb-12 border shadow p-6 rounded-lg">
                    @can('series_manage_create')
                        <form id="form" class="grid grid-cols-1 gap-y-4 justify-center" data-qa="form_serie_create"
                              action="{{ isset($serie) ? route('series.update', $serie->id) : route('series.store') }}"
                              method="POST">
                            @csrf
                            @if(isset($serie))
                                @method('PUT')
                            @endif
                            <input type="hidden" name="_method" value="PUT">
                            <label class="tracking-wide" for="nom">Nom</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="nom" name="nom" type="text" value="{{ isset($serie) ? $serie->nom : '' }}">
                            <label class="tracking-wide" for="descripcio">Descripció</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="descripcio" name="descripcio" type="text" value="{{ isset($serie) ? $serie->descripcio : '' }}">
                            <button id="submitButton" class="bg-white rounded-lg py-1 my-2 mx-64 text-sm font-light shadow" style="color: #566573; outline: none" type="submit">{{ isset($serie) ? 'Actualizar' : 'Crear' }}</button>
                        </form>
                    @endcan
                </div>
                <script>
                    function updateSerie() {
                        document.getElementById('form').submit();
                    }
                </script>

                <h2 class="mb-4 text-center text-xl tracking-wide">Llista de sèries</h2>
                <div class="overflow-y-auto" style="max-height: 500px;">
                    <table class="min-w-full">
                        <thead class="bg-gray-200 border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Id</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Nom</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Descripció</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">ID del vídeo relacionat</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Accions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($series as $serie)
                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 cursor-pointer">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $serie->id }}</td>
                                <td class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">{{ $serie->nom }}</td>
                                <td class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">{{ $serie->descripcio }}</td>
                                <td class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">{{ $serie->videos_id }}</td>
                                <td class="relative px-4 py-4">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('series.destroy', $serie->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border p-2 rounded-lg bg-red-100 hover:bg-red-50 hover:text-red-400">Borrar</button>
                                        </form>
                                        <button style="outline: none" class="border p-2 rounded-lg bg-gray-200 hover:bg-red-50 hover:text-gray-600" onclick="openEditModal(event, {{ $serie }})">Editar</button>
                                        <script>
                                            function openEditModal(event, serie) {
                                                event.preventDefault();
                                                const modal = document.getElementById('modal');
                                                const nom = document.getElementById('nom');
                                                const descripcio = document.getElementById('descripcio');
                                                const videos_id = document.getElementById('videos_id');
                                                const form = document.getElementById('form');
                                                const submitButton = document.getElementById('submitButton');

                                                // Llenar los campos del formulario con los datos de la serie
                                                nom.value = serie.nom;
                                                descripcio.value = serie.descripcio;
                                                videos_id.value = serie.videos_id;

                                                // Establecer la acción del formulario para la edición de la serie
                                                form.action = `/series/${serie.id}`;

                                                // Cambiar el método del formulario a PUT
                                                form.method = 'POST';  // Cambiar a POST

                                                // Cambiar el texto del botón de enviar
                                                submitButton.innerText = 'Actualizar';

                                                // Mostrar el modal
                                                modal.style.display = 'block';
                                            }
                                        </script>
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

</x-casteaching-layout>


