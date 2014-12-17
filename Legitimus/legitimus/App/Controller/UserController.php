<?php

/**
 * @namespace
 */
namespace App\Controller;

use Fw\Mvc\Controller;
use App\Model\User;

/**
 * Class UserController
 */
class UserController extends Controller
{
    /**
     * Default action
     * 
     * @return void
     */
    public function indexAction()
    {
        $userId = 1;
        $user = User::findByPk($userId);
        
        if ($user) {
            echo json_encode($user) . PHP_EOL;
        } else {
            echo 'User not found' . PHP_EOL;
        }
    }
}
