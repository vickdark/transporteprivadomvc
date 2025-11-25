<?php
// Incluir el autoloader de Composer dependencias
require_once __DIR__ . '/../vendor/autoload.php';

// Incluir el Router y sus componentes
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/router/Route.php';
require_once __DIR__ . '/../app/core/router/RouteCollection.php';
require_once __DIR__ . '/../app/core/router/PatternCompiler.php';
require_once __DIR__ . '/../app/core/router/Dispatcher.php';

// Incluir los helpers
require_once __DIR__ . '/../app/core/helpers.php';

// Incluir la conexión a la base de datos
require_once __DIR__ . '/../app/core/database.php';

// Incluir el controlador inicial
require_once __DIR__ . '/../app/core/init.controller.php';

// Incluir los modelos
require_once __DIR__ . '/../app/models/Vehiculo.php';

// Incluir los controladores
require_once __DIR__ . '/../app/controllers/home/home.controller.php';
require_once __DIR__ . '/../app/controllers/usuarios/usuarios.controller.php';
require_once __DIR__ . '/../app/controllers/vehiculos/vehiculos.controller.php';
require_once __DIR__ . '/../app/controllers/viajes/viajes.controller.php';

// Incluir el Router y sus componentes
$router = new Router();

// Definir las rutas
$router->get('/', [controllerhome::class, 'index']);
$router->get('/home', [controllerhome::class, 'index']);
$router->get('/usuarios', [controllerusuarios::class, 'index']);
$router->get('/vehiculos', [controllervehiculos::class, 'index']);
$router->get('/viajes', [controllerviajes::class, 'index']);

// Vehículos CRUD
$router->get('/vehiculos/list', [controllervehiculos::class, 'list']);
$router->post('/vehiculos/create', [controllervehiculos::class, 'create']);
$router->get('/vehiculos/show/{id}', [controllervehiculos::class, 'show']);
$router->post('/vehiculos/update/{id}', [controllervehiculos::class, 'update']);
$router->post('/vehiculos/delete/{id}', [controllervehiculos::class, 'delete']);

// Ejecutar el Router
$router->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>
