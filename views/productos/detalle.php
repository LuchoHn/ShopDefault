<?php if(isset($pro)): ?>
    <h1><?=$pro->nombre?></h1>
    <div id="datail-product">
        <div class="imagen-detail">
            <?php if($pro->imagen != null): ?>
                <img src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" alt="">
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="">
            <?php endif; ?>
        </div>
        <div class="data-detail">
            <h2><?= $pro->nombre ?></h2>
            <br>
            <h3 class="description"><?= $pro->descripcion ?></h3>
            <p class="price"><?= $pro->precio ?> $</p>
            <a href="<?= base_url ?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
        </div>
    </div>
    <?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>