<h1>Gestion de Productos</h1>
<a href="<?php base_url?>crear" class="button button-small">Crear Producto</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Categoria</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr> 
    <?php while($pro = $productos->fetch_object()): ?>
    <tr>
        <?php 
            $nombre_categoria = utils::showNameCat($pro->categoria_id);
            $name_categoria = $nombre_categoria->fetch_object();
        ?>
        <td><?=$pro->id;?></td>
        <td><?=$pro->nombre;?></td>
        <td><?=$name_categoria->nombre;?></td>
        <td><?=$pro->precio;?></td>
        <td><?=$pro->stock;?></td>
        <td>
            <a href="<?=base_url?>producto/edit&id=<?=$pro->id?>" class="button button-gestion button-edit">Editar</a>
            <a href="<?=base_url?>producto/delete&id=<?=$pro->id?>" class="button button-gestion button-erase">Eliminar</a>
        </td>
    </tr>    
    <?php endwhile; ?>

    <?php  if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'):?>
        <strong class="alert-green">El producto se a añadido correctamente</strong>
    <?php endif; ?>
    <?php  if(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'):?>
        <strong class="alert-red"><?=$_SESSION['producto']?></strong>
    <?php endif; ?>
    <?php utils::deleteSession('producto') ?>

    <?php  if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'):?>
        <strong class="alert-green">El producto se a borrado correctamente</strong>
    <?php endif; ?>
    <?php  if(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'):?>
        <strong class="alert-red">No se a podido borrar el producto correctamente</strong>
    <?php endif; ?>
    <?php utils::deleteSession('delete') ?>
</table>