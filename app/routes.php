<?php
$routes[] = ['/user/create', 'UserController@create'];
$routes[] = ['/user/store', 'UserController@store'];

$routes[] = ['/login', 'UserController@login'];
$routes[] = ['/logout', 'UserController@logout'];
$routes[] = ['/login/auth', 'UserController@auth'];


$routes[] = ['/', 'HomeController@index'];
$routes[] = ['/posts', 'PostsController@index'];
$routes[] = ['/posts/{id}/show', 'PostsController@show'];
$routes[] = ['/posts/create', 'PostsController@create', 'auth'];
$routes[] = ['/posts/store', 'PostsController@store', 'auth'];
$routes[] = ['/posts/{id}/edit', 'PostsController@edit', 'auth'];
$routes[] = ['/posts/{id}/update', 'PostsController@update', 'auth'];
$routes[] = ['/posts/{id}/delete', 'PostsController@delete', 'auth'];




return $routes;
