<?php
require_once './app/models/roms_model.php';
class juegosModel{
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=web2_elmagoroms;charset=utf8', 'root', '');        
    }
    function getAll(){
        $query = $this->db->prepare('SELECT * FROM juegos');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    
    function getAllSortedByName($order = 'asc') {
        $order = strtolower($order) === 'desc' ? 'DESC' : 'ASC';
        $query = $this->db->prepare("SELECT * FROM juegos ORDER BY nombre $order");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
