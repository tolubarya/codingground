<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../bootstrap.php';

$config = require APPLICATION_PATH . 'config/' . APP_ENVIRONMENT . '/main.php';

try {
    /** @TODO Config must be implement the pattern Registry */
    /** @TODO Need to implement the Fw\Application */
    /** @TODO Need to implement the Fw\Http\Request */
    /** @TODO Need to implement the Fw\Http\Response */
    /** @TODO Need to implement the Fw\Router */
    /** @TODO Need to implement the Fw\Dispatcher */
    /** @TODO Need to implement the Fw\DependencyInjector */

    /** Test controller */
    $controller = new App\Controller\UserController();
    $controller->indexAction();
} catch(Exception $e) {
    echo $e . PHP_EOL;
}
