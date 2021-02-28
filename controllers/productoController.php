<?php

require_once "models/productoModel.php";

    class productoController{
        public function index(){
            $producto = new producto;
            $productos = $producto->getRandom(6);
            //var_dump($productos->fetch_object());
            
            require_once "views/productos/destacados.php";
        }

        public function detalle(){
            if(isset($_GET['id'])){
                $id= $_GET['id'];
                $producto = new producto();
                $producto->setId($id);
                $pro = $producto->getOne();
                require_once "views/productos/detalle.php";
            }
        }

        public function gestion(){
            Utils::isAdmin();
            $producto = new producto();
            $productos = $producto->getAll();
            require_once "views/productos/gestion.php"; 
        }

        public function crear(){
            Utils::isAdmin();
            require_once "views/productos/crear.php";
        }

        public function save(){
            Utils::isAdmin();

            if(isset($_POST)){
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
                $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
                $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
                $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
                //$imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
                
                if($nombre && $descripcion && $precio && $stock && $categoria){
                    $producto = new producto;
                    $producto->setNombre($nombre);
                    $producto->setDescripcion($descripcion);
                    $producto->setPrecio($precio);
                    $producto->setStock($stock);
                    $producto->setCategoria_id($categoria);

                    //guardar imagen
                    if(isset($_FILES['imagen'])){
                        $file = $_FILES['imagen'];
                        $filename = $file['name'];
                        $mimetype = $file['type'];

                        if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){
                            if(!is_dir('uploads/images')){
                                mkdir('uploads/images', 0777, true);
                            }

                            move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                            $producto->setImagen($filename);
                        }

                        if(isset($_GET['id'])){
                            $id=$_GET['id'];
                            $producto->setId($id);
                            $save = $producto->edit();
                        }else{
                            $save = $producto->save();
                        }
                        
                        if($save){
                            $_SESSION['producto'] = 'complete';
                        }else{
                            $_SESSION['producto'] = 'failed';
                        }
                    }
                }else{
                    $_SESSION['producto'] = 'failed2';
                }
            }else{
                $_SESSION['producto'] = 'failed3';
            }
            header("Location:".base_url."producto/gestion");
        }

        public function edit(){
            utils::isAdmin();
            if(isset($_GET['id'])){
                $edit = true;
                $id= $_GET['id'];
                $producto = new producto();
                $producto->setId($id);
                $pro = $producto->getOne();
            }else{
                header('Location:'.base_url.'producto/gestion');
            }
            
            require_once 'views/productos/crear.php';
        }

        public function delete(){
            utils::isAdmin();

            if(isset($_GET['id'])){
                $id= $_GET['id'];
                $producto = new producto();
                $producto->setId($id);
                $delete = $producto->delete();

                if($delete){
                    $_SESSION['delete'] = 'complete';
                }else{
                    $_SESSION['delete'] = 'failed';
                }
            }else{
                $_SESSION['delete'] = 'complete';
            }

            header('Location:'.base_url.'producto/gestion');
        }
    }

?>