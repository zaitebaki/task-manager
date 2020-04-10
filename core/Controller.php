<?php

namespace Core;

abstract class Controller
{
    /**
     * Relative directory for view-files
     * @var string
     */
    const VIEW_DIR = '../views/';

    /**
     * Get corresponding html-content from file
     * according view name
     * Replace template variables on view file
     * @param string $viewName
     * @return string
     */
    protected function view(string $viewName, array $propsArray = null): string
    {
        $directory    = self::VIEW_DIR . $viewName . '.html';
        $outputString = file_get_contents($directory);

        // replace variables
        // example: @propsData@ => [{&quot;test&quot;:&quot;test from php&quot;}]
        $templateArray = [];
        if ($propsArray !== null) {
            foreach ($propsArray as $key => $value) {
                $templateArray["@$key@"] = htmlentities(json_encode($value, JSON_UNESCAPED_UNICODE));
            }
            $outputString = str_replace(array_keys($templateArray), array_values($templateArray), $outputString);
        }

        return $outputString;
    }

    /**
     * Send server error
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
