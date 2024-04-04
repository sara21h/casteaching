<x-casteaching-layout>

    <!-- component -->
    <div class="flex justify-center items-center">
        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
            <div class="py-12 inline-block min-w-full sm:px-6 lg:px-8">
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
