<?php


namespace Controllers;

use MVC\Router;
use Model\Producto;

class ServicioController {
    public static function index(Router $router) {


        session_start();

        isAdmin();

        $productos = Producto::all();

        $router->render('servicios/index',[
            'nombre' => $_SESSION['nombre'],
            'productos' => $productos
        ]);
    }

    public static function crear(Router $router) {

        session_start();
        isAdmin();

        $producto = new Producto;
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $producto->sincronizar($_POST);
            $alertas = $producto->validar();

            if(empty($alertas)) {
                $producto->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/crear',[
            'nombre' => $_SESSION['nombre'],
            'servicio' => $producto,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        
        session_start();
        isAdmin();

        if(!is_numeric($_GET['id'])) return;
        $producto = Producto::find($_GET['id']);
        $alertas = [];
         
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $producto->sincronizar($_POST);
            $alertas = $producto->validar();

            if(empty($alertas)) {
                $producto->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/actualizar',[
            'nombre' => $_SESSION['nombre'],
            'producto' => $producto,
            'alertas' => $alertas
        ]);
        
    }

    public static function eliminar(Router $router) {
        session_start();
        isAdmin();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $producto = Producto::find($id);
            $producto->eliminar();
            header('Location: /servicios');
        }

        $router->render('servicios/eliminar',[
            'nombre' => $_SESSION['nombre']
        ]);
    }
}