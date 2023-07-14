<?php

// FIRST TEST
use PHPUnit\Framework\TestCase;

class ShapeAreaCalculatorTest extends TestCase
{
    public function testRectangleAreaCalculation()
    {
        $calculatorContext = new ShapeAreaCalculatorContext();
        $calculatorContext->setCalculator(new ReactangleShapeAreaCalculator());
        $rectangleShape = new ShapeVO(width: 5, height: 10);
        $rectangleArea = $calculatorContext->calculateArea(shape: $rectangleShape);
        $this->assertEquals(50, $rectangleArea);
    }

    public function testCircleAreaCalculation()
    {
        $calculatorContext = new ShapeAreaCalculatorContext();
        $calculatorContext->setCalculator(new CircleShapeAreaCalculator());
        $circleShape = new ShapeVO(radius: 5.0);
        $circleArea = $calculatorContext->calculateArea(shape: $circleShape);
        $this->assertEquals(78, $circleArea);
    }

    /**
     * @dataProvider invalidShapesProvider
     */
    public function testInvalidShapes(ShapeVO $shape)
    {
        $this->expectException(InvalidArgumentException::class);

        $calculatorContext = new ShapeAreaCalculatorContext();
        $calculatorContext->setCalculator(new ReactangleShapeAreaCalculator());
        $calculatorContext->calculateArea(shape: $shape);
    }

    public function invalidShapesProvider()
    {
        return [
            [new ShapeVO(width: 0, height: 10)],
            [new ShapeVO(width: 5, height: 0)],
            [new ShapeVO(width: 0, height: 0)],
            [new ShapeVO(radius: 0)],
            [new ShapeVO()],
        ];
    }
}

// 2 IMPLEMENT + BabyStep + Clean code improvments
class ShapeVO {
  public function __construct(
    readonly public ?int $width = null,
    readonly public ?int $height = null,
    readonly public ?float $radius = null
  ) {}
}

interface ShapeAreaCalculatorInterface {
  public function calculateArea(ShapeVO $shape): int;
  public function isApplicable(ShapeVO $shape): bool;
}

class ReactangleShapeAreaCalculator implements ShapeAreaCalculatorInterface {
  public function calculateArea(ShapeVO $shape): int
  {
    if (!$this->isApplicable($shape)) {
      throw new InvalidArgumentException("The properties must be defined and greater than zero.");
    }

    return $shape->width * $shape->height;
  }

  public function isApplicable(ShapeVO $shape): bool
  {
    $isApplicable = true;
    $hasWidth = isset($shape->width) || $shape->width > 0;
    $hasHeight = isset($shape->height) || $shape->height > 0;
    
    if(!$hasWidth || !$hasHeight) {
        $isApplicable = false;
    }

    return $isApplicable;
  }
}

class CircleShapeAreaCalculator implements ShapeAreaCalculatorInterface {
  public function calculateArea(ShapeVO $shape): int
  {
    if (!$this->isApplicable($shape)) {
      throw new InvalidArgumentException("The radius of the circle must be defined and greater than zero.");
    }

    return round(M_PI * ($shape->radius ** 2));
  }

  public function isApplicable(ShapeVO $shape): bool
  {
    return isset($shape->radius) && ($shape->radius > 0);
  }
}

class ShapeAreaCalculatorContext {
  private $calculator;

  public function __construct(ShapeAreaCalculatorInterface $calculator) {
      $this->calculator = $calculator;
  }

  public function calculateArea(ShapeVO $shape): int
  {
    return $this->calculator->calculateArea($shape);
  }
}

$calculatorContext = new ShapeAreaCalculatorContext(new ReactangleShapeAreaCalculator());
$rectangleShape = new ShapeVO(width: 5, height: 10);
$rectangleArea = $calculatorContext->calculateArea(shape: $rectangleShape);
var_dump("Rectangle Area is : " . $rectangleArea);

$calculatorContext = new ShapeAreaCalculatorContext(new CircleShapeAreaCalculator());
$circleShape = new ShapeVO(radius: 5.0);
$circleArea = $calculatorContext->calculateArea(shape: $circleShape);
var_dump("Circle Area is : " . $circleArea);

/*
* La gestion des exceptions peut-être améliorer pour respecter le clean code topic :
* 
* Gestion des erreurs :
* De sorte à rendre le code plus clair, plus lisible et plus maintenable.
*/
