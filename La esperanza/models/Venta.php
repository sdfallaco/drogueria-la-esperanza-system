<?php

namespace Model;


class Venta extends ActiveRecord {

    protected static $tabla = 'ventas';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId','nombre','servicios', 'valor'];

    public $id;
    public $nombre;
    public $fecha;
    public $hora;
    public $usuarioId;
    public $servicios; 
    public $valor;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->servicios = $args['servicios'] ?? 0; 
        $this->valor = $args['valor'] ?? 0;

    }
}