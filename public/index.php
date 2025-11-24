<?php
require_once "../app/core/Router.php";
require_once "../app/controllers/home/home.controller.php";
require_once "../app/controllers/usuarios/usuarios.controller.php";
require_once "../app/controllers/vehiculos/vehiculos.controller.php";
require_once "../app/controllers/viajes/viajes.controller.php";
$router = new Router();
$router->get('/', [controllerhome::class, 'index']);
$router->get('/home', [controllerhome::class, 'index']);
$router->get('/usuarios', [controllerusuarios::class, 'index']);
$router->get('/vehiculos', [controllervehiculos::class, 'index']);
$router->get('/viajes', [controllerviajes::class, 'index']);
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>