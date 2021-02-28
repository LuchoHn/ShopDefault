<?php

class pedido{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getCoste()
    {
        return $this->coste;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    public function setProvincia($provincia)
    {
        $this->provincia = $this->db->real_escape_string($provincia);

        return $this;
    }

    public function setLocalidad($localidad)
    {
        $this->localidad = $this->db->real_escape_string($localidad);;

        return $this;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);;

        return $this;
    }

    public function setCoste($coste)
    {
        $this->coste = $coste;

        return $this;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    public function getAll(){
        $sql = "SELECT * FROM pedidos ORDER BY id DESC";
        $pedidos = $this->db->query($sql);
        return $pedidos;
    }

    

    public function getOne(){
        $sql = "SELECT pe.*, u.nombre, u.apellidos, u.email FROM pedidos pe INNER JOIN usuarios u ON pe.usuario_id = u.id WHERE pe.id = {$this->getId()}";
        $pedidos = $this->db->query($sql);
        return $pedidos->fetch_object();
    }

    public function getOneByUser(){
        $sql = "SELECT * FROM pedidos p WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";
        $pedidos = $this->db->query($sql);

        return $pedidos->fetch_object();
    }

    public function getAllByUser(){
        $sql = "SELECT * FROM pedidos p WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
        $pedidos = $this->db->query($sql);

        return $pedidos;
    }

    public function getProductsByPedido($id){
        $sql = "SELECT pr.*, lp.unidades FROM productos pr INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id WHERE lp.pedido_id={$id}";
        $productos = $this->db->query($sql);

        return $productos;
    }

    public function save(){

        $sql = "INSERT INTO pedidos VALUES(NULL,'{$this->getUsuario_id()}', '{$this->getProvincia()}', '{$this->getLocalidad()}', 
                '{$this->getDireccion()}', {$this->getCoste()}, 'confirmado', CURDATE(), CURTIME())";
        $save = $this->db->query($sql);

        $result = false;

        if($save){
            $result = TRUE;
        }

        return $result;
    }

    public function save_linea(){

        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach($_SESSION['carrito'] as $elemento){ 
            $producto = $elemento['producto'];
            $unidades = $elemento['unidades'];
            $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id}, {$unidades})";
            $save = $this->db->query($insert);

            echo $this->db->error;
        }
        
        $result = false;

        if($save){
            $result = TRUE;
        }

        return $result;
    }

    public function updateOne(){
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' WHERE id = '{$this->getId()}' ";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function restarStock($stock, $id){
        $sql_stock_total= "SELECT stock from productos WHERE id = $id";
        $stock_total= $this->db->query($sql_stock_total)->fetch_object();
        $stock_final= $stock_total->stock-$stock;

        $sql = "UPDATE productos SET stock = $stock_final WHERE id = $id";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }
}

?>