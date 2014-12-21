<?php

/**
 * @namespace
 */
namespace Fw\Library;

/**
 * Arrayable is the interface that should be implemented by classes
 * who want to support customizable representation of their instances.
 */
interface Arrayable
{
    /**
     * @return array
     */
    public function toArray();
}
