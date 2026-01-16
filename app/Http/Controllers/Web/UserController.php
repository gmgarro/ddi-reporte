<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'primerApellido' => 'required|string|max:100',
            'segundoApellido' => 'nullable|string|max:100',
            'correo' => 'required|email|unique:users,correo',
            'contrasena' => 'required|min:6',
            'rolId' => 'required|exists:roles,id',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'primerApellido' => $request->primerApellido,
            'segundoApellido' => $request->segundoApellido,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
            'rolId' => $request->rolId,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'primerApellido' => 'required|string|max:100',
            'segundoApellido' => 'nullable|string|max:100',
            'correo' => 'required|email|unique:users,correo,' . $user->id,
            'contrasena' => 'nullable|min:6',
            'rolId' => 'required|exists:roles,id',
        ]);

        $data = $request->only([
            'nombre',
            'primerApellido',
            'segundoApellido',
            'correo',
            'rolId'
        ]);

        if ($request->filled('contrasena')) {
            $data['contrasena'] = Hash::make($request->contrasena);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

        public function destroy(User $user)
    {
        // Evitar borrar el propio usuario logueado
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')
                ->with('error', 'No puedes eliminar tu propio usuario');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado correctamente');
    }

}
