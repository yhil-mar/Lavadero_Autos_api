<?php

// -- Este será el archivo donde se crearán las funciones encargadas de guardar las rutas y métodos para cada petición que se realice -- //

// Aquí se crea un espacio de nombres para evitar conflictos en los nombres, y con esto será más fácil realizar el autoload de la clase
namespace Src\Lib;

class Route {
    private static $routes = [];

    public static function get($uri, $cb) {
        $uri = trim($uri, '/');
        self::$routes['GET'][$uri] = $cb; 
    }

    public static function post($uri, $cb) {
        $uri = trim($uri, '/');
        self::$routes['POST'][$uri] = $cb; 
    }

    public static function put($uri, $cb) {
        $uri = trim($uri, '/');
        self::$routes['PUT'][$uri] = $cb; 
    }

    public static function delete($uri, $cb) {
        $uri = trim($uri, '/');
        self::$routes['DELETE'][$uri] = $cb; 
    }

    // La función dispatch servirá para guardar las solicitudes HTTP, tanto URL como el tipo de petición
    // También se encarga de recorrer el array de las rutas creado arriba, en donde para cada ruta, guardará como valor el callback
    // especificado en las rutas (archivo routes/index.php), y si la ruta del método seleccionada coincide con la ruta ingresada por
    // el URL a modo de petición, se ejecutará el callback, pero si no encuentra coincidencia devolverá un mensaje 404 Not Found

    public static function dispatch() {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');
        $method = $_SERVER['REQUEST_METHOD'];


        // Obtener los parámetros del query string
        $query = $_GET;

        // Eliminar los parámetros del query string de la URI
        $uri = strtok($uri, '?');


        foreach (self::$routes[$method] as $route => $cb) {

            // Si la ruta especificada en la petición contiene params, se preguntará antes si esa ruta contiene ":", y si lo contiene
            // se va a reemplazar lo que hay desde ":" con una expresión regular, la cual ya se podrá comparar con el siguiente if
            if (strpos($route, ':') !== false) {
                $route = preg_replace('#:[a-zA-Z0-9]+#', '([a-zA-Z0-9]+)', $route);
            }

            // Dentro de este if, si la ruta contiene una expresión regular, esta se guardará en la variable $matches y se guardará en $params
            // lo que se encuentra después de ":". Pero si no hay una expresión regular, entonces ejecutará el callback donde $route sea igual a $uri
            if(preg_match("#^$route$#", $uri, $matches)) {
                $params = array_slice($matches, 1);
                
                // Se ejecuta la función callback, y si hay algún params, lo enviará como parámentro, pero esto no afectará para las funciones callback
                // que no requieran de parámetros

                // Verificamos que ese callback sea una función
                if (is_callable($cb)) {
                    $response = $cb(...$params);
                }

                // O si es un array, entonces se creará una variable controller la cual sera una nueva instancia de la clase que contenga
                // el archivo del controlador que se haya ejecutado (esta se encuentra en el primer elemento del array), y se guardará en
                // response la ejecución de la función que se especifique en el segundo elemento del array enviado por callback
                if (is_array($cb)) {
                    $controller = new $cb[0];

                    if ($method == 'GET') {

                        if($query && !$params) {

                            $response = $controller -> {$cb[1]}($query);

                        } else if ($params) {

                            $response = $controller -> {$cb[1]}(...$params);

                        } else {

                            $response = $controller -> {$cb[1]}();

                        }

                    } else if ($method == 'POST') {

                        $body = file_get_contents("php://input");

                        $data = json_decode($body, true);

                        $response = $controller -> {$cb[1]}($data);

                    } else if ($method == 'PUT') {
                        
                        $body = file_get_contents("php://input");

                        $data = json_decode($body, true);

                        $id = ($params[0]);

                        $response = $controller -> {$cb[1]}($id, $data);

                    } else if ($method == 'DELETE') {

                        $response = $controller -> {$cb[1]}(...$params);

                    }

                }

                if(is_array($response) || is_object($response)) {

                    // header('Content-Type: application/json');

                    echo json_encode($response);
                } else {
                    echo $response;
                }
                return;
            }
        }

        // Se enviará este mensaje si la ruta solicitada no existe
        echo('404 Not Found');
    }
};
?>