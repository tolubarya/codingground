<?php

class ObjectValue
{
    private $callback;
    private $dependent;
    private $value;

    public function __construct($value = null, Closure $callback = null, ObjectValue $dependent = null)
    {
        $this->set($value);
        $this->setDependency($callback, $dependent);
    }

    public function __toString()
    {
        return (string) $this->get();
    }

    public function setDependency(Closure $callback = null, ObjectValue $dependent = null)
    {
        $this->callback = $callback;
        $this->dependent = $dependent;
    }

    public function set($value = null)
    {
        $this->value = $value;
    }

    public function get()
    {
        if ($this->callback && $this->dependent) {
            return $this->callback->__invoke($this->dependent->get());
        }
        return $this->value;
    }
}