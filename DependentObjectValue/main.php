<?php

require_once 'DependentObjectValue.php';

$x = new DependentObjectValue();
$y = new DependentObjectValue($x, function($value) {
    return pow($value, 2) + 2 * $value;
});

echo "[ x; y]\n";
foreach (range(-5, 5) as $value) {
    $x->set($value);
    echo "[$x; $y]\n";
}
