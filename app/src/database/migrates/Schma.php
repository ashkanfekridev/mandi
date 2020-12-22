<?php


namespace App\src\database\migrates;

class Schema
{
    private static $table;
    public static $columns = [];

    public static function create($table, callable $callback)
    {
        Schema::$table = $table;

        $table = new Blueprint();
        call_user_func($callback, $table);
        return Schema::$columns = $table->column;
    }


    public static function build()
    {
        $columns = Schema::$columns;
        $table = Schema::$table;
        $startStrSql = "CREATE TABLE `{$table}` (";
        $str = '';
        foreach ($columns as $column) {
            $str .= Schema::column($column);
        }

        return $startStrSql . trim($str, ',') . ');';
    }


    private static function column($column)
    {
        $type = $column['type'];
        $name = $column['name'];
        $option = $column['option'];

        $str = "`{$column['name']}` ";
        if ($type == "int" || $type == 'varchar') {
            $str .= " {$type}({$option['length']}) ,";
        } elseif ($type == 'text') {
            $str .= $type . " ,";
        }
        return $str;
    }


    public static function get()
    {
        return Schema::$columns;
    }

}