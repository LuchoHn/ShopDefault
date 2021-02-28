<?php

class Utils{
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    public static function isIdentity(){
        if(!isset($_SESSION['identity'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    public static function showCategorias(){
        require_once "models/categoriaModel.php";
        $categoria = new categoria();
        $categorias = $categoria->getAll();

        return $categorias;
    }

    public function showNameCat($id){
        require_once "models/categoriaModel.php";
        $nameCat = new categoria();
        $nameCats = $nameCat->getNameCat($id);

        return $nameCats;
    }

    public static function statsCarrito(){
        $stats = array(
            'count' => 0,
            'total' => 0
        );
        if(isset($_SESSION['carrito'])){
            $stats['count'] = count($_SESSION['carrito']);

            foreach($_SESSION['carrito'] as $producto){
                $stats['total'] += $producto['precio']*$producto['unidades'];
            }
        }

        return $stats;
    }

    public static function showStatus($status){
        $value = 'Pendiente';

        if($status == 'confirmado'){
            $value = 'Pendiente';
        }else if($status == 'preparacion'){
            $value = 'En proceso';
        }else if($status == 'listo'){
            $value = 'Proceso de Envio';
        }else if($status == 'enviado'){
            $value = 'Enviado';
        }

        return $value;
    }
}

?>