<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeService {

    public function index(): JsonResponse
    {
        $msg = array(
            'status'  => true,
            'message' => 'conectado api salon de belleza v0',
            'data'    => null
        );
        return response()->json($msg, 200);
    }

    public function auth(Request $data): JsonResponse
    {
        $name_email = trim($data->input('name_email', ''));
        $password   = trim($data->input('password', ''));

        if (empty($name_email)) {
            $msg = array(
                'status'  => false,
                'message' => 'Usuario o Correo Obligatorio',
                'data'    => null
            );
            return response()->json($msg, 400);
        }

        if (empty($password)) {
            $msg = array(
                'status'  => false,
                'message' => 'Contraseña Obligatoria',
                'data'    => null
            );
            return response()->json($msg, 400);
        }

        $user = User::where('email', $name_email)
            ->orWhere('name', $name_email)
            ->first();

        if (!$user || !Hash::check($password, $user->password)) {
            $msg = array(
                'status'  => false,
                'message' => 'Credenciales incorrectas',
                'data'    => null
            );
            return response()->json($msg, 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $msg = array(
            'status'  => true,
            'message' => 'Login exitoso',
            'data'    => array(
                'user'  => array(
                    'id'      => $user->id,
                    'name'    => $user->name,
                    'email'   => $user->email,
                    'role_id' => $user->role_id,
                    'role'    => $user->role ? $user->role->nombre : null,
                ),
                'token' => $token
            )
        );
        return response()->json($msg, 200);
    }

    public function logout(Request $data): JsonResponse
    {
        $data->user()->currentAccessToken()->delete();

        $msg = array(
            'status'  => true,
            'message' => 'Sesion cerrada exitosamente',
            'data'    => null
        );
        return response()->json($msg, 200);
    }
}
