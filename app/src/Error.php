<?php


namespace App\src;


class Error
{
    public static $template = <<<HTML
    <div style="direction: rtl; margin: 50px; border: 1px solid #FF1744;padding: 25px;">
    <h2 style="color: #FF1744; margin-bottom: 25px">خطا!</h2>
    <h3 style="border: 1px solid #666;padding: 25px;">عنوان خطا: <pre style="overflow: scroll; background: #ddd; padding: 15px ; display: block">%s</pre></h3>
    <h3 style="border: 1px solid #666;padding: 25px;">کد خطا: <pre style="background: #ddd; padding: 15px ; display: block">%d</pre></h3>
</div>    
HTML;

    public static function exception($e)
    {
        return printf(self::$template, $e->getMessage(), $e->getCode());
    }

    public static function error($code, $error, $file, $line)
    {
        return printf(self::$template, $error, $code);

    }
}