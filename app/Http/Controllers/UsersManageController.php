<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\Feature\Users\UsersManageControllerTest;

class UsersManageController extends Controller
{
    public static function testedBy()
    {
        return UsersManageControllerTest::class;
    }

    public function index()
    {
        return view('users.manage.index',[
            'users' => User::all()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Crear un nuevo usuario
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // Verificar si el checkbox superadmin está marcado
        if ($request->boolean('superadmin')) {
            $user->superadmin = true;
        } else {
            $user->superadmin = null;
        }


        // Guardar el usuario en la base de datos
        $user->save();

        // Asignar al usuario un equipo personal
        add_personal_team($user);

        // Redirigir con un mensaje de éxito
        session()->flash('success', 'Usuari creat correctament');
        return redirect()->route('manage.users');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::findOrFail($id);

        // Actualizar los campos básicos del usuario
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Actualizar el campo superadmin
        if ($request->boolean('superadmin')) {
            $user->superadmin = true;
        } else {
            $user->superadmin = null; // Asegúrate de manejar el caso en el que no esté marcado
        }

        // Guardar los cambios en la base de datos
        $user->save();

        session()->flash('success', 'Usuari editat correctament');
        return redirect()->route('manage.users');
    }



    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('deleted', 'Usuari borrat correctament');
        return redirect()->route('manage.users');
    }
}
