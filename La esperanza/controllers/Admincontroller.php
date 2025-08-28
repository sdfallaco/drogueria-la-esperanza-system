<?php


namespace Controllers;

use Model\AdminPedido;
use MVC\Router;

class AdminController {
    public static function index( Router $router ) {
        session_start();

        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);

        if( !checkdate( $fechas[1], $fechas[2], $fechas[0])) {
            header('Location: /404');
        }

        // Consultar la base de datos
        $consulta = "SELECT ventas.id, ventas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, productos.nombre as servicio, productos.precio  ";
        $consulta .= " FROM ventas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON ventas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN ventasproducto ";
        $consulta .= " ON ventasproducto.ventaId=ventas.id ";
        $consulta .= " LEFT OUTER JOIN productos ";
        $consulta .= " ON productos.id=ventasproducto.productoId ";
        $consulta .= " WHERE fecha =  '${fecha}' "; // si algo falla comentar

        $ventas = AdminPedido::SQL($consulta);


        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'ventas' => $ventas,
            'fecha' => $fecha
        ]);
    }
}