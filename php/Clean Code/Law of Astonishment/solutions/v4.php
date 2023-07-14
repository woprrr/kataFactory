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
        $this->expectException(InvalidShapeException::class);

        $calculatorContext = new ShapeAreaCalculatorContext();
        $calculatorContext->setCalculator(new ReactangleShapeAreaCalculator());
        $calculatorContext->calculateArea(shape: $shape);
    }

    /**
     * @dataProvider invalidDimensionsProvider
     */
    public function testInvalidDimensions(ShapeVO $shape)
    {
        $this->expectException(InvalidDimensionsException::class);

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

    public function invalidDimensionsProvider()
    {
        return [
            [new ShapeVO(width: -5, height: 10)],
            [new ShapeVO(width: 5, height: -10)],
            [new ShapeVO(width: 0, height: 10)],
            [new ShapeVO(width: 5, height: 0)],
            [new ShapeVO(radius: -5)],
            [new ShapeVO()],
        ];
    }
}

class InvalidShapeException extends InvalidArgumentException {
  public const MESSAGE = "Invalid shape. The properties must be defined and greater than zero.";
}

class InvalidDimensionsException extends InvalidArgumentException {
  public const NOT_DEFINED_MESSAGE = "Invalid dimensions. %s must be defined.";
  public const WRONG_DIMENSIONS_MESSAGE = "Invalid dimensions. %s must be greater than zero.";
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
      throw new InvalidShapeException(InvalidShapeException::MESSAGE);
    }

    return $shape->width * $shape->height;
  }

  public function isApplicable(ShapeVO $shape): bool
  {
    if (!isset($shape->width) || !isset($shape->height)) {
      throw new InvalidDimensionsException(
        sprintf(InvalidDimensionsException::NOT_DEFINED_MESSAGE, 'Width and height')
      );
    }

    if ($shape->width <= 0 || $shape->height <= 0) {
      throw new InvalidDimensionsException(
        sprintf(InvalidDimensionsException::WRONG_DIMENSIONS_MESSAGE, 'Width and height')
      );
    }

    return true;
  }
}

class CircleShapeAreaCalculator implements ShapeAreaCalculatorInterface {
  public function calculateArea(ShapeVO $shape): int
  {
    if (!$this->isApplicable($shape)) {
      throw new InvalidShapeException("The radius of the circle must be defined and greater than zero.");
    }

    return round(M_PI * ($shape->radius ** 2));
  }

  public function isApplicable(ShapeVO $shape): bool
  {
    if (!isset($shape->radius)) {
      throw new InvalidDimensionsException(
        sprintf(InvalidDimensionsException::NOT_DEFINED_MESSAGE, 'Radius')
      );
    }

    if ($shape->radius <= 0) {
      throw new InvalidDimensionsException(
        sprintf(InvalidDimensionsException::WRONG_DIMENSIONS_MESSAGE, 'Radius')
      );
    }

    return true;
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

try {
  $calculatorContext = new ShapeAreaCalculatorContext(new ReactangleShapeAreaCalculator());
  $rectangleShape = new ShapeVO(width: 5, height: 10);
  $rectangleArea = $calculatorContext->calculateArea(shape: $rectangleShape);
  var_dump("Rectangle Area is : " . $rectangleArea);
} catch (InvalidShapeException | InvalidDimensionsException $e) {
  // Gérer l'erreur pour le rectangle invalide
  echo "Error: " . $e->getMessage();
}

try {
  $calculatorContext = new ShapeAreaCalculatorContext(new CircleShapeAreaCalculator());
  $circleShape = new ShapeVO(radius: 5.0);
  $circleArea = $calculatorContext->calculateArea(shape: $circleShape);
  var_dump("Circle Area is : " . $circleArea);
} catch (InvalidShapeException | InvalidDimensionsException $e) {
  // Gérer l'erreur pour le cercle invalide
  echo "Error: " . $e->getMessage();
}

/*
* Les améliorations apportées incluent :
* 
* Utilisation de constantes pour les messages d'erreur dans les exceptions 
* InvalidShapeException et InvalidDimensionsException.
* 
* Cela rend les messages d'erreur plus flexibles et faciles à maintenir.
* 
* Les exceptions InvalidDimensionsException ont été séparées en deux constantes : 
* NOT_DEFINED_MESSAGE et WRONG_DIMENSIONS_MESSAGE, ce qui permet de distinguer les cas 
* où les dimensions ne sont pas définies et les cas où elles sont incorrectes.
* 
* L'utilisation de sprintf pour insérer dynamiquement les noms des dimensions dans 
* les messages d'erreur, ce qui rend les messages plus précis et personnalisés.
*
* Dans l'ensemble, ces améliorations contribuent à rendre le code plus clair, plus lisible 
* et plus maintenable.
*/
