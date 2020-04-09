<?php
return
$routes = [
    ['/', 'get', 'IndexController@index'],
    ['/authenticate', 'post', 'IndexController@authenticate'],
];
