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
    ['/add_task', 'post', 'IndexController@add'],
    ['/edit/{id_task}', 'get', 'IndexController@edit'],
    ['/edit/{id_task}', 'post', 'IndexController@postEdit'],
];
