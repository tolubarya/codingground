<?php

interface DependentObjectValueInterface
{
    public function __construct($value, Closure $callback);
    public function __toString();
    public function set($value, Closure $callback);
    public function get();
}