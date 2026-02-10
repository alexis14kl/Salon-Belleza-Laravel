<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerService
{
    public function index(): JsonResponse
    {
        $customers = Customer::clientes()->orderBy('nombre')->get();

        $msg = array(
            'status'  => true,
            'message' => 'Listado de clientes',
            'data'    => $customers
        );
        return response()->json($msg, 200);
    }

    public function prospectos(): JsonResponse
    {
        $prospectos = Customer::prospectos()->orderBy('nombre')->get();

        $msg = array(
            'status'  => true,
            'message' => 'Listado de prospectos',
            'data'    => $prospectos
        );
        return response()->json($msg, 200);
    }

    public function store(Request $data): JsonResponse
    {
        $nombre   = trim($data->input('nombre', ''));
        $apellido = trim($data->input('apellido', ''));
        $telefono = trim($data->input('telefono', ''));
        $email    = trim($data->input('email', ''));
        $role_id  = $data->input('role_id', 2);

        if (empty($nombre)) {
            $msg = array(
                'status'  => false,
                'message' => 'El nombre es obligatorio',
                'data'    => null
            );
            return response()->json($msg, 400);
        }

        if (empty($apellido)) {
            $msg = array(
                'status'  => false,
                'message' => 'El apellido es obligatorio',
                'data'    => null
            );
            return response()->json($msg, 400);
        }

        if (empty($telefono)) {
            $msg = array(
                'status'  => false,
                'message' => 'El teléfono es obligatorio',
                'data'    => null
            );
            return response()->json($msg, 400);
        }

        if (!in_array($role_id, [2, 3])) {
            $msg = array(
                'status'  => false,
                'message' => 'El tipo debe ser Cliente (2) o Prospecto (3)',
                'data'    => null
            );
            return response()->json($msg, 400);
        }

        if (!empty($email) && Customer::where('email', $email)->exists()) {
            $msg = array(
                'status'  => false,
                'message' => 'El email ya está registrado',
                'data'    => null
            );
            return response()->json($msg, 409);
        }

        $customer = Customer::create([
            'nombre'    => $nombre,
            'apellido'  => $apellido,
            'telefono'  => $telefono,
            'email'     => !empty($email) ? $email : null,
            'direccion' => $data->input('direccion'),
            'notas'     => $data->input('notas'),
            'role_id'   => $role_id,
        ]);

        $msg = array(
            'status'  => true,
            'message' => 'Cliente creado exitosamente',
            'data'    => $customer
        );
        return response()->json($msg, 201);
    }

    public function show($id): JsonResponse
    {
        $customer = Customer::find($id);

        if (!$customer) {
            $msg = array(
                'status'  => false,
                'message' => 'Cliente no encontrado',
                'data'    => null
            );
            return response()->json($msg, 404);
        }

        $msg = array(
            'status'  => true,
            'message' => 'Cliente encontrado',
            'data'    => $customer
        );
        return response()->json($msg, 200);
    }

    public function update(Request $data, $id): JsonResponse
    {
        $customer = Customer::find($id);

        if (!$customer) {
            $msg = array(
                'status'  => false,
                'message' => 'Cliente no encontrado',
                'data'    => null
            );
            return response()->json($msg, 404);
        }

        $nombre   = trim($data->input('nombre', ''));
        $apellido = trim($data->input('apellido', ''));
        $telefono = trim($data->input('telefono', ''));
        $email    = trim($data->input('email', ''));
        $role_id  = $data->input('role_id', $customer->role_id);

        if (empty($nombre)) {
            $msg = array(
                'status'  => false,
                'message' => 'El nombre es obligatorio',
                'data'    => null
            );
            return response()->json($msg, 400);
        }

        if (empty($apellido)) {
            $msg = array(
                'status'  => false,
                'message' => 'El apellido es obligatorio',
                'data'    => null
            );
            return response()->json($msg, 400);
        }

        if (empty($telefono)) {
            $msg = array(
                'status'  => false,
                'message' => 'El teléfono es obligatorio',
                'data'    => null
            );
            return response()->json($msg, 400);
        }

        if (!in_array($role_id, [2, 3])) {
            $msg = array(
                'status'  => false,
                'message' => 'El tipo debe ser Cliente (2) o Prospecto (3)',
                'data'    => null
            );
            return response()->json($msg, 400);
        }

        if (!empty($email) && Customer::where('email', $email)->where('id', '!=', $id)->exists()) {
            $msg = array(
                'status'  => false,
                'message' => 'El email ya está registrado por otro cliente',
                'data'    => null
            );
            return response()->json($msg, 409);
        }

        $customer->update([
            'nombre'    => $nombre,
            'apellido'  => $apellido,
            'telefono'  => $telefono,
            'email'     => !empty($email) ? $email : null,
            'direccion' => $data->input('direccion'),
            'notas'     => $data->input('notas'),
            'role_id'   => $role_id,
        ]);

        $msg = array(
            'status'  => true,
            'message' => 'Cliente actualizado exitosamente',
            'data'    => $customer
        );
        return response()->json($msg, 200);
    }

    public function destroy($id): JsonResponse
    {
        $customer = Customer::find($id);

        if (!$customer) {
            $msg = array(
                'status'  => false,
                'message' => 'Cliente no encontrado',
                'data'    => null
            );
            return response()->json($msg, 404);
        }

        $customer->delete();

        $msg = array(
            'status'  => true,
            'message' => 'Cliente eliminado exitosamente',
            'data'    => null
        );
        return response()->json($msg, 200);
    }

    public function convertToClient($id): JsonResponse
    {
        $customer = Customer::find($id);

        if (!$customer) {
            $msg = array(
                'status'  => false,
                'message' => 'Prospecto no encontrado',
                'data'    => null
            );
            return response()->json($msg, 404);
        }

        if ($customer->role_id != 3) {
            $msg = array(
                'status'  => false,
                'message' => 'Solo los prospectos pueden ser convertidos a cliente',
                'data'    => null
            );
            return response()->json($msg, 400);
        }

        $customer->update(['role_id' => 2]);

        $msg = array(
            'status'  => true,
            'message' => 'Prospecto convertido a cliente exitosamente',
            'data'    => $customer
        );
        return response()->json($msg, 200);
    }
}
