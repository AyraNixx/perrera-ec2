<?php

namespace utils;

use Exception;

class Route
{
    private $routes; // Array para guardar las rutas

    // Constructor
    function __construct()
    {
        $this->routes = [
            "/Login" => "../public/Login.php",
            "/Home" => "HomeC@index"
        ];
    }

    /**
     * Permite agregar una nueva ruta al array de rutas definido en la clase.
     * @param String $route Ruta URL que se desea añadir.
     * @param String $callback Controlador (o función del controlador) que se va a ejecutar cuándo se solicite esa ruta
     */
    public function add_route(String $route, String $callback)
    {
        $this->routes[$route] = $callback; // Una función callback, es una función que se pasa como argumento en otra función
    }


    public function dispatch()
    {
        // Recorremos el array de rutas
        foreach ($this->routes as $route => $callback) {

            // Si la ruta que toca es distinta a la request Uri, la ignoramos con continue
            if ($route !== $_SERVER["REQUEST_URI"]) {
                continue;
            }
            // Si se encuentra una que coincida, llamamos a la función callback y le pasamos la función definida para esa ruta
            $this->callback($callback);
        }
    }

    /**
     * Llama al método que queremos.
     * @param String $callback Es una cadena que representa un método de un controlador o al propio controlador
     */
    public function callback($callback)
    {
        try {
            // Primero comprobamos si el contenido de $callback puede ser llamado como una función
            if (is_callable($callback)) {
                // Si se puede, la llamamos como función
                $callback();

                // En caso de que no se pueda llamar como función, pensaremos que se trata de un controlador
                // definido de la siguiente manera [nombreControlador]@[nombreMétodo]
                //
                // Si no se puede, vemos si existe un '@' dentro de callback
            } else if (strpos($callback, "@")) {
                // Si existe un arroba, pasamos el string a array con explode y usamos el @ como limitador
                // Obtenemos la clase de la posición 0 y el método a llamar de la posición 1
                [$class, $function] = explode("@", $callback);

                // Comprobamos que existe la clase y la función
                if (class_exists($class) && method_exists($class, $function)) {
                    // Instanciamos un nuevo objeto
                    $class = new $class();
                    // Llamamos a la función indicada
                    $class->$function();

                    // Podría ponerlo también como (new $class)->$function();

                }
                // En caso que no cumpla ninguna de las dos condiciones, lanzamos una nueva excepción        
            } else {
                throw new Exception("Ruta no encontrada");
            }
        } catch (Exception $e) {

            Utils::save_log_error("Unexpected error caught:" . $e->getMessage());
        }
    }

    /**
     * Get the value of routes
     */ 
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Set the value of routes
     *
     * @return  self
     */ 
    public function setRoutes($routes)
    {
        $this->routes = $routes;

        return $this;
    }
}