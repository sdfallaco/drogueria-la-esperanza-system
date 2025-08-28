<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">Llena todos los campos para añadir un nuevo servicio</p>
<p class="descripcion-pagina">Agrega el valor con puntos ejemplo: 5.000</p>

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

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>



<form action="../servicios/crear" method="POST" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'; ?>

    <input type="submit" class="boton" value="Guardar Servicio">
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnServicios = document.getElementById('btnServicios');
    const opcionesServicios = document.getElementById('opcionesServicios');
    btnServicios.addEventListener('click', function() {
        opcionesServicios.classList.toggle('oculto');
    });
});
</script>