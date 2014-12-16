<?php

class DependentObjectValue
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
    }

    public function get()
    {
        if ($this->callback && self instanceof $this->value) {
            return $this->callback->__invoke($this->value->get());
        }
        return $this->value;
    }
}