
class Student {
  id: number;
  name: string;
  courseId: number;
  courseName: string;
  courseSubjects: string[];

  // constructor

  getCourseSubjects(): string {
    return this.courseSubjects.join(", ");
  }
}






































// S GOOD
class Student {
  id: number;
  name: string;
  course: Course;

  // constructor
}

class Course {
  id: number;
  name: string;
  subjects: string[];

  // constructor

  getCourseSubjects(): string {
    return this.subjects.join(", ");
  }
}














class Order {
  id: number;
  items: string[];
  shipping: string;

  // constructor

  getTotalCost(): number {
    // calculates total cost
  }

  getShippingCosts(): number {
    const totalCost = this.getTotalCost();

    if (this.shipping === "ground") {
      return totalCost > 50 ? 0 : 5.95;
    }

    if (this.shipping === "air") {
      return 10.95;
    }

    return 0;
  }
}






































// OCP GOOD
class Order {
  id: number;
  items: string[];
  shipping: Shipping;

  // constructor

  getTotalCost(): number {
    // calculates total cost
  }
}

interface Shipping {
  getShippingCosts(totalCost: number): number;
}

class Ground implements Shipping {
  getShippingCosts(totalCost: number): number {
    return totalCost > 50 ? 0 : 5.95;
  }
}

class Air implements Shipping {
  getShippingCosts(): number {
    return 10.95;
  }
}

class PickUpInStore implements Shipping {
  getShippingCosts(): number {
    return 0;
  }
}



























class Order {
  id: number;
  items: string[];
  payed: boolean;

  // constructor

  markAsPaid(): void {
    this.payed = true;
  }
}

class DraftOrder extends Order {
  markAsPaid(): void {
    throw new Error("Draft orders can't be payed");
  }
}




















// L GOOD
class Order {
  id: number;
  items: string[];

  // constructor
}

class ConfirmedOrder extends Order {
  payed: boolean;

  // constructor

  markAsPaid(): void {
    this.payed = true;
  }
}































// I
interface Animal {
  walk(): void;
  fly(): void;
}

class Dog implements Animal {
  walk() {
    console.log("Walking");
  }

  fly() {
    throw new Error("Dogs cannot fly");
  }
}

class Duck implements Animal {
  walk() {
    console.log("Walking");
  }

  fly() {
    console.log("Flying");
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
class OrderService {
  database: MySQLDatabase;

  // constructor

  save(order: Order): void {
    if (order.id === undefined) {
      this.database.insert(order);
    } else {
      this.database.update(order);
    }
  }
}

class MySQLDatabase {
  insert(order: Order) {
    // insert
  }

  update(order: Order) {
    // update
  }
}





















// DIP GOOD
class OrderService {
  database: Database;

  // constructor

  save(order: Order): void {
    this.database.save(order);
  }
}

interface Database {
  save(order: Order): void;
}

class MySQLDatabase implements Database {
  save(order: Order) {
    if (order.id === undefined) {
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
            for (var j = 0; j < Dimension; ++j)
            {
                // 2
                buffer.Append(cells[i, j]);
            }
            buffer.Append("\n");
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
