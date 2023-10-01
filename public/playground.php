<?php
use Illuminate\Support\Collection;

require __DIR__.'/../vendor/autoload.php';

$number = new Collection([1,2,3,4,10,5]);


// $x = $number->map(function($number) {
//     return $number * 10;
// });

$x = $number->filter(function($number) {
    return $number  > 3;
});

echo $x;