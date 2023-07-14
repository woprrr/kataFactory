<?php


$parts = ['apple', 'pear'];
$fruits = ['banana', 'orange', ...$parts, 'watermelon'];
var_dump($fruits);


$arr1 = [1, 2, 3];
$arr2 = [4, 5, 6];
$arr3 = [...$arr1, ...$arr2];
$arr4 = [...$arr1, ...$arr3, 7, 8, 9];
var_dump($arr4);
