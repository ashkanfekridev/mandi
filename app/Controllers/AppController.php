<?php


namespace App\Controllers;
use App\Models\Posts;
use Ashkanfekri\dodo\PDOConnector;
use Ashkanfekri\dodo\Response;
use App\Models\Users;


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

        return $db;}



    public function landing(){

        $user = new Users();
        $user->name = "ashkan";
        $user->email = "ashkan@gmail.com";
        $user->password = "12345678";
        return $user->create();

//
//        [
//            'name'=>'ashkan',
//            'email'=>"ashkan@gmail.com",
//            'password' => "12345678"
//        ]


    (new Posts())->lastPosts();
        return Response::view('static.landing');
    }
}