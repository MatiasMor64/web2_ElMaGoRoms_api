<?php

require_once './libs/router.php';
require_once './app/controllers/juego_Controller.php';

$router= new Router();

#                  endpoint         verbo     controller         metodo

$router-> addRoute('juegos',        'GET',    'juegoController', 'getAll'       );
$router-> addRoute('juegos/:order', 'GET',    'juegoController', 'getAllSorted' );
$router-> addRoute('juego/:id',     'GET',    'juegoController', 'get'          );
$router-> addRoute('juego/:id',     'PUT',    'juegoController', 'modify'       );

    
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 