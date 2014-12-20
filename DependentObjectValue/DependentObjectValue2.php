<?php

require_once 'DependentObjectValueInterface.php';
require_once 'EventsManager.php';

class DependentObjectValue implements DependentObjectValueInterface
{
    const EVENT_PREFIX = 'DOVEvent';

    private $value;
    private $callback;
    private $event;

    private static $number = 0;

    public function __construct($value = null, Closure $callback = null)
    {
        $this->event = static::EVENT_PREFIX . self::$number++;
        $this->set($value, $callback);
    }

    public function __toString()
    {
        return (string) $this->get();
    }

    public function set($value = null, Closure $callback = null)
    {
        if ($callback) {
            $this->callback = $callback;
        }

        if ($value instanceof self) {
            EventsManager::getInstance()->on($value->getEvent(), [$this, 'set']);
        } else {
            if ($this->callback) {
                $value = $this->callback->__invoke($value);
            }
            $this->value = $value;
            EventsManager::getInstance()->fire($this->getEvent(), $this->value);
        }
    }

    public function get()
    {
        return $this->value;
    }

    public function getEvent()
    {
        return $this->event;
    }
}
