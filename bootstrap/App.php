<?php
define('APP_PATCH', __DIR__ .'/../');

require_once  APP_PATCH . '/app/src/helpers.php';

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../app/config/app.php';


use Ashkanfekri\dodo\Router;

$router = new Router();
require_once __DIR__.'/../app/routes/web.php';
$router->run();
