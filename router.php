<?php

require_once './libs/router.php';
require_once 'app/controller/apiController.php';

$router= new Router();

#                  endpoint      verbo  controller           metodo

$router-> addRoute('juegos',     'GET', 'TaskApiController', 'get');
$router-> addRoute('juegos/:id', 'GET', 'TaskApiController', 'get');
$router-> addRoute('juegos/:id', 'DELETE', 'TaskApiController', 'erase');
 

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);

https://prod.liveshare.vsengsaas.visualstudio.com/join?E1358106C569E699B10C235CA3F2BCC238AD