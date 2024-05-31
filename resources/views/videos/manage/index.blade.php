<x-casteaching-layout>

    <!-- component -->
    <div class="">
        <div class="w-full max-w-4xl mx-auto">
            <div class="py-16 px-4">
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

                <h2 class="mb-4 text-center text-xl tracking-wide">{{ isset($video) ? 'Editar video' : 'Crear video' }}</h2>
                <div class="mb-12 border shadow p-6 rounded-lg">
                    @can('videos_manage_create')
                        <form id="form" class="grid grid-cols-1 gap-y-4 justify-center" data-qa="form_video_create"
                              action="{{ isset($video) ? route('videos.update', $video->id) : route('videos.store') }}"
                              method="POST">
                            @csrf
                            @if(isset($video))
                                @method('PUT')
                            @endif
                            <label class="tracking-wide" for="title">Títol</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="title" name="title" type="text" value="{{ isset($video) ? $video->title : '' }}">
                            <label class="tracking-wide" for="description">Descripció</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="description" name="description" type="text" value="{{ isset($video) ? $video->description : '' }}">
                            <label class="tracking-wide" for="url">URL</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="url" name="url" type="url" value="{{ isset($video) ? $video->url : '' }}">
                            <label class="tracking-wide mt-4" for="series">Selecciona una serie:</label>
                            <select id="series" name="serie_id" class="block w-full mt-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @if($series->isEmpty())
                                    <option value="" disabled>No hi ha ninguna serie</option>
                                @else
                                    @foreach($series as $serie)
                                        <option value="{{ $serie->id }}">{{ $serie->nom }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <button id="submitButton" class="bg-white rounded-lg py-1 my-2 mx-64 text-sm font-light shadow" style="color: #566573; outline: none" type="submit">{{ isset($video) ? 'Actualizar' : 'Crear' }}</button>
                        </form>
                    @endcan
                </div>
                <script>
                    function updateVideo() {
                        document.getElementById('form').submit();
                    }
                </script>

                <h2 class="mb-4 text-center text-xl tracking-wide">Lista de videos</h2>
                <div class="overflow-y-auto" style="max-height: 500px;">
                    <table class="min-w-full">
                        <thead class="bg-gray-200 border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">ID</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Títol</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Descripció</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">URL</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Serie id</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Accions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videos as $video)
                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 cursor-pointer">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $video->id }}</td>
                                <td class="text-sm font-light px-4 py-4 whitespace-nowrap text-blue-600">
                                    <a href="/videos/{{ $video->id }}">{{ $video->title }}</a>
                                </td>
                                <td class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">{{ $video->description }}</td>
                                <td class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">{{ $video->url }}</td>
                                <td class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">{{ $video->serie_id }}</td>
                                <td class="relative px-4 py-4">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border p-2 rounded-lg bg-red-100 hover:bg-red-50 hover:text-red-400">Borrar</button>
                                        </form>
                                        <button style="outline: none" class="border p-2 rounded-lg bg-gray-200 hover:bg-red-50 hover:text-gray-600" onclick="openEditModal(event, {{ $video }})">Editar</button>
                                        <script>
                                            function openEditModal(event, video) {
                                                event.preventDefault();
                                                const title = document.getElementById('title');
                                                const description = document.getElementById('description');
                                                const url = document.getElementById('url');
                                                const serie_id = document.getElementById('series');
                                                const form = document.getElementById('form');
                                                const submitButton = document.getElementById('submitButton');

                                                // Set form values
                                                title.value = video.title;
                                                description.value = video.description;
                                                url.value = video.url;
                                                serie_id.value = video.serie_id;

                                                // Set form action to the update route
                                                form.action = `/videos/${video.id}`;

                                                // Include the method spoofing input
                                                const methodInput = document.createElement('input');
                                                methodInput.setAttribute('type', 'hidden');
                                                methodInput.setAttribute('name', '_method');
                                                methodInput.setAttribute('value', 'PUT');
                                                form.appendChild(methodInput);

                                                // Change submit button text
                                                submitButton.innerText = 'Actualitzar';
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
