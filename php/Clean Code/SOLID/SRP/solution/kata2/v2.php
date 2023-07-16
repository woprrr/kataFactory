<?php

use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase {
    public function testGetCourseSubjects(): void {
        $course = new Course(1, "Mathematics", ["Algebra", "Geometry", "Calculus"]);
        $student = new Student(1, "John Doe", $course);

        $expectedSubjects = "Algebra, Geometry, Calculus";
        $this->assertEquals($expectedSubjects, $student->getCourseSubjects());
    }
}

class CourseTest extends TestCase {
    public function testGetSubjectsAsString(): void {
        $course = new Course(1, "Mathematics", ["Algebra", "Geometry", "Calculus"]);

        $expectedSubjects = "Algebra, Geometry, Calculus";
        $this->assertEquals($expectedSubjects, $course->getSubjectsAsString());
    }
}

class Student {
  public function __construct(
      private int $id,
      readonly public string $name,
      readonly public Course $course
  ) {}

  public function getCourseSubjects(): string {
    return $this->course->getSubjectsAsString();
  }
}

class Course {
  public function __construct(
      readonly public int $id,
      readonly public string $name,
      readonly public array $subjects
  ) {}

  public function getSubjectsAsString(): string {
    return join(", ", $this->subjects);
  }
}

@TODO LA DOC ...
/* Dans le test unitaire StudentTest, nous créons un objet Course avec des sujets de cours spécifiques. Ensuite, nous créons un objet Student en passant l'objet Course correspondant. Enfin, nous utilisons assertEquals pour vérifier que la méthode getCourseSubjects de Student renvoie les sujets de cours attendus.

De même, dans le test unitaire CourseTest, nous créons un objet Course avec des sujets de cours spécifiques, puis nous utilisons assertEquals pour vérifier que la méthode getSubjectsAsString renvoie les sujets de cours sous forme de chaîne attendus.

Ces tests permettent de vérifier le comportement des méthodes getCourseSubjects et getSubjectsAsString, en s'assurant qu'elles renvoient les valeurs attendues.
*/
