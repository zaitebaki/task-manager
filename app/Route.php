<?php

namespace App;

class Route
{
    /**
     * Array of prepared routes in file /routes.php
     * @var array
     */
    private $routes;

    public function __construct()
    {
        $this->requestMethod     = mb_strtolower($_SERVER['REQUEST_METHOD']);
        $this->requestUri        = mb_strtolower($_SERVER['REQUEST_URI']);
        $this->routes            = require_once '../routes/routes.php';
        $this->routesForChecking = $this->getRoutesForChecking();
    }

    /**
     * Get controller name and dynamic parameter for current route.
     * @return ?array
     */
    public function getControllerData(): ?array
    {
        $checkingArray          = $this->getRoutesForChecking();
        $outputControllerName   = null;
        $outputDynamicParameter = null;

        // get last uri piece: http://task-manager.devmasta.ru.com/edit => edit
        $pos              = strripos($this->requestUri, '/');
        $cutClientUrl     = substr($this->requestUri, 0, $pos);
        $dynamicParameter = substr($this->requestUri, $pos + 1);

        for ($i = 0, $size = count($checkingArray); $i < $size; ++$i) {

            $typeUrl        = $checkingArray[$i]['typeUrl'];
            $url            = $checkingArray[$i]['url'];
            $method         = $checkingArray[$i]['method'];
            $controllerName = $checkingArray[$i]['controllerName'];

            // check client uri on dynamic parameter
            if ($typeUrl === 'dynamic') {
                $pos           = strpos($url, "{");
                $cutPrepareUrl = substr($url, 0, $pos - 1);

                if ($cutClientUrl === $cutPrepareUrl && $method === $this->requestMethod) {
                    return [
                        'controllerName' => $controllerName,
                        'parameter'      => $dynamicParameter,
                    ];
                }
            }

            // check client uri on non-dynamic parameter
            if ($url === $this->requestUri && $method === $this->requestMethod) {
                return [
                    'controllerName' => $controllerName,
                    'parameter'      => null,
                ];
            }
        }
        return null;
    }

    /**
     * Get routes array from prepare file.
     * @return array
     * @desc
     * Array example:
     * [
     *      'typeUrl' => 'dynamic',
     *      'url' => '/edit/{num_task}',
     *      'method' => 'post',
     *      'controllerName' => 'Home\IndexController@edit'
     * ]
     */
    private function getRoutesForChecking(): array
    {
        $routes      = $this->routes;
        $resultArray = [];

        for ($i = 0, $size = count($routes); $i < $size; ++$i) {
            $url            = $routes[$i][0];
            $method         = $routes[$i][1];
            $controllerName = $routes[$i][2];

            $typeDynamic = 'not_dynamic';

            // check uri on dynamic parameters
            $pos = strpos($url, "{");
            if ($pos !== false) {
                $typeDynamic = 'dynamic';
            }
            $resultArray[] = [
                'typeUrl'        => $typeDynamic,
                'url'            => $url,
                'method'         => $method,
                'controllerName' => $controllerName,
            ];
        }

        return $resultArray;
    }
}
