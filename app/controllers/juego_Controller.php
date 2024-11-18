<?php

require_once './app/controllers/api_Controller.php';
require_once './app/models/juego_Model.php';


class juegoController extends controller{
        private $model;
        protected $view;
        public function __construct() {
            parent::__construct();
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
            !isset($request->body->imagen) ||
            !isset($request->body->descripción) || 
            !isset($request->body->plataforma) || 
            !isset($request->body->categoria)) {
            return $this->view->response(['error' => 'Falta completar datos'], 400);
        }

        $juego = [
            'nombre' => $request->body->nombre,
            'imagen' => $request->body->imagen,
            'descripción' => $request->body->descripción,
            'plataforma' => $request->body->plataforma,
            'categoria' => $request->body->categoria
        ];

        $checkPlat= $this->model->getPlat($juego['plataforma']);
        $checkCat= $this->model->getCat($juego['categoria']);

        if((!empty($checkPlat)) && ((!empty($checkCat)))){ 
            if(($checkPlat->consola == $juego['plataforma']) && ($checkCat->categoría == $juego['categoria'])){
                $juego['plataforma']= $checkPlat->ID_plat;
                $juego['categoria']= $checkCat->ID_cat;
                if ($this->model->modify($id, $juego)) {
                    $this->view->response(['success' => 'se actualizo el juego correctamente'], 200);
                } else {
                    $this->view->response(['error' => 'juego no encontrado'], 404); 
                }
            } else {
                $this->view->response(['error' => 'variables parecidas pero erroneas, checkear como esta escrita la data'], 400); 
            }
        } else {
            $this->view->response(['error' => 'variables de categoria o plataforma erroneamente aplicados, intente de nuevo'], 400); 
        }
    }

    public function create($request){
        if (!isset($request->body->nombre) || 
            !isset($request->body->descripción) || 
            !isset($request->body->imagen) ||
            !isset($request->body->plataforma) || 
            !isset($request->body->categoria)) {
            return $this->view->response(['error' => 'Falta completar datos'], 400);
        } 

        $juego = [
            'nombre' => $request->body->nombre,
            'descripción' => $request->body->descripción,
            'imagen' => $request->body->imagen,
            'usuario' => $request->body->usuario,
            'plataforma' => $request->body->plataforma,
            'categoria' => $request->body->categoria
        ];
        
        $dataUsu= $this->model->getUsu($juego['usuario']);
        $dataPlat= $this->model->getPlat($juego['plataforma']);
        $dataCat= $this->model->getCat($juego['categoria']);

        if(!empty($dataUsu)){
            if((!empty($dataPlat)) && ((!empty($dataCat)))){ 
                if(($dataPlat->consola == $juego['plataforma']) && ($dataCat->categoría == $juego['categoria'])){
                    $juego['plataforma']= $dataPlat->ID_plat;
                    $juego['categoria']= $dataCat->ID_cat;
                    $juego['usuario']= $dataUsu->ID_usuario;
                    if ($this->model->create($juego)) {
                        $this->view->response(['success' => 'se creo un juego correctamente'], 201);
                    } else {
                        $this->view->response(['error' => 'algo fallo en el proceso, intentelo de nuevo'], 404); 
                    }
                } else {
                    $this->view->response(['error' => 'variables parecidas pero erroneas, checkear como esta escrita la data'], 400); 
                }
            } else {
                $this->view->response(['error' => 'variables de categoria o plataforma erroneamente aplicados, intente de nuevo'], 400); 
            }
        } else {
            $this->model->createUsu($juego['usuario']);
            $this->view->response(['error' => 'el usuario ingresado no existia asi que se procede a crear. Intente ingresar la informacion de nuevo'], 400); 
        }
    }
}