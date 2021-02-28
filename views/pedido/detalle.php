<h1>Detalle del pedido</h1>

<?php if(isset($pedido)): ?>
    <?php if(isset($_SESSION['admin'])): ?>
        <h3>Cambiar estado del pedido</h3>
        <form action="<?=base_url?>pedido/estado" method= "POST">
        <input type="hidden" value="<?=$pedido->id?>" name="pedido_id">
            <select name="estado">
                <option value="confirmado" <?= $pedido->estado == "confirmado" ? 'selected': ''?>>Pendiente</option>
                <option value="preparacion" <?= $pedido->estado == "preparacion" ? 'selected': ''?>>En proceso</option>
                <option value="listo" <?= $pedido->estado == "listo" ? 'selected': ''?>>Proceso de envio</option>
                <option value="enviado" <?= $pedido->estado == "enviado" ? 'selected': ''?>>Enviado</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
        <br>
    <?php endif; ?>
        <h3>Datos del Usuario</h3>
        Nombre: <?= $pedido->nombre?> <br>
        Apellidos:  <?= $pedido->apellidos ?> <br>
        Email: <?= $pedido->email ?> <br>
        <br>

        <h3>Datos de Envio</h3>
        Provincia: <?= $pedido->provincia?> <br>
        Ciudad:  <?= $pedido->localidad ?> <br>
        Direccion: <?= $pedido->direccion ?> <br>
        <br>
        <h3>Datos del Pedido:</h3>
            Estado: <?= Utils::showStatus($pedido->estado); ?> <br>
            Numero de Pedido: <?= $pedido->id ?> <br>
            Total a pagar:  <?= $pedido->coste ?> <br>
            Productos:
            <table>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                </tr>
                <?php while($producto = $productos->fetch_object()): ?>
                    <tr>
                        <td>
                            <?php if($producto->imagen != null): ?>
                                <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="camisaDefault" class="img_carrito">
                            <?php else: ?>
                                <img src="<?= base_url ?>assets/img/camiseta.png" alt="T-shirt"  class="img_carrito">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url ?>producto/detalle&id=<?=$producto->id?>"> <?= $producto->nombre ?></a>
                        </td>
                        <td>
                                <?= $producto->precio?>
                        </td>
                        <td>
                                <?= $producto->unidades?>
                        </td>
                    </tr>
                <?php endwhile ?>
            </table>
        
    <?php endif; ?>    