<?php


namespace App\src\database\migrates;


class Blueprint
{
    /**
     * @var array
     */
    public $columns = [];
    public $primary_key = [];

    private $flag = 0;

    /**
     * @param string $name
     * @param int $length
     * @return $this
     */
    public function id($name = 'id', $length = 11)
    {
        $this->addColumn('int', $name, [
            'length' => $length,
            'not_null'=>true,
            'AUTO_INCREMENT'=>true
            ], true);
        $this->flag++;
        return $this;
    }

    /**
     * @param $name
     * @param int $length
     * @return $this
     */
    public function integer($name, $length = 20)
    {
        $this->addColumn('int', $name, ['length' => $length]);
        $this->flag++;
        return $this;
    }

    /**
     * @param $name
     * @param int $length
     * @return $this
     */
    public function string($name, $length = 100)
    {
        $this->addColumn('varchar', $name, ['length' => $length]);
        $this->flag++;

        return $this;

    }

    /**
     * @param $name
     * @return $this
     */
    public function text($name)
    {
        $this->addColumn('text', $name);
        $this->flag++;
        return $this;

    }

    /**
     * @param $type
     * @param $name
     * @param array $option
     * @return array
     */

    private function addColumn($type, $name, $option = [], $primary_key=false)
    {
        if ($primary_key)
            $this->primary_key[]=$name;

        return $this->columns[] = [
            'name' => $name,
            'type' => $type,
            'option' => $option
        ];
    }

    private function addOption($o)
    {

    }
}