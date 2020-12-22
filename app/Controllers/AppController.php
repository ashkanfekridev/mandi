<?php


namespace App\Controllers;
use App\Models\Posts;
use Ashkanfekri\dodo\PDOConnector;
use Ashkanfekri\dodo\Response;


class AppController
{
    public function install(){
//        create posts table
        $sql = "
            CREATE TABLE `mandi_test`.`posts` (
                `id` INT(11) NOT NULL AUTO_INCREMENT ,
                `title` VARCHAR(100) NOT NULL ,
                `body` TEXT NOT NULL ,
                `type` INT(3) NOT NULL ,
            PRIMARY KEY (`id`)
            ) ENGINE = InnoDB;
        ";
        $db = (new PDOConnector())->query($sql)->execute();
//        create posts table

        return $db;
    }



    public function landing(){
    (new Posts())->lastPosts();
        return Response::view('static.landing');
    }
}