<?php
$routes[] = ['/', 'HomeController@index'];
$routes[] = ['/posts', 'PostsController@index'];
$routes[] = ['/posts/{id}/show', 'PostsController@show'];
$routes[] = ['/posts/create', 'PostsController@create'];
$routes[] = ['/posts/store', 'PostsController@store'];
 
return $routes;
