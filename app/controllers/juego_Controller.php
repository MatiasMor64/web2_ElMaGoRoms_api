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
        $order = isset($request->params->order) ? $request->params->order : 'asc';
        $juegos = $this->model->getAllSortedByName($order);
        return $this->view->response($juegos, 200);
    }
}

