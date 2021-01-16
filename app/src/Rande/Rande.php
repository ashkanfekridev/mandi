<?php


namespace App\src\Rande;


class Rande
{
    /**
     * @var string[]
     */
    public static $compilers = [
        'php_openings',
        'php_closings',
        'structure_openings',
        'structure_closings',
        'else',
        'echos',
    ];

    /**
     * @param $view
     * @return mixed
     */
    public static function compile($view)
    {
        return static::compile_string(file_get_contents($view['patch']));
    }

    /**
     * @param $value
     * @param null $view
     * @return mixed
     */
    public static function compile_string($value, $view = null)
    {
        foreach (static::$compilers as $compiler) {
            $method = "compile_{$compiler}";
            $value = static::$method($value, $view);
        }
        return $value;
    }

    /**
     * @param $value
     * @return string|string[]|null
     */
    public static function compile_structure_openings($value)
    {
        $pattern = '/(\s*)@(if|elseif|foreach|for|while)(\s*\(.*\))/';
        return preg_replace($pattern, '$1<?php $2$3: ?>', $value);
    }

    /**
     * @param $value
     * @return string|string[]|null
     */
    protected static function compile_structure_closings($value)
    {
        $pattern = '/(\s*)@(endif|endforeach|endfor|endwhile)(\s*)/';
        return preg_replace($pattern, '$1<?php $2; ?>$3', $value);
    }

    /**
     * @param $value
     * @return string|string[]
     */
    public static function compile_php_openings($value)
    {
        return str_replace('@php', '<?php ', $value);
    }

    /**
     * @param $value
     * @return string|string[]
     */
    protected static function compile_php_closings($value)
    {
        return str_replace('@endphp', ' ?>', $value);
    }

    /**
     * @param $value
     * @return string|string[]|null
     */
    protected static function compile_else($value)
    {
        return preg_replace('/(\s*)@(else)(\s*)/', '$1<?php $2: ?>$3', $value);
    }

    /**
     * @param $value
     * @return string|string[]|null
     */
    protected static function compile_echos($value)
    {
        $value = preg_replace('/\{\{\{(.+?)\}\}\}/', '<?php echo htmlentities($1); ?>', $value);
        return preg_replace('/\{\{(.+?)\}\}/', '<?php echo $1; ?>', $value);
    }


}