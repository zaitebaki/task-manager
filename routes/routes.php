<?php
return
$routes = [
    ['/', 'get', 'IndexController@index'],
    ['/page/{num_page}', 'get', 'IndexController@index'],
    // ['/edit_task/{id_task}', 'get', 'IndexController@index'],
    ['/login', 'get', 'IndexController@login'],
];
