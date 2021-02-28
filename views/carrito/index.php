<h1>Carrito de la compra</h1>
<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Acciones</th>
    </tr>
    <?php foreach($carrito as $indice => $elemento): 
            $producto = $elemento['producto'];    
    ?>
        <tr>
            <td>
                <?php if($producto->imagen != null): ?>
                    <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="camisaDefault" class="img_carrito">
                <?php else: ?>
                    <img src="<?= base_url ?>assets/img/camiseta.png" alt="T-shirt"  class="img_carrito">
                <?php endif; ?>
            </td>
            <td>
                   <a href="<?= base_url ?>producto/detalle&id=<?=$elemento['id_producto']?>"> <?= $producto->nombre ?></a>
            </td>
            <td>
                    <?= $elemento['precio']?>
            </td>
            <td>
                    <?= $elemento['unidades']?>
                    <div class="updown-unidades">
                        <a href="<?=base_url ?>carrito/up&indice=<?=$indice?>" class="button">+</a>
                        <a href="<?=base_url ?>carrito/down&indice=<?=$indice?>" class="button">-</a>
                    </div>
            </td>
            <td>
                    <a href="<?=base_url ?>carrito/remover&indice=<?=$indice?>" class="button button_carrito button-erase">Quitar Producto</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<div class="delete_carrito">
    <br>
    <a href="<?=base_url ?>carrito/delete" class="button button-erase button_delete">Vaciar Carrito</a>
</div>
<div class="total-carrito">
    <br>
    <?php $stats = Utils::statsCarrito(); ?>
    <h3>Precio Total: <?= $stats['total']?>$</h3>
    <a href="<?=base_url ?>pedido/hacer" class="button button-pedido">Confirmar</a>
</div>