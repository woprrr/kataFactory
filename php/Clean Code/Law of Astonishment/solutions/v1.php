<?php

use PHPUnit\Framework\TestCase;

class ShapeAreaCalculatorTest extends TestCase
{
    public function testCalculateRectangleArea()
    {
        $rectangleShape = new ShapeVO(width: 5, height: 10);
        $rectangleArea = calculateRectangleArea($rectangleShape);
        $this->assertEquals(50, $rectangleArea);
    }

    public function testCalculateCircleArea()
    {
        $radius = 5.0;
        $circleArea = calculateCircleArea($radius);
        $this->assertEquals(78.54, round($circleArea, 2));
    }
}

class ShapeVO {
  public function __construct(
    readonly public int $width,
    readonly public int $height
  ) {}
}

const PI = 3.14;

function calculateRectangleArea(ShapeVO $shape): int {
  return $shape->width * $shape->height;
}

function calculateCircleArea(float $radius): float {
  return PI * ($radius ** 2);
}

$rectangleShape = new ShapeVO(width: 5, height: 10);
$circleArea = calculateCircleArea(5.0);

// Utilisation de la méthode calculateRectangleArea avec ShapeVO
$rectangleArea = calculateRectangleArea($rectangleShape);
var_dump($rectangleArea);
