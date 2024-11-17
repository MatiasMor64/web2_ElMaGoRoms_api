<?php

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

    function get($ID_juego){
        $query = $this->db->prepare('SELECT * FROM juegos WHERE ID_juego = ?');
        $query->execute([$ID_juego]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function getPlat($valor){
        $query = $this->db->prepare('SELECT * FROM plataformas WHERE consola = ?');
        $query->execute([$valor]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function getCat($valor){
        $query = $this->db->prepare('SELECT * FROM categorías WHERE categoría = ?');
        $query->execute([$valor]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function modify($id, $juegoModificado) {
    
        $query = $this->db->prepare('UPDATE juegos SET nombre = ?, descripción = ?, ID_plat = ?, ID_cat = ? WHERE ID_juego = ?');
        
        return $query->execute([
            $juegoModificado['nombre'],
            $juegoModificado['descripción'],
            $juegoModificado['ID_plat'],
            $juegoModificado['ID_cat'],
            $id
        ]);
    }

}
