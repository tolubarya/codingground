<?php

require_once __DIR__ . '/../bootstrap.php';

$config = require APPLICATION_PATH . 'config/' . APP_ENVIRONMENT . '/main.php';

/** @TODO Config must be implement the pattern Registry */
/** @TODO Need to implement the Application */
/** @TODO Need to implement the Routing */
/** @TODO Need to implement the Dispatcher */

/** @TODO This code must be moved to the controller */
try {
    $userId = 1;
    $user = App\Model\User::findByPk($userId);
    
    if ($user) {
        echo json_encode($user) . PHP_EOL;
    } else {
        echo 'User not found' . PHP_EOL;
    }
} catch(Exception $e) {
    echo $e . PHP_EOL;
}