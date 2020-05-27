<?php
$routes[] = ['/', 'HomeController@index'];
$routes[] = ['/posts', 'PostsController@index'];
$routes[] = ['/posts/{id}/show', 'PostsController@show'];
$routes[] = ['/posts/create', 'PostsController@create'];
$routes[] = ['/posts/store', 'PostsController@store'];
$routes[] = ['/posts/{id}/edit', 'PostsController@edit'];
$routes[] = ['/posts/{id}/update', 'PostsController@update'];
$routes[] = ['/posts/{id}/delete', 'PostsController@delete'];

$routes[] = ['/user/create', 'UserController@create'];
$routes[] = ['/user/store', 'UserController@store'];

return $routes;
