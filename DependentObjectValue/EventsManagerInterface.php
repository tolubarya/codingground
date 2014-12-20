<?php

interface EventsManagerInterface
{
    public static function fire($event, $args);
    public static function on($event, $handler);
    public static function off($event, $handler);
}