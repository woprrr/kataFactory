<?php

class Student {
  private int $id;
  public string $name;
  private int $courseId;
  private string $courseName;
  private string $courseSubjects;

  // constructor

  public function getCourseSubjects(): string {
    return join(", ", $this->courseSubjects);
  }
}








































// S GOOD
class Student {
  private int $id;
  private string $name;
  private Course $course;

  // constructor
}

class Course {
  private int $id;
  private string $name;
  private array $subjects;

  // constructor

  public function getCourseSubjects(): string {
    return join(", ", $this->subjects);
  }
}













class Order {
  private int $id;
  public array $items;
  public string $shipping;

  // constructor

  private function getTotalCost(): int {
    // calculates total cost
  }

  public function getShippingCosts(): int {
    $totalCost = $this->getTotalCost();

    if ($this->shipping === "ground") {
      return $totalCost > 50 ? 0 : 5.95;
    }

    if ($this->shipping === "air") {
      return 10.95;
    }

    return 0;
  }
}






































// OCP GOOD
class Order {
  private int $id;
  private array $items;
  private Shipping $shipping;

  // constructor

  public function getTotalCost(): int
  {
    // calculates total cost
  }
}

interface Shipping
{
  public function getShippingCosts(int $totalCost): int;
}

class Ground implements Shipping {
  public function getShippingCosts(int $totalCost): int {
    return $totalCost > 50 ? 0 : 5.95;
  }
}

class Air implements Shipping {
  public function getShippingCosts(int $totalCost): int {
    return 10.95;
  }
}

class PickUpInStore implements Shipping {
  public function getShippingCosts(int $totalCost): int {
    return 0;
  }
}



























// L
class Rectangle
{
    protected $width;
    protected $height;

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function area()
    {
         return $this->height * $this->width;
    }
}

class Square extends Rectangle
{
    public function setHeight($value)
    {
        $this->width = $value;
        $this->height = $value;
    }

    public function setWidth($value)
    {
        $this->width = $value;
        $this->height = $value;
    }
}












// L GOOD
interface ShapeInterface
{
    public function setHeight($height);
    public function getHeight();
    public function setWidth($width);
    public function getWidth();
    public function area();
}

abstract class AbstractShape implements ShapeInterface
{
    protected $width;
    protected $height;

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function area()
    {
        return $this->height * $this->width;
    }
}

class Rectangle extends AbstractShape
{
    // La classe Rectangle hérite du comportement de la classe abstraite AbstractShape.
}

class Square extends AbstractShape
{
    public function setHeight($side)
    {
        $this->width = $side;
        $this->height = $side;
    }

    public function setWidth($side)
    {
        $this->width = $side;
        $this->height = $side;
    }
}






























// I in PHP
interface Animal {
  public function walk(): void;
  public function fly(): void;
}

class Dog implements Animal {
  public function walk(): void {
    dd("Walking");
  }

  public function fly(): void {
    throw new Error("Dogs cannot fly");
  }
}

class Duck implements Animal {
  public function walk(): void {
    dd("Walking");
  }

  public function fly(): void {
    dd("Flying");
  }
}













// D
class MySQLDatabase {
  public function save(Order $order) {
      if (empty($order->id)) {
          $this->insert($order);
      } else {
          $this->update($order);
      }
  }

  private function insert(Order $order) {
      // Insertion dans la base de données MySQL
  }

  private function update(Order $order) {
      // Mise à jour dans la base de données MySQL
  }
}

class OrderService {
  private MySQLDatabase $database;

  public function __construct(MySQLDatabase $database) {
      $this->database = $database;
  }

  public function saveOrder(Order $order): void {
      $this->database->save($order);
  }
}






















// DIP GOOD
class OrderService {
  private Database $database;

  // constructor

  public function save(Order $order): void {
    this->database->save($order);
  }
}

interface Database {
  public function save(Order $order): void;
}

class MySQLDatabase implements Database {
  public function save(Order $order) {
    if (empty($order->id)) {
      // insert
    } else {
      // update
    }
  }
}

















class Board
{
    private const int Dimension = 15;
    private int[,] cells = new int[Dimension, Dimension];

    public string Stringify()
    {
        var buffer = new StringBuilder();

        // 0
        for (var i = 0; i < Dimension; ++i)
        {
            // 1

        }

        return buffer.ToString();
    }
}


















class Board
{
    private const int Dimension = 15;
    private int[,] cells = new int[Dimension, Dimension];

    public string Stringify()
    {
        // 0
        var buffer = new StringBuilder();

        StringifyRows(buffer);

        return buffer.ToString();
    }

    private void StringifyRows(StringBuilder buffer)
    {
        // 0
        for (var i = 0; i < Dimension; ++i)
        {
            // 1
            StringifyRow(buffer, i);
        }
    }

    private void StringifyRow(StringBuilder buffer, int row)
    {
        // 0
        for (var i = 0; i < Dimension; ++i)
        {
            // 1
            buffer.Append(cells[row, i]);
        }
        buffer.Append("\n");
    }
}






















If (x[0] == 99999) { //…

If (isFlagged) { //…

If (cell.isFlagged) { //…








  class Time {
    int: d; //elapsed time in days
  }
  class Time {
    int: elapsedTimeInDays;
  }












  if (count === 7) {...}
  if (count === MAX_CLASSES_PER_STUDENT) {...}


















  final String outputDir = ctxt.getOptions().getScratchDir().getAbsolutePath();




























  Options opts = ctxt.getOptions();
  File scratchDir = opts.getScratchDir();
  final String outputDir = scratchDir.getAbsolutePath();
