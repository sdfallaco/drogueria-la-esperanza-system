<?php

namespace Controllers;

use Model\Venta;
use Model\Producto;
use Model\VentasServicio;

class APIController {
    public static function index() {
        $productos = Producto::all();
        echo json_encode($productos);
    }

    public static function guardar() {

        // Almacena la venta y el ID
        $venta = new Venta($_POST);
        $resultado = $venta->guardar();

        $id = $resultado['id'];

        //Almacena la venta y el servicio

        $idProductos = explode(",", $_POST['productos']);

        foreach($idProductos as $idproducto) {
            $args = [
                'ventaId' => $id,
                'productoId' => $idproducto
            ];
            $ventaServicio = new VentasServicio($args);
            $ventaServicio->guardar();
        }

        $respuesta = [
            'resultado' => $resultado
        ];

        echo json_encode($respuesta);
    }

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $venta = Venta::find($id);
            $venta->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);

        }

    }

}