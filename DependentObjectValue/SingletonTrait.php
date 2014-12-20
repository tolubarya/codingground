<?php

trait SingletonTrait
{
    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct() {}
    private function __wakeup() {}
    private function __clone() {}
}