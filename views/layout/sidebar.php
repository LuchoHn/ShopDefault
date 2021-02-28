<!--Barra Lateral-->
                <aside id="lateral">
                    <div id="login" class="block_aside">
                    <?php if(!isset($_SESSION['identity'])){ ?>
                        <h3>Entrar a la Web</h3>
                        <?php 
                            if(isset($_SESSION['error_login'])){ 
                                echo "<div class='alert-red'><p>".$_SESSION['error_login']."</p></div>"; 
                            } 
                        ?>
                        <form action="<?= base_url?>usuario/login" method="POST">
                            <label for="email">Email</label>
                            <input type="email" name="email">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password">

                            <input type="submit" value="Enviar">
                        </form>
                        <ul>
                            <li><a href="<?=base_url?>usuario/registro">Registrarse</a></li>
                            <li><a href="">Olvide mis datos</a></li>
                        </ul>
                    <?php }else{ ?>
                        <h3>Bienvenido</h3>
                        <h4><center><?= $_SESSION['identity']->nombre .' '. $_SESSION['identity']->apellidos?><center></h4>
                        <ul>
                            <li><a href="<?= base_url?>pedido/mis_pedidos">Mis pedidos</a></li>
                            <?php if(isset($_SESSION['admin'])): ?>
                                <li><a href="<?= base_url?>pedido/gestion">Gestionar Pedidos</a></li>
                                <li><a href="<?= base_url?>categoria/index">Gestionar Categorias</a></li>
                                <li><a href="<?= base_url?>producto/gestion">Gestionar Productos</a></li>
                            <?php endif; ?>
                            <li><a href="<?=base_url?>usuario/logout">Cerrar Sesion</a></li>
                        </ul>
                    <?php } ?>    
                    </div>

                    <div id="login" class="block_aside">
                        <h3>Carrito</h3>
                        <?php $stats = utils::statsCarrito(); ?>
                        <li><a href="<?= base_url?>carrito/index">Productos (<?=$stats['count'];?>)</a></li>
                        <li><a href="<?= base_url?>carrito/index"> Total: <?=$stats['total'];?> $</a></li>
                        <li><a href="<?= base_url?>carrito/index">Ver carrito</a></li>
                        <li><a href="<?= base_url?>carrito/delete">Vaciar Carrito</a></li>
                    </div>
                </aside>
                <?php Utils::deleteSession('error_login'); ?>
                
                <!--Contenido Central-->
                <div id="central">