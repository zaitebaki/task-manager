<?php

namespace Core;

abstract class Controller
{
    /**
     * Относительная директория для файлов вида
     * @var string
     */
    const VIEW_DIR = '../views/';

    /**
     * Вернуть соответствующее html-содержимое из файла
     * по заданному имени вида
     * @param string $viewName
     * @return string
     */
    protected function view(string $viewName): string
    {
        $directory = self::VIEW_DIR . $viewName . '.html';
        return file_get_contents($directory);
    }

    /**
     * Отправить ответ клиенту в случае ошибки
     * @param int $statusCode
     * @return void
     */
    public static function abort(int $statusCode): void
    {
        $directory = self::VIEW_DIR . $statusCode . '.html';

        switch ($statusCode) {
            case 404:
                header('HTTP/1.1 404 Not Found');
                break;
            case 500:
                header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
                break;
            default:
                break;
        }

        echo file_get_contents($directory);
        exit(0);
    }
}
