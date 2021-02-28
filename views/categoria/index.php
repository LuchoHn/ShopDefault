<h1>Gestionar Categorias</h1>
<a href="<?php base_url?>crear" class="button button-small">Crear Categoria</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
    </tr> 
    <?php while($cat = $categorias->fetch_object()): ?>
    <tr>
        <td>
        <?=$cat->id;?>
        </td>
        <td>
        <?=$cat->nombre;?>
        </td>
    </tr>    
    <?php endwhile; ?>
</table>