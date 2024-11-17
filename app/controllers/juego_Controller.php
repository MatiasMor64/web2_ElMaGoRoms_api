<?php

require_once './app/controllers/api_Controller.php';
require_once './app/models/juego_Model.php';


class juegoController extends controller{
        private $model;
        protected $view;
        public function __construct() {
            parent::__construct();
            $this->view = new jsonView();
            $this->model = new juegosModel();
        }

    public function getAll(){
        $juegos= $this->model->getAll();
        return $this->view->response($juegos, 200);
    }

    public function getAllSorted($request) {
        $order = $request->params->order;
        if(($order== 'asc') || ($order== 'desc')){
            $juegos = $this->model->getAllSortedByName($order);
            return $this->view->response($juegos, 200);
        } else {
            return $this->view->response("el valor ingresado de order no es el correcto, recuerde usar 'asc' o 'desc'", 400);
        }
    }

    public function get($request){
        $id= $request->params->id;
        $juego = $this->model->get($id);
        if ($juego){
            return $this->view->response($juego, 200);
        } else {
            return $this->view->response("No existe el juego con el id= " . $id, 404);
        }
    }

    public function modify($request){
        $id = $request->params->id;
        if (!isset($request->body->nombre) || 
            !isset($request->body->descripción) || 
            !isset($request->body->ID_plat) || 
            !isset($request->body->ID_cat)) {
            return $this->view->response(['error' => 'Falta completar datos'], 400);
        }

        $juego = [
            'nombre' => $request->body->nombre,
            'descripción' => $request->body->descripción,
            'ID_plat' => $request->body->ID_plat,
            'ID_cat' => $request->body->ID_cat
        ];

        $checkPlat= $this->model->getPlat($juego['ID_plat']);
        $checkCat= $this->model->getCat($juego['ID_cat']);


        if(($checkPlat->consola == $juego['ID_plat']) && ($checkCat->categoría == $juego['ID_cat'])){
            $juego['ID_plat']= $checkPlat->ID_plat;
            $juego['ID_cat']= $checkCat->ID_cat;
            if ($this->model->modify($id, $juego)) {
                $this->view->response(['success' => 'se actualizo el juego correctamente'], 200);
            } else {
                $this->view->response(['error' => 'juego no encontrado'], 404); 
            }
        } else {
            $this->view->response(['error' => 'variables de categoria o plataforma erroneamente aplicados, intente de nuevo'], 400); 
        }
    }
}

