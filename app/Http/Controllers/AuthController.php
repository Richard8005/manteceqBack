<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerificarEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Registro de usuario
     */
    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'rol' => 'required|string'
        ]);

        $pin = rand(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'pin' => $pin
        ]);

        // Enviar el PIN al correo del usuario
        Mail::to($user->Email)->send(new VerificarEmail($pin));

        return response()->json([
            'message' => 'Usuario creado satisfactoriamente! Por favor verifique su email',
            'user' => $user,
        ], 201);
    }

    /**
     * Verificación de correo electrónico mediante PIN
     */
    public function verificarEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'pin' => 'required|integer',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        if ($user->Pin != $request->pin) {
            return response()->json(['error' => 'PIN incorrecto'], 400);
        }

        // Eliminar el PIN después de la verificación
        $user->Pin = null;
        $user->save();

        return response()->json(['message' => 'Correo verificado exitosamente'], 200);
    }

    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt(['Email' => $credentials['email'], 'password' => $credentials['password']])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = $request->user();

        // Verificar si el usuario ha validado su correo
        if ($user->Pin != null) {
            return response()->json(['message' => 'Verificar correo antes de iniciar sesión'], 403);
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            'rol' => $user->Rol,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }

    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->delete();

        return response()->json(['message' => 'Cerró sesión exitosamente']);
    }

    /**
     * Obtener el objeto User como json
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
