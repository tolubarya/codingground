<?php

interface DependentObjectValueInterface
{
    public function __construct($value = null, Closure $callback = null);
    public function __toString();
    public function set($value = null, Closure $callback = null);
    public function get();
}
