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

                <h2 class="mb-4 text-center text-xl tracking-wide">{{ isset($video) ? 'Editar vídeo' : 'Crear vídeo' }}</h2>
                <div class="mb-12 border shadow p-6 rounded-lg">
                    @can('videos_manage_create')
                        <form id="form" class="grid grid-cols-1 gap-y-4 justify-center" data-qa="form_video_create"
                              action="{{ isset($video) ? route('videos.update', $video->id) : route('videos.store') }}"
                              method="POST">
                            @csrf
                            @if(isset($video))
                                @method('PUT')
                            @endif
                            <label class="tracking-wide" for="title">Título</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="title" name="title" type="text" value="{{ isset($video) ? $video->title : '' }}">
                            <label class="tracking-wide" for="description">Descripción</label>
                            <textarea class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" name="description" id="description" cols="30" rows="5">{{ isset($video) ? $video->description : '' }}</textarea>
                            <label class="tracking-wide" for="url">URL</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="url" name="url" type="url" value="{{ isset($video) ? $video->url : '' }}">
                            <button id="submitButton" class="bg-white rounded-lg py-1 my-2 mx-64 text-sm font-light shadow" style="color: #566573; outline: none" type="button">{{ isset($video) ? 'Actualizar' : 'Crear' }}</button>
                        </form>
                    @endcan
                </div>
                    <script>
                        function updateVideo() {
                            document.getElementById('form').submit();
                        }
                    </script>

                <h2 class="mb-4 text-center text-xl tracking-wide">Llistat dels videos</h2>
                <div class="overflow-y-auto" style="max-height: 500px;">
                    <table class="min-w-full">
                        <thead class="bg-gray-200 border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Id</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Title</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Descripció</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-4 text-left">URL</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Accions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videos as $video)
                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 cursor-pointer">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $video->id }}</td>
                                <td class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">{{ $video->title }}</td>
                                <td class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">{{ $video->description }}</td>
                                <td class="text-sm text-gray-900 font-light px-2 py-4 whitespace-nowrap overflow-hidden text-ellipsis" style="max-width: 150px;">{{ $video->url }}</td>
                                <td class="relative px-4 py-4">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border p-2 rounded-lg bg-red-100 hover:bg-red-50 hover:text-red-400">Borrar</button>
                                        </form>
                                        <button style="outline: none" class="border p-2 rounded-lg bg-gray-200 hover:bg-red-50 hover:text-gray-600" onclick="openEditModal({{ $video }})">Editar</button>
                                        <script>
                                            function openEditModal(video) {
                                                const modal = document.getElementById('modal');
                                                const title = document.getElementById('title');
                                                const description = document.getElementById('description');
                                                const url = document.getElementById('url');
                                                const form = document.getElementById('form');
                                                const submitButton = document.getElementById('submitButton');
                                                title.value = video.title;
                                                description.value = video.description;
                                                url.value = video.url;
                                                form.action = `/videos/${video.id}`;
                                                form.method = 'POST';
                                                submitButton.innerText = 'Actualizar';
                                                submitButton.onclick = function() {
                                                    form.method = 'POST';
                                                    const input = document.createElement('input');
                                                    input.setAttribute('type', 'hidden');
                                                    input.setAttribute('name', '_method');
                                                    input.setAttribute('value', 'PUT');
                                                    form.appendChild(input);
                                                    form.submit();
                                                };
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
