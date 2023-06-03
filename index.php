<?php

use controller\LoginC;
use controller\HomeC;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/controllers/Controller.php';
require_once __DIR__ . '/app/controllers/LoginC.php';
require_once __DIR__ . '/app/controllers/C_Home.php';


$dispatcher = FastRoute\simpleDispatcher(require __DIR__ . '/app/config_file.php');

// Obtiene el método y la URL de la solicitud actual
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Elimina la cadena de consulta de la URL, si existe
if (($pos = strpos($uri, '?')) !== false) {
    $uri = substr($uri, 0, $pos);
}

// Enrutamiento
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // Ruta no encontrada
        echo '404 Not Found';
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // Método no permitido para esta ruta
        echo '405 Method Not Allowed';
        break;

    case FastRoute\Dispatcher::FOUND:
        // Ruta encontrada, llama al controlador y método correspondientes
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // $handler debe tener el formato 'Controlador@metodo'
        list($controller, $method) = explode('@', $handler);
        // Crea una instancia del controlador y llama al método correspondiente
        $controllerInstance = new $controller();
        $controllerInstance->$method($vars);
        break;
}

