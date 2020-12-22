<?php


namespace App\database\migrate;


use App\src\database\migrates\Blueprint;
use App\src\database\migrates\Schema;

class CreateUsersTable
{
    public static function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->text('bio');
        });
    }
}