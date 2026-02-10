<?php
namespace App\Services;

use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class HomeService {
    // verificar funccionalidad del api
    public function index(){
        return "conectado api salon de belleza v0";
    }

    // acceso a la plataforma
    public function auth(Request $data){
        $name_email = $data->input('name_email');
        $password = $data->input('password');

        if(isEmpty($name_email)){
            return "Usuario o Correo Obligatorio";
        }

        
        if(isEmpty($password)){
            return "Contraseña Obligatoria";
        }
        
        return "login ok";
    }
}
