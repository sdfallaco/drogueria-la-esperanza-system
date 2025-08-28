<div class="barra">
    <p>Bienvenido: <?php echo $nombre ?? ''; ?></p>
    <a class="boton" href="/logout">Cerras sesion</a>
</div>

<?php if(isset($_SESSION['admin'])) {


} else {

} ?>