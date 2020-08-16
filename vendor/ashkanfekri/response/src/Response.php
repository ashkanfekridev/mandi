<?php


namespace Ashkanfekri\dodo;


class Response
{
    public static function view($view, $data = [])
    {
        // TODO show view template to response

        if (!is_null($data))
            extract($data);

        $view = str_replace('.', '/', $view);
        return require_once __DIR__ . '/../../../app/Views/' . $view . '.php';
    }

    public static function json($json)
    {
        http_response_code(200);
        header('Content-type:application/json;charset=utf-8');
        return json_encode($json);
    }

    public static function file($link)
    {
        // TODO show and redirect file to view on response
    }

    public static function fileDownload($link)
    {
        // TODO return download link on response
    }

}