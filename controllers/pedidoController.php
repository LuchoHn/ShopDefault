<?php
require_once "models/pedidoModel.php";

    class pedidoController{
        public function hacer(){
            require_once "views/pedido/hacer.php";
        }

        public function add(){
            if(isset($_SESSION['identity'])){

                $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
                $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
                $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
                $usuario_id = $_SESSION['identity']->id;
                $stats = Utils::statsCarrito();
                $coste = $stats['total'];
                //guardar datos en la Base de datos
                $pedido = new pedido();
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setUsuario_id($usuario_id);
                $pedido->setCoste($coste);

                $save = $pedido->save();

                //guardar linea pedido

                $save_linea = $pedido->save_linea();

                if($save && $save_linea){
                    $_SESSION['pedido'] = 'complete';
                }else{
                    $_SESSION['pedido'] = 'failed';
                }

                header("Location:".base_url."pedido/confirmado");
            }else{
                //redigirir al index
                $_SESSION['pedido'] = 'failed';
                header("Location:".base_url);
            }
        }

        public function confirmado(){
            if(isset($_SESSION['identity'])){
                $identity = $_SESSION['identity'];
                $pedido= new pedido;
                $pedido->setUsuario_id($identity->id);

                $pedido= $pedido->getOneByUser();

                $pedido_productos = new pedido;
                $productos = $pedido_productos->getProductsByPedido($pedido->id);

                $stock = new pedido;
                $restar_stock = $stock->getProductsByPedido($pedido->id);
                while($producto_restar = $restar_stock->fetch_object()){
                    $stock->restarStock($producto_restar->unidades, $producto_restar->id);
                }
            }
            
            require_once "views/pedido/confirmado.php";
        }

        public function mis_pedidos(){
            utils::isIdentity();
            $usuario_id = $_SESSION['identity']->id;
            $pedido = new pedido();

            //sacar todos los pedidos del usuario
            $pedido->setUsuario_id($usuario_id);
            $pedidos = $pedido->getAllByUser();

            require_once 'views/pedido/mis_pedidos.php';
        }

        public function detalle(){
            utils::isIdentity();
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                //sacar el pedido
                $pedido= new pedido;
                $pedido->setId($id);
                $pedido = $pedido->getOne();

                //sacar los productos
                $pedido_productos = new pedido;
                $productos = $pedido_productos->getProductsByPedido($id);
                require_once 'views/pedido/detalle.php';
            }else{
                header('Location:'.base_url.'pedido/mis_pedidos');
            }
        }

        public function gestion(){
            utils::isAdmin();
            $gestion = true;

            $pedido = new pedido;
            $pedidos = $pedido->getAll();

            require_once 'views/pedido/mis_pedidos.php';
        }

        public function estado(){
            utils::isAdmin();
            if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
                //recoger datos del form
                $pedido_id = $_POST['pedido_id'];
                $estado = $_POST['estado'];
                //update del pedido
                $pedido_estado = new pedido;
                $pedido_estado->setId($pedido_id);
                $pedido_estado->setEstado($estado);
                $pedido_estado->updateOne();

                header("Location:".base_url."pedido/detalle&id=".$pedido_id);
            }else{
                header("Location:".base_url);
            }
        }
    }

?>