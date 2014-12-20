<?php

interface EventsManagerInterface
{
    public function fire($event, $args);
    public function on($event, $handler);
    public function off($event, $handler);
}
