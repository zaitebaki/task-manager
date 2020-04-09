<?php
return
$routes = [
    ['/', 'get', 'IndexController@index'],
    ['/', 'post', 'IndexController@index'],
    ['/page/{num_page}', 'get', 'IndexController@index'],
    ['/page/{num_page}', 'post', 'IndexController@index'],
    ['/login', 'get', 'IndexController@login'],
    ['/login', 'post', 'IndexController@authenticate'],
    ['/logout', 'post', 'IndexController@logout'],

    // ['/edit_task/{id_task}', 'get', 'IndexController@index'],
    
];
