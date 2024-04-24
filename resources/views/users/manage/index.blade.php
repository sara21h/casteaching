<x-casteaching-layout>

    <!-- component -->
    <div class="flex justify-center items-center">
        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
            <div class="py-12 inline-block min-w-full sm:px-6 lg:px-8">
                @if(session()->has('success'))
                    <div id="success" class="bg-green-100 rounded-lg border-blue-500 text-green-700 mb-4 px-4 py-4" role="alert">
                        <p class="font-bold text-center">Usuari creat correctament!</p>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('success').style.display = 'none';
                        }, 2000);
                    </script>
                @endif
                @if(session()->has('deleted'))
                    <div id="deleted" class="bg-red-100 rounded-lg border-blue-500 text-red-700 mb-4 px-4 py-4" role="alert">
                        <p class="font-bold text-center">Usuari borrat correctament!</p>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('deleted').style.display = 'none';
                        }, 2000);
                    </script>
                @endif


                <h2 class="mb-4 text-xl tracking-wide">Crear usuari</h2>
                <div class="mb-12 border shadow p-4 rounded-lg">
                    @can('videos_manage_create')
                        <form class="grid grid-cols-1 gap-y-4 justify-center" data-qa="form_video_create" action="#" method="POST">
                            @csrf
                            <label class="tracking-wide" style="" for="name">Nom</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="name" name="name" type="text">
                            <label class="tracking-wide" for="email">Email</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="email" name="email" type="text">
                            <label class="tracking-wide" for="password">Contrasenya</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="password" name="password" type="text">
                            <label class="tracking-wide" for="superadmin">Superadmin</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="superadmin" name="superadmin" type="number">
                            <button class="bg-white rounded-lg py-1 my-2 mx-64 text-sm font-light shadow" style="color: #566573; outline: none" type="submit">Crear</button>
                        </form>
                    @endcan
                </div>
                <h2 class="mb-4 text-center text-xl tracking-wide">Llistat dels usuaris</h2>
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-200 border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Id
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Nom
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Email
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Contrasenya
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Superadmin
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 pb-4 pt-10 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 pb-4 pt-10 whitespace-nowrap">
                                    {{ $user->name }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 pb-4 pt-10 whitespace-nowrap">
                                    {{ $user->email }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-2 pb-4 pt-10 whitespace-nowrap">
                                    {{ $user->password }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-2 pb-4 pt-10 whitespace-nowrap">
                                    {{ $user->superadmin }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 pb-4 pt-10 whitespace-nowrap">

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
