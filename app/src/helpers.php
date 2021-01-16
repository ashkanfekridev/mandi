<?php
/**
 * Dump the given value and kill the script.
 *
 * @param mixed $value
 * @return void
 */
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die;
}


function view($patch, array $data = [])
{
    $view["patch"] = APP_PATCH . 'app/Views/' . (str_replace('.', '/', $patch)) . '.php';
    $view["data"] = $data;
    return print \App\src\Rande\Rande::compile($view);
}