<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administracion de Servicios</p>

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

<ul class="productos">
    <?php foreach($productos as $producto) { ?>
        <li>
            <p>Nombre: <span><?php echo $producto->nombre; ?></span></p>
            <p>Precio: <span>$<?php echo $producto->precio; ?></span></p>

            <div class="acciones">
                <a class="boton" href="/servicios/actualizar?id=<?php echo $producto->id; ?>">Actualizar</a>

                <form action="/servicios/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                    <input type="submit" value="Borrar" class="boton-eliminar">
                </form>
            </div>
        </li>
    <?php }?>
</ul>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnServicios = document.getElementById('btnServicios');
    const opcionesServicios = document.getElementById('opcionesServicios');
    btnServicios.addEventListener('click', function() {
        opcionesServicios.classList.toggle('oculto');
    });
});
</script>