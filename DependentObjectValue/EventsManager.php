<?php

require_once 'EventsManagerInterface.php';
require_once 'SingletonTrait.php';

class EventsManager implements EventsManagerInterface
{
    use SingletonTrait;

    private $register = [];

    private function getHash($handler)
    {
        if ($handler instanceof Closure) {
            return spl_object_hash($handler);
        } elseif (is_array($handler)) {
            return spl_object_hash($handler[0]) . $handler[1];
        } else {
            return md5($handler);
        }
    }

    public function fire($event, $args)
    {
        if (isset($this->register[$event])) {
            foreach ($this->register[$event] as $handler) {
                call_user_func($handler, $args);
            }
        }
    }

    public function on($event, $handler)
    {
        $unique = $this->getHash($handler);
        $this->register[$event][$unique] = $handler;
    }

    public function off($event, $handler)
    {
        $unique = $this->getHash($handler);
        unset($this->register[$event][$unique]);
    }
}
