<?php


namespace App\Models;


use Ashkanfekri\dodo\PDOConnector;

class Post extends Model
{
    protected $table = 'posts';
    protected $key = 'id';

    public function lastPosts($count = 4){
        return PDOConnector::getInstance()->query("SELECT * FROM {$this->table} LIMIT {$count}")->all();
    }
}