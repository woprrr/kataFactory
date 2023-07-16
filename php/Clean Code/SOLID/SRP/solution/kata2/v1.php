<?php

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

/* SRP */
/*
La classe Student ne s'occupe plus directement des détails du cours (comme l'ID, le nom et les sujets du cours). Au lieu de cela, elle délègue cette responsabilité à une nouvelle classe Course. La classe Student se concentre désormais uniquement sur les informations spécifiques à l'étudiant (comme l'ID, le nom et le lien vers le cours).

La classe Course est créée pour encapsuler les informations relatives au cours, telles que l'ID, le nom et les sujets du cours. Elle fournit également une méthode getSubjectsAsString pour obtenir une représentation sous forme de chaîne des sujets du cours.

Ainsi, chaque classe a maintenant une responsabilité unique. La classe Student gère les informations relatives à l'étudiant, tandis que la classe Course gère les informations relatives au cours. Cela permet une meilleure séparation des responsabilités et facilite la maintenabilité et l'évolutivité du code.
*/
