<?php

/** @TODO Implement a class of dependent objects on events */
require_once 'DependentObjectValue.php';

############### Example 1 ###############

$x = new DependentObjectValue(10);
$y = new DependentObjectValue($x, function($value) { return $value + 5; });

echo "y = $y\n";
$x->set(20);
echo "y = $y\n";

############### Example 2 ###############

$x = new DependentObjectValue();
$y = new DependentObjectValue($x, function($value) {
    /** Calculation of the parabola */
    return pow($value, 2) + 2 * $value;
});

echo "[ x; y]\n";
foreach (range(-5, 5) as $value) {
    $x->set($value);
    echo "[$x; $y]\n";
}
