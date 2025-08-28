<h1 class="nombre-pagina">Panel de Administracion</h1>

<div class="barra">
    <p>Bienvenido: <?php echo $nombre ?? ''; ?></p>
    <a class="boton" href="/logout">Cerras sesion</a>
</div>

<div class="mostrar-botones">
    <button type="button" id="btnServicios">Servicios</button>
    <div id="opcionesServicios" class="opciones-servicios oculto">
        <?php if(isset($_SESSION['admin'])) { ?>
        <div class="barra-servicios">
            <a class="despliegue boton-servicios" href="/admin">Ver Pedidos</a>
            <a class="despliegue boton-servicios" href="/servicios">Ver Servicios</a>
            <a class="despliegue boton-servicios" href="/servicios/crear">Nuevo Servicio</a>
        </div>
        <?php } ?>
    </div>
    <button type="button" id="btnProductos">Productos</button>
    <button type="button" id="btnProductos">Usuarios</button>
    <button type="button" id="btnProductos">Movimientos</button>
</div>


<h2 class="subh2">Buscar Pedidos</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo1">
            <label for="fecha"></label>
            <input 
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo $fecha; ?>"
            />
        </div>

    </form>

</div>

<?php
    if(count($ventas) === 0) {
        echo "<h2 class='subh2'>No hay registro de pedidos</h2>";
    }
?>


<div id="pedidos-admin">

    <ul class="pedidos">
        <?php
            $idVenta = 0;
            foreach( $ventas as $key => $venta) {
                if($idVenta !== $venta->id){
                    $total = 0;
        ?>
        <li>
            <p>ID: <span><?php echo $venta->id; ?></span></p>
            <p>Hora: <span><?php echo $venta->hora; ?></span></p>
            <p>Cliente: <span><?php echo $venta->cliente; ?></span></p>
            <p>Email: <span><?php echo $venta->email; ?></span></p>
            <p>Telefono: <span><?php echo $venta->telefono; ?></span></p>

            <h3 class="subh3">Servicios</h3>
            <?php 
            $idVenta = $venta->id;
        } //Fin de if 
            $total += $venta->precio;
        ?>
                <p class="servicio"><?php echo $venta->servicio . " " . $venta->precio; ?></p>
            <?php 
                $actual = $venta->id;
                $proximo = $ventas[$key + 1]->id ?? 0;

                if(esUltimo($actual, $proximo)){ ?>
                    <p class="total">Total: <span>$ <?php echo $total; ?>Mil</span></p>

                    <form action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $venta->id; ?>">
                        <input type="submit" class="boton-eliminar" value="Eliminar">
                    </form>

                <?php }
        } // Fin de Foreach ?>
    </ul>

</div>

<?php

    $script = "<script src='build/js/buscador.js'></script>"

?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnServicios = document.getElementById('btnServicios');
    const opcionesServicios = document.getElementById('opcionesServicios');
    btnServicios.addEventListener('click', function() {
        opcionesServicios.classList.toggle('oculto');
    });
});
</script>