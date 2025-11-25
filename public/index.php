<?php
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/router/Route.php';
require_once __DIR__ . '/../app/core/router/RouteCollection.php';
require_once __DIR__ . '/../app/core/router/PatternCompiler.php';
require_once __DIR__ . '/../app/core/router/Dispatcher.php';


require_once __DIR__ . '/../app/core/init.controller.php';
require_once __DIR__ . '/../app/controllers/home/home.controller.php';
require_once __DIR__ . '/../app/controllers/usuarios/usuarios.controller.php';
require_once __DIR__ . '/../app/controllers/vehiculos/vehiculos.controller.php';
require_once __DIR__ . '/../app/controllers/viajes/viajes.controller.php';


$router = new Router();
$router->get('/', [controllerhome::class, 'index']);
$router->get('/home', [controllerhome::class, 'index']);
$router->get('/usuarios', [controllerusuarios::class, 'index']);
$router->get('/vehiculos', [controllervehiculos::class, 'index']);
$router->get('/viajes', [controllerviajes::class, 'index']);

// Dispatch the request 
$router->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>