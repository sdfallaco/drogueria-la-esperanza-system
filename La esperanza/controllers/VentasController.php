<?php

namespace Controllers;

use MVC\Router;

class VentasController {
    public static function index(Router $router){

        session_start();

        isAuth();

        $router->render('ventas/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']

        ]);
    }
}