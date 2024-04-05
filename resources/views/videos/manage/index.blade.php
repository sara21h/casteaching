<x-casteaching-layout>

    <!-- component -->
    <div class="flex justify-center items-center">
        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
            <div class="py-12 inline-block min-w-full sm:px-6 lg:px-8">
                <h2 class="mb-4 text-xl tracking-wide">Crear videos</h2>
                <div class="mb-12 border shadow p-4 rounded-lg">
                    @can('videos_manage_create')
                    <form class="grid grid-cols-1 gap-y-4 justify-center" data-qa="form_video_create" action="" method="POST">
                        <label class="tracking-wide" style="" for="title">Títol</label>
                        <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="title" name="title" type="text">
                        <label class="tracking-wide" for="description">Description</label>
                        <textarea class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" name="description" id="description" cols="30" rows="5"></textarea>
                        <label class="tracking-wide" for="url">URL</label>
                        <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="url" name="url" type="text">
                        <button class="bg-white rounded-lg py-1 mx-64 text-sm font-light shadow" style="color: #566573; outline: none" type="submit">Crear</button>
                    </form>
                    @endcan
                </div>
                <h2 class="mb-4 text-center text-xl tracking-wide">Llistat dels videos</h2>
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-200 border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Id
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Title
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Descripció
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                URL
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Video
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videos as $video)
                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $video->id }}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $video->title }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $video->description }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $video->description }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                <a class="border p-2 rounded-lg bg-gray-100 hover:bg-gray-50 hover:text-gray-400" href="/videos/{{$video->id}}">veure el video</a>
                            </td>
                        </tr>
                        @endforeach
                        <!-- Resto de las filas -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-casteaching-layout>
