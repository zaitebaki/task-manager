<?php

namespace App;

use Core\Controller;

class Application
{
    /**
     * Send server response.
     */
    public function sendResponse(): void
    {
        $route          = new Route();
        $controllerData = $route->getControllerData();

        $controllerName = $controllerData['controllerName'];
        $parameter      = $controllerData['parameter'];

        //send 4o4 error
        if ($controllerName === null) {
            Controller::abort(404);
        }

        // get class name and controller's method name
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
