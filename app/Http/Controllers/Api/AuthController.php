<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
       $request->validate(
    [
            'correo' => 'required|email',
            'contrasena' => 'required',
            ],
            [
                'correo.required' => 'El correo electrónico es obligatorio.',
                'correo.email' => 'El correo electrónico debe tener un formato válido.',
                'contrasena.required' => 'La contraseña es obligatoria.',
            ]
        );
        
        $user = User::where('correo', $request->correo)->first();

        if (!$user || !Hash::check($request->contrasena, $user->contrasena)) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        if($user->rolId!=2)
            {
                return response()->json([
                    'message' => 'Usted no tiene acceso a esta aplicación'
                ], 403);
            }

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'nombre' => $user->nombre,
                'primerApellido' => $user->primerApellido,
                'segundoApellido' => $user->segundoApellido,
                'correo' => $user->correo,
                'rolId' => $user->rolId
            ]
        ]);
    }
}
