<?php
define('APP_PATCH', __DIR__ . '/../');

ini_set('error_reporting', -1);

ini_set('display_errors', "On");

require_once APP_PATCH . '/app/src/helpers.php';

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/config/app.php';


use Ashkanfekri\dodo\Router;

$router = new Router();
require_once __DIR__ . '/../app/routes/web.php';


//set_error_handler(function ($code, $error, $file, $line) {
//    print $code;
//    print $error;
//    echo "<p>در فایل: {$file}</p>
//<p>خط: {$line}</p>";
//});

//set_exception_handler(function ($e) {
//    return print ("<div style='margin: 50px; direction: rtl'>
//            <h1>خطا در عملکرد نرم افزار.</h1>
//            <p>پیام: {$e->getMessage()}</p>
//            <p>در فایل: {$e->getFile()}</p>
//            <p>خط: {$e->getLine()}</p>
//            <p>کد: {$e->getCode()}</p>
//            <p>خلاصه:</p>
//            <pre>{$e->getTraceAsString()}</pre>
//        </div>");
//});










set_exception_handler(function ($e) {
    return \App\src\Error::exception($e);
});

set_error_handler(function ($code, $error, $file, $line) {
    return \App\src\Error::error($code, $error, $file, $line);
});
try {
    $router->run();
} catch (Exception $e) {
    return \App\src\Error::exception($e);
}



error_reporting(-1);



