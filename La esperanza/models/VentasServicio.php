<?php

namespace Model;

class VentasServicio extends ActiveRecord {
    protected static $tabla = 'ventasproducto';
    protected static $columnasDB = ['id','ventaId','productoId'];

    public $id;
    public $ventaId;
    public $productoId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->ventaId = $args['ventaId'] ?? '';
        $this->productoId = $args['productoId'] ?? '';
    }
}