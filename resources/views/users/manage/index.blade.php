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

                <h2 class="mb-4 text-center text-xl tracking-wide">{{ isset($user) ? 'Editar usuari' : 'Crear usuari' }}</h2>
                <div class="mb-12 border shadow p-6 rounded-lg">
                    @can('users_manage_create')
                        <form id="form" class="grid grid-cols-1 gap-y-4 justify-center" data-qa="form_user_create"
                              action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                              method="POST">
                            @csrf
                            @if(isset($user))
                                @method('PUT')
                            @endif
                            <input type="hidden" name="_method" value="PUT">
                            <label class="tracking-wide" for="name">Nom</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="name" name="name" type="text" value="{{ isset($user) ? $user->name : '' }}">
                            <label class="tracking-wide" for="email">Email</label>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="email" name="email" type="email" value="{{ isset($user) ? $user->email : '' }}">
                            <label class="tracking-wide" for="password">Contrasenya</label>
                            <p class="text-xs text-red-600">Ha de contindre mínim 8 caràcters.</p>
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="password" name="password" type="password">
                            <label class="tracking-wide" for="superadmin">Superadmin</label>
                            <input type="hidden" name="superadmin" value="0"> <!-- Agrega un campo oculto con valor predeterminado 0 -->
                            <input class="rounded-lg text-gray-500 text-sm" style="border: none; --tw-ring-color: #45B39D" id="superadmin" name="superadmin" type="checkbox" {{ isset($user) && $user->superadmin ? 'checked' : '' }}>
                            <button id="submitButton" class="bg-white rounded-lg py-1 my-2 mx-64 text-sm font-light shadow" style="color: #566573; outline: none" type="submit">{{ isset($user) ? 'Actualizar' : 'Crear' }}</button>
                        </form>
                    @endcan
                </div>
                <script>
                    function updateUser() {
                        document.getElementById('form').submit();
                    }
                </script>
                <script>
                    const superadminCheckbox = document.getElementById('superadmin');
                    const hiddenSuperadminField = document.querySelector('input[name="superadmin"]');

                    superadminCheckbox.addEventListener('change', function() {
                        hiddenSuperadminField.value = this.checked ? 'true' : 'false';
                    });

                    // Actualizar el valor del campo oculto cada vez que se envíe el formulario
                    document.getElementById('form').addEventListener('submit', function() {
                        hiddenSuperadminField.value = superadminCheckbox.checked ? 'true' : 'false';
                    });
                </script>

                <h2 class="mb-4 text-center text-xl tracking-wide">Llista d'usuaris</h2>
                <div class="overflow-y-auto" style="max-height: 500px;">
                    <table class="min-w-full">
                        <thead class="bg-gray-200 border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Id</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Nom</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Email</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Superadmin</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 text-left">Accions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 cursor-pointer">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>
                                <td class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="text-sm text-gray-900 font-light px-4 py-4 whitespace-nowrap">{{ $user->superadmin }}</td>
                                <td class="relative px-4 py-4">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border p-2 rounded-lg bg-red-100 hover:bg-red-50 hover:text-red-400">Borrar</button>
                                        </form>
                                        <button style="outline: none" class="border p-2 rounded-lg bg-gray-200 hover:bg-red-50 hover:text-gray-600" onclick="openEditModal(event, {{ $user }})">Editar</button>
                                        <script>
                                            function openEditModal(event, user) {
                                                event.preventDefault();
                                                const modal = document.getElementById('modal');
                                                const name = document.getElementById('name');
                                                const email = document.getElementById('email');
                                                const password = document.getElementById('password');
                                                const superadmin = document.getElementById('superadmin');
                                                const form = document.getElementById('form');
                                                const submitButton = document.getElementById('submitButton');

                                                // Llenar los campos del formulario con los datos del usuario
                                                name.value = user.name;
                                                email.value = user.email;
                                                password.value = user.password;
                                                superadmin.checked = user.superadmin;

                                                // Establecer la acción del formulario para la edición del usuario
                                                form.action = `/users/${user.id}`;

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
