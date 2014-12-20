<?php

require_once 'EventsManagerInterface.php';

final class EventsManager implements EventsManagerInterface
{
    private static $register = [];

    private static function getHash($handler)
    {
        if ($handler instanceof Closure) {
            return spl_object_hash($handler);
        } elseif (is_array($handler)) {
            return spl_object_hash($handler[0]) . $handler[1];
        } else {
            return md5($handler);
        }
    }

    public static function fire($event, $args)
    {
        if (isset(self::$register[$event])) {
            foreach (self::$register[$event] as $handler) {
                call_user_func($handler, $args);
            }
        }
    }

    public static function on($event, $handler)
    {
        $unique = self::getHash($handler);
        self::$register[$event][$unique] = $handler;
    }

    public static function off($event, $handler)
    {
        $unique = self::getHash($handler);
        unset(self::$register[$event][$unique]);
    }
}