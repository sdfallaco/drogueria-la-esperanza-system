<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Completa los siguientes datos para crear tu cuenta</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text"
            id="nombre"
            name="nombre"
            placeholder="Tu Nombre"
            value="<?php echo s($usuario->nombre); ?>"
        />
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            type="text"
            id="apellido"
            name="apellido"
            placeholder="Tu Apellido"
            value="<?php echo s($usuario->apellido); ?>"
        />
    </div>

    <div class="campo">
        <label for="telefono">Telefono</label>
        <input 
            type="tel"
            id="telefono"
            name="telefono"
            placeholder="Tu Telefono"
            value="<?php echo s($usuario->telefono); ?>"
        />
    </div>

    <div class="campo">
        <label for="email">E-mail</label>
        <input 
            type="email"
            id="email"
            name="email"
            placeholder="Tu E-mail"
            value="<?php echo s($usuario->email); ?>"
        />
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <div class="input-password">
            <input 
                type="password"
                id="password"
                name="password"
                placeholder="Tu Password"
            />
            <span class="toggle-password" onclick="togglePasswordVisibility(this)">🔒</span>
        </div>
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>

<script>
    function togglePasswordVisibility(icon) {
        const passwordInput = icon.previousElementSibling;

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.textContent = '👁️';
        } else {
            passwordInput.type = 'password';
            icon.textContent = '🔒';
        }
    }
</script>