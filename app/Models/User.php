<?php


namespace App\Models;


use App\Models;

class User extends Model
{
    protected $table = 'users';
    protected $key = 'id';
    protected $fillable = ['name', 'email'];

}