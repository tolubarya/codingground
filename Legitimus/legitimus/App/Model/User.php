<?php

/**
 * @namespace
 */
namespace App\Model;

use Fw\Mvc\Model;

/**
 * class User
 */
class User extends Model
{
    protected static $primaryKey = 'id';

    public $id;
    public $firstname;
    public $lastname;
    public $age;
}