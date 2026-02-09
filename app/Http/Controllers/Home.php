<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    //Probar funcionalidad del api rest
    public function index(){
        return "conectado";
    }
}
