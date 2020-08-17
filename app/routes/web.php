<?php
$router->get('/', function (){
  return \Ashkanfekri\dodo\Response::view('home');
});
