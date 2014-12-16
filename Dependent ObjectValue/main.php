<?php

require_once 'ObjectValue.php';

$a = new ObjectValue(5);
$b = new ObjectValue(null, function($x) { return $x + 10; }, $a);

echo $b . PHP_EOL;
$a->set(45);
echo $b . PHP_EOL;