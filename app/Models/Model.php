<?php


namespace App\Models;

use Ashkanfekri\dodo\PDOConnector;

interface ModelInterface
{
    public static function all(array $item);

    public function find($key, array $items);

    public function create(array $array);

    public function update($key, array $items);

    public function delete();

    public function getTable();

}

abstract class Model implements ModelInterface
{

    protected $db;

    protected $table;
    protected $key;

    protected $fillable = [];

    protected $attribute;

    /**
     * @var
     */
    private static $instance;

    /**
     * create new instance from this class
     * @return Model
     */
    public static function getInstance()
    {
        self::$instance = self::$instance ?? new self();
        return self::$instance;
    }


    private function __construct()
    {
        $this->db = PDOConnector::getInstance();
    }

    /**
     * Select all fillable columns from this table
     * @param array[] $items
     * @return mixed
     */
    public static function all(array $items = ['*'])
    {
//        new object form this class
        $model = (new static());
//        if not where set items for select set fillable columns for select from this model
        if ($items == ['*'])
            $items = $model->fillable;
// build a query for select all columns
        $sql = sprintf(
            "SELECT %s FROM %s",
            implode(', ', $items),
            $model->table
        );
        return $model->db->query($sql)->all();
    }


    /**
     * @param $key
     * @param string[] $items
     * @return mixed
     */
    public function find($key, array $items = ['*'])
    {

        $new = (new static());


        $sql = sprintf(
            "SELECT %s FROM %s WHERE %s = %s",
            implode(', ', $items),
            $this->table,
            $this->key,
            $key
        );
        return $new->query($sql)->all();
    }

    /**
     * @param array $array
     * @return mixed
     */
    public function create(array $array = [])
    {
        $data = [];

        if ($array == [])
            $array = $this->attribute;

        foreach ($this->fillable as $item) {

            if (!isset($array[$item]))
                $data[$item] = $array[$item] = NULL;

            $data[$item] = $array[$item];
        }

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            $this->table,
            implode(", ", array_keys($array)),
            ":" . implode(", :", array_keys($array))
        );
        $this->db->query($sql);

        foreach ($array as $key => $value) {
            $this->db->bindNotReturn(':' . $key, $value);
        }
        return $this->db->execute();

    }

    public function update($key, array $items = [])
    {


        $sql = sprintf(
            "UPDATE %s set ", $this->table);


        foreach ($items as $item => $value) {
            $sql .= $item . '= :' . $item . ' ,';
        }


        $sql = sprintf("%s WHERE % s = %s",
            trim($sql, ','),
            $this->key,
            $key
        );

        $this->db->query($sql);

        foreach ($items as $key => $value) {
            $this->db->bindNotReturn(':' . $key, $value);
        }
        return $this->db->execute();

    }

    public function delete()
    {
        //TODO

    }

    public function paginate($item_count)
    {
        //TODO
    }

    public function getTable()
    {
        return $this->table;
    }


    /**
     * set a new atteribute
     **/
    public function __set($name, $value)
    {
        $this->attribute[$name] = $value;
    }

    /**
     * get a atteribute
     **/
    public function __get($name)
    {
        return $this->attribute[$name];
    }


    /**
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $model = get_called_class();
        return call_user_func_array([new $model, $method], $parameters);
    }

}