<?php
$router->get('/', "AppController@landing");
$router->get('/install', "AppController@install");
$router->get('/post/:post/:id', "PostController@show");