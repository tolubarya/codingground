<?php

require_once 'DependentObjectValue.php'; // reactive dependency
//require_once 'DependentObjectValue2.php'; // interactive dependency (events based)

############### Example 1 ###############

$x = new DependentObjectValue(10);
$y = new DependentObjectValue($x, function($value) { return $value + 5; });
$z = new DependentObjectValue($y, function($value) { return $value + 5; });

echo "$x; $y; $z\n";
$x->set(20);
echo "$x; $y; $z\n";

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
