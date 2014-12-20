<?php

require_once 'DependentObjectValueInterface.php';

class DependentObjectValue implements DependentObjectValueInterface
{
    private $value;
    private $callback;

    public function __construct($value = null, Closure $callback = null)
    {
        $this->set($value, $callback);
    }

    public function __toString()
    {
        return (string) $this->get();
    }

    public function set($value = null, Closure $callback = null)
    {
        $this->value = $value;
        $this->callback = $callback;
    }

    public function get()
    {
        if ($this->callback && $this->value instanceof self) {
            return $this->callback->__invoke($this->value->get());
        }
        return $this->value;
    }
}
