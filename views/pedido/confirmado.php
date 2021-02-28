<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == "complete"): ?>
    <h1>Tu pedido a sido confirmado</h1>
    <p>se ha guardado tu pedido con exito, en la brevedad sera enviado</p>
    <br>
    <?php if(isset($pedido)): ?>
        <h3>Datos de Envio</h3>
        Provincia: <?= $pedido->provincia?> <br>
        Ciudad:  <?= $pedido->localidad ?> <br>
        Direccion: <?= $pedido->direccion ?> <br>
        <br>
        
        <h3>Datos del Pedido:</h3>
        <br>
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
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] == "failed"): ?>
    <h1>No se a podido procesar tu pedido</h1>
<?php endif; ?>