<?php


namespace App\Controllers;
use App\Models\Users;
use Ashkanfekri\dodo\Response;


class AppController
{
    public function landing(){

        return Response::view('static.landing');
    }
}