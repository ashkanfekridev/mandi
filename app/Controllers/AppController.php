<?php


namespace App\Controllers;

use App\Models\Post;
use Ashkanfekri\dodo\PDOConnector;
use Ashkanfekri\dodo\Response;
use App\Models\User;


class AppController
{
    public function install()
    {
//        create posts table
        $sql = "CREATE TABLE `posts` (
                `id` INT(11) NOT NULL AUTO_INCREMENT ,
                `title` VARCHAR(100) NOT NULL ,
                `body` TEXT NOT NULL ,
                `type` INT(3) NOT NULL ,
                `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        $db = (new PDOConnector())->query($sql)->execute();
//        create posts table


        //        create users table
        $sql = "CREATE TABLE `users` (
                `id` INT(11) NOT NULL AUTO_INCREMENT ,
                `name` VARCHAR(100) NOT NULL ,
                `email` VARCHAR(100) NOT NULL ,
                `password` VARCHAR(100) NOT NULL ,
                `remember_token` VARCHAR(100) DEFAULT(100),
                `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        $db = (new PDOConnector())->query($sql)->execute();
//        create users table

        return $db;
    }


    public function landing()
    {
        return User::all();


//        return view('static.landing');
//        (new Post())->lastPosts();
//        return Response::view('static.landing');
    }
}