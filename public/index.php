<?php

declare (strict_types = 1);
error_reporting(E_ALL);
ini_set('display_errors', 'on');
session_start();

require dirname(__DIR__) . '/vendor/autoload.php';
use App\Application;

$app = new Application;
$app->sendResponse();

$a = 50;
$c = 100;

$d = $a + $c;