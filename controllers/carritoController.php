<?php
require_once 'models/productoModel.php';
    class carritoController{
        public function index(){
            $carrito = array();
            if(isset($_SESSION['carrito'])){
                $carrito = $_SESSION['carrito'];
            }
            require_once 'views/carrito/index.php';
        }

        public function add(){
            if(isset($_GET['id'])){
                $producto_id = $_GET['id'];
            }else{
                header('Location'.base_url);
            }

            if(isset($_SESSION['carrito'])){
                foreach($_SESSION['carrito'] as $indice => $elemento){
                    if($elemento['id_producto'] == $producto_id){
                        $counter = 0;
                        $_SESSION['carrito'][$indice]['unidades']++;
                        $counter++;
                    }
                }
            }
            if(!isset($counter) || $counter == 0){
                $producto = new producto();
                $producto->setId($producto_id);
                $producto = $producto->getOne();

                if(is_object($producto)){
                    $_SESSION['carrito'][] = array(
                        "id_producto" => $producto->id,
                        "precio" => $producto->precio,
                        "unidades" => 1,
                        "producto" => $producto,
                    );
                }
                
            }
            header('Location:'.base_url.'carrito/index');
        }

        public function remover(){
            if(isset($_GET['indice'])){
                $indice = $_GET['indice'];
                unset($_SESSION['carrito'][$indice]);
            }
            header('Location:'.base_url.'carrito/index');
        }

        public function delete(){
            unset($_SESSION['carrito']);
            
            header('Location:'.base_url.'carrito/index');
        }

        public function up(){
            if(isset($_GET['indice'])){
                $indice = $_GET['indice'];
                $_SESSION['carrito'][$indice]['unidades']++;
                header('Location:'.base_url.'carrito/index');
            }

        }

        public function down(){
            if(isset($_GET['indice'])){
                $indice = $_GET['indice'];
                $_SESSION['carrito'][$indice]['unidades']--;
                if($_SESSION['carrito'][$indice]['unidades'] == 0){
                    unset($_SESSION['carrito'][$indice]);
                }
                header('Location:'.base_url.'carrito/index');
            }
        }
    }

?>