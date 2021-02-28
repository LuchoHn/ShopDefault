<?php

require_once "models/categoriaModel.php";
require_once "models/productoModel.php";

    class categoriaController{
        public function index(){
            Utils::isAdmin();

            $categoria = new categoria();
            $categorias = $categoria->getAll();
            require_once 'views/categoria/index.php';
        }

        public function crear(){
            Utils::isAdmin();
            require_once 'views/categoria/crear.php';
        }

        public function save(){
            Utils::isAdmin();
            //guardar categoria
            if(isset($_POST['nombre'])){
                $nombre = $_POST['nombre'];
                $categoria = new categoria();
                $categoria->setNombre($nombre);
                $categoria->save();
            }
        
            header("Location:".base_url."categoria/index");
        }

        public function ver(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                //conseguir la categoria
                $categoria = new categoria;
                $categoria->setId($id);
                $categoria = $categoria->getOne();

                //COnseguir productos de la categoria;

                $producto = new producto;
                $producto->setCategoria_id($id);
                $productos = $producto->getAllByCat();
            }
            require_once 'views/categoria/ver.php';
        }
    }

?>