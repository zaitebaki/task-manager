<?php

namespace App;

class Route
{
    /**
     * Массив роутеров приложения, заданных в файл /routes.php
     * @var array
     */
    private $routes;

    public function __construct()
    {
        $this->requestMethod = mb_strtolower($_SERVER['REQUEST_METHOD']);
        $this->requestUri    = mb_strtolower($_SERVER['REQUEST_URI']);

        $this->routes            = require_once '../routes.php';
        $this->routesForChecking = $this->getRoutesForChecking();
    }

    /**
     * Получить имя контроллера для обработки текущего роутера
     * @return ?string
     */
    public function getControllerName(): ?string
    {
        $checkingArray = $this->getRoutesForChecking();
        $uriAndMethod  = $this->requestUri . '@' . $this->requestMethod;

        if (isset($checkingArray[$uriAndMethod])) {
            return $checkingArray[$uriAndMethod];
        }
        return null;
    }

    /**
     * Получить массив роутеров, для которых определен контроллер
     * @return array
     * @desc
     * Результирующий массив состоит из элементов вида
     * '/@get': Home\IndexController@authenticate'
     * '/authenticate@post': 'Home\IndexController@authenticate'
     */
    private function getRoutesForChecking(): array
    {
        $routes      = $this->routes;
        $resultArray = [];

        for ($i = 0, $size = count($routes); $i < $size; ++$i) {
            $url            = $routes[$i][0];
            $method         = $routes[$i][1];
            $controllerName = $routes[$i][2];

            $key   = $url . '@' . $method;
            $value = $controllerName;

            $resultArray[$key] = $value;
        }

        return $resultArray;
    }
}
