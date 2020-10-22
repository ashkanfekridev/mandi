<?php


namespace App\Models;


use Ashkanfekri\dodo\PDOConnector;

class Posts
{
    protected $table = 'posts';
    protected $key = 'id';

    public function lastPosts(int $count = 4){
        return (new PDOConnector())->query("SELECT * FROM {$this->table} LIMIT {$count}")->all();
    }
}