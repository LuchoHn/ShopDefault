<?php

class categoria{
    private $id;
    private $nombre;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);

        return $this;
    }

    public function getAll(){
        $sql = "SELECT * FROM categorias ORDER BY id DESC";
        $categorias = $this->db->query($sql);
        return $categorias;
    }

    public function getOne(){
        $sql = "SELECT * FROM categorias WHERE id={$this->getId()}";
        $categorias = $this->db->query($sql);
        return $categorias->fetch_object();
    }

    public function getNameCat($id){
        $sql = "SELECT nombre FROM categorias WHERE id = $id";
        $nombre = $this->db->query($sql);
        return $nombre;
    }

    public function save(){
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}')";
        $save = $this->db->query($sql);
        $save = false;
        if($save){
            $save = TRUE;
        }
    }
}

?>