<?php

namespace App;

use Core\Controller;

class Application
{
    /**
     * Отправить ответ сервера
     */
    public function sendResponse(): void
    {
        $route          = new Route();
        $controllerData = $route->getControllerName();

        $controllerName = $controllerData['controllerName'];
        $parameter      = $controllerData['parameter'];

        // отправить ошибку 404, если для текущего URI
        // контроллер не задан
        if ($controllerName === null) {
            Controller::abort(404);
        }

        // получить имя класса и метода контроллера
        $pizza     = \explode('@', $controllerName);
        $className = $pizza[0];
        $method    = $pizza[1];

        $fullClassName = "App\\Controllers\\$className";
        $controller    = new $fullClassName();

        if ($parameter !== null) {
            $response = $controller->$method($parameter);
        } else {
            $response = $controller->$method();
        }

        echo $response;
    }
}
