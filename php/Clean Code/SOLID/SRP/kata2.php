<?php

class CoursesArrayCollection extends Ds\Collection {}

class Student {
  public function __construct(
    private int $id,
    private string $name,
    private int $courseId,
    private string $courseName,
    private CoursesArrayCollection $courseSubjects
  ) {}

  public function getCourseSubjects(): string {
    return join(", ", $this->courseSubjects->toArray());
  }
}
