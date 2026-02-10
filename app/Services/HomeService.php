<?php
namespace App\Services;

class HomeService {
    // verificar funccionalidad del api
    public function index(){
        return "conectado api salon de belleza v0";
    }

    // acceso a la plataforma
    public function auth(){
        return "login ok";
    }
}
