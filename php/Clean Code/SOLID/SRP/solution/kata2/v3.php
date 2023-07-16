<?php

use PHPUnit\Framework\TestCase;

class TestsUtils {
  public static function createCourseWithSubjects(array $subjects): Course {
      return new Course(1, "Mathematics", $subjects);
  }
}

class CourseTest extends TestCase {
  public function testGetSubjectsAsString(): void {
      $subjects = ["Algebra", "Geometry", "Calculus"];
      $course = TestsUtils::createCourseWithSubjects($subjects);

      $expectedSubjects = "Algebra, Geometry, Calculus";
      $this->assertEquals($expectedSubjects, $course->getSubjectsAsString());
  }
}

class StudentTest extends TestCase {
  public function testGetCourseSubjects(): void {
      $subjects = ["Algebra", "Geometry", "Calculus"];
      $course = TestsUtils::createCourseWithSubjects($subjects);
      $student = new Student(1, "John Doe", $course);

      $expectedSubjects = "Algebra, Geometry, Calculus";
      $this->assertEquals($expectedSubjects, $student->getCourseSubjects());
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
/* 
Dans le test unitaire StudentTest, j'ai ajouter un objet Course avec des sujets de cours spécifiques. Ensuite, j'ajoute un objet Student en passant l'objet Course correspondant. Enfin, nous utilisons assertEquals pour vérifier que la méthode getCourseSubjects de Student renvoie les sujets de cours attendus.

De même, dans le test unitaire CourseTest, nous créons un objet Course avec des sujets de cours spécifiques, puis nous utilisons assertEquals pour vérifier que la méthode getSubjectsAsString renvoie les sujets de cours sous forme de chaîne attendus.

Ces tests permettent de vérifier le comportement des méthodes getCourseSubjects et getSubjectsAsString, en s'assurant qu'elles renvoient les valeurs attendues.

Petit refactor des tests pour respecter la LoD
- Dans l'ancien code, la classe Student contient des informations sur les cours, y compris les noms et les sujets des cours. Le seul choix possible était de séparer ces informations dans une classe distincte Course, et de passer une instance de cette classe à la classe Student au lieu de transmettre les informations de cours directement.
*/
