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
        $controllerName = $route->getControllerName();

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

        $response = $controller->$method();

        echo $response;
    }
}
