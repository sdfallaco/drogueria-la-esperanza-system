<h1 class="nombre-pagina">Servicios y Productos</h1>
<p class="descripcion-pagina"></p>

<div class="barra">
    <p>Bienvenido: <?php echo $nombre ?? ''; ?></p>
    <a class="boton" href="/logout">Cerras sesion</a>
</div>


<div class="mostrar-botones">
    <button type="button" id="btnServicios">Mostrar Servicios</button>
    <button type="button" id="btnProductos">Mostrar Productos</button>
</div>

<div class="app">
<div class="imagen2"></div>

    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Entrega</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>


    <div id="paso-1" class="seccion">
        <h2>Servicios Disponibles</h2>
        <p class="text-center"></p>
        <div id="productos" class="listado-productos"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Datos Necesarios</h2>
        <p class="text-center">Programa tu entrega: Fecha y Hora</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input
                    id="nombre"
                    type="text"
                    placeholder="Tu Nombre"
                    value="<?php echo $nombre; ?>"
                    disabled
                />
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input
                    id="fecha"
                    type="date"
                    min="<?php echo date('Y-m-d'); ?>"
                />
            </div>

            <div class="campo">
                <label for="hora">Hora</label>
                <input
                    id="hora"
                    type="time"
                />
            </div>

            <div class="campo">
                <label for="Direccion-domicilio">Direccion</label>
                <input
                    id="direccion"
                    type="text"
                    placeholder="Domicilio aun no disponible"
                    disabled/>
            </div>

            <input type="hidden" id="id" value="<?php echo $id; ?>" >

        </form>
    </div>
    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la informacion sea correcta</p>
    </div>

    <div class="paginacion">

        <button
            id="anterior"
            class="boton"
        >&laquo; Anterior</button>

        <button
            id="siguiente"
            class="boton"
        >Siguiente &raquo;</button>

    </div>

</div>

<?php
    $script = "
    
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>

    "


?>