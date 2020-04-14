<?php

namespace Core;

class Config extends Singleton
{
    private $config;

    /**
     * Create instance "Config".
     */
    public function __construct()
    {
        $this->config = require_once '../config/default.php';
    }

    /**
     * Get property value
     *
     * @param string $nameProperty
     * @return string
     */
    public static function get(string $nameProperty): string
    {
        $configObject = static::getInstance();
        return $configObject->config[$nameProperty];
    }
}
