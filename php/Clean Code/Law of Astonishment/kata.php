<?php

function calculateArea($width, $height, $isRectangle = true) {
  if ($isRectangle) {
    return $width * $height;
  } else {
    return 3.14 * ($width / 2) * ($height / 2);
  }
}

$rectangleArea = calculateArea(5, 10);
$circleArea = calculateArea(5, 10, false);
