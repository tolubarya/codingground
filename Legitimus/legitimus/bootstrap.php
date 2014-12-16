<?php

defined('APP_ENVIRONMENT') or define('APP_ENVIRONMENT', getenv('APP_ENVIRONMENT'));
defined('ROOT_PATH') or define('ROOT_PATH', __DIR__ . '/../');
defined('APPLICATION_PATH') or define('APPLICATION_PATH', __DIR__ . '/');
defined('FRAMEWORK_PATH') or define('FRAMEWORK_PATH', __DIR__ . '/../Fw/');

require_once FRAMEWORK_PATH . 'Vendor/Jwage/SplClassLoader.php';

$classLoader = new SplClassLoader('App', APPLICATION_PATH);
$classLoader->register();
$classLoader = new SplClassLoader('Fw', ROOT_PATH);
$classLoader->register();