<?php


namespace App\Models;

use Ashkanfekri\dodo\PDOConnector;

interface ModelInterface
{
    public function all(array $item);

    public function find($key, array $items);

    public function create(array $array);

    public function update($key, array $items);

    public function delete();

}

abstract class Model implements ModelInterface
{
    protected $table;
    protected $key;
    protected $db;
    protected $fillable;
    private $attribute;

    public function __construct()
    {
        $this->db = (new PDOConnector());
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
     * @param array|string[] $item
     * @return mixed
     */
    public function all(array $item = ['*'])
    {
        $sql = sprintf(
            "SELECT %s FROM %s",
            implode(', ', $item),
            $this->table
        );
        return $this->db->query($sql)->all();
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
                $data[$item] = $array[$item] = '';

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


    /**
     * @param $key
     * @param string[] $items
     * @return mixed
     */
    public function find($key, $items = ['*'])
    {
        $sql = sprintf(
            "SELECT %s FROM %s WHERE %s = %s",
            implode(', ', $items),
            $this->table,
            $this->key,
            $key
        );
        return $this->db->query($sql)->all();
    }


    public function update($key, $items = [])
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
}