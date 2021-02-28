<?php 
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

function show_error(){
    $error = new errorController();
    $error-> index();
}

if(isset($_GET['controller']) && class_exists($_GET['controller']."Controller")){
    $nombre_clase =  $_GET['controller']."Controller";
    $controlador = new $nombre_clase();
}elseif(!isset($_GET['controller'])){
    $nombre_clase = controller_default;
    $controlador = new $nombre_clase();
}else{
    show_error();
}

if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
    $action = $_GET['action'];
    $controlador->$action();
}elseif(!isset($_GET['action'])){
    $action = action_default;
    $controlador->$action();
}else{
    show_error();
}

require_once 'views/layout/footer.php';

?>