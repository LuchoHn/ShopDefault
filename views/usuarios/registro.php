<h1>Registrarse</h1>
<?php

if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'){
    echo "<strong class='alert-green'><h2>Registro completado</h2></strong>";
}elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'){
    echo "<strong class='alert-red'><h2>Registro Fallido, Introduce bien los datos</h2></strong>";
}
if(isset($_SESSION['errores'])){
    if(isset($_SESSION['errores']['nombre'])){
        echo "<div class='alert-red'><p>".$_SESSION['errores']['nombre']."</p></div>";
    }
    if(isset($_SESSION['errores']['apellido'])){
        echo "<div class='alert-red'><p>".$_SESSION['errores']['apellido']."</p></div>";
    }
    if(isset($_SESSION['errores']['email'])){
        echo "<div class='alert-red'><p>".$_SESSION['errores']['email']."</p></div>";
    }
    if(isset($_SESSION['errores']['password'])){
        echo "<div class='alert-red'><p>".$_SESSION['errores']['password']."</p></div>";
    }
}
Utils::deleteSession('register');
Utils::deleteSession('errores');
?>
<form action="<?= base_url?>usuario/save" method='POST'>
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" >
    <label for="apellido">Apellidos</label>
    <input type="text" name="apellido" >
    <label for="email">Email</label>
    <input type="text" name="email" >
    <label for="contrasena">Contraseña</label>
    <input type="password" name="contrasena" >

    <input type="submit" value="Registrase">
</form>