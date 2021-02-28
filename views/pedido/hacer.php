<?php if(isset($_SESSION['identity'])): ?>
    <h1>Hacer pedido</h1>
    <p>
        <a href="<?= base_url?>carrito/index">Ver los productos y el precio del pedido</a>
    </p>
    <br>

    <h3>Direccion para el envio</h3>
    <form action="<?= base_url?>pedido/add" method="POST">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" required>

        <label for="ciudad">Ciudad</label>
        <input type="text" name="localidad" required>

        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" required>

        <input type="submit" value="Confirmar Pedido">
    </form>
<?php else: ?>
    <h1>Necesitar estar identificado</h1>
    <p>Necesitas iniciar sesion para poder realizar tu pedido</p>
<?php endif; ?>