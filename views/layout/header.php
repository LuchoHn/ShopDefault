<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=base_url?>assets/css/style.css">
        <title>Tienda de Camisetas</title>
    </head>
    <body>
        <div id="container">
            <!--Cabecera-->
            <header id="header">
                <div id="logo">
                    <img src="<?=base_url?>assets/img/camiseta.png" alt="logo-camiseta">
                    <a href="<?=base_url?>">Tienda de Camisetas</a>
                </div>
            </header>
            <!--Menu-->
            <?php $categorias = Utils::showCategorias(); ?>
            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?=base_url?>">Inicio</a>
                    </li>
                    <?php while($cat = $categorias->fetch_object()): ?>
                        <li>
                            <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </nav>
            <div id="content">