<?php

interface GradeCalculatorInterface {
    public function calculateGrade(int $score): int;
}

class AGradeCalculator implements GradeCalculatorInterface {
    private const int MAX_SCORE = 95;

    public function calculateGrade(int $score): int
    {
        if ($score > MAX_SCORE) {
            return 'A+';
        }
        
        return 'A';
    }
}

class BGradeCalculator implements GradeCalculatorInterface {
    private const int MAX_SCORE = 85;

    public function calculateGrade(int $score): int
    {
        if ($score > MAX_SCORE) {
            return 'B+';
        }
        
        return 'B';
    }
}

class CGradeCalculator implements GradeCalculatorInterface {
    private const int MAX_SCORE = 75;

    public function calculateGrade(int $score): int
    {
        if ($score > MAX_SCORE) {
            return 'C+';
        }
        
        return 'C';
    }
}

class FGradeCalculator implements GradeCalculatorInterface {
    public function calculateGrade(int $score): int
    {
        return 'F';
    }
}

class GradeCalculatorContext {
    private $calculator;

    public function setCalculator(GradeCalculatorInterface $calculator) {
        $this->calculator = $calculator;
    }

    public function calculateGrade(int $score): int
    {
      return $this->calculator->calculateGrade($score);
    }
}

// Exemple d'utilisation
$calculatorContext = new GradeCalculatorContext();

// Utilisation du grade calculator A
$calculatorContext->setCalculator(new AGradeCalculator());
$gradeA = $calculatorContext->calculateGrade(92); // Résultat : 'A'

// Utilisation du grade calculator B
$calculatorContext->setCalculator(new BGradeCalculator());
$gradeB = $calculatorContext->calculateGrade(82); // Résultat : 'B'

// Utilisation du grade calculator C
$calculatorContext->setCalculator(new CGradeCalculator());
$gradeC = $calculatorContext->calculateGrade(73); // Résultat : 'C'

// Utilisation du grade calculator F
$calculatorContext->setCalculator(new FGradeCalculator());
$gradeF = $calculatorContext->calculateGrade(50); // Résultat : 'F'







/*
Dans cet exemple, nous avons défini une interface GradeCalculatorInterface qui définit une méthode calculateGrade(). Ensuite, nous avons créé des classes concrètes implémentant cette interface pour chaque catégorie de note (A, B, C, F).

La classe GradeCalculatorContext agit comme un contexte qui encapsule la logique de calcul de la note. Elle a une méthode calculateGrade() qui délègue le calcul à l'objet de calcul approprié, défini par la classe GradeCalculatorInterface utilisée.

En utilisant ce design pattern, vous pouvez facilement ajouter de nouveaux calculateurs de notes en implémentant l'interface GradeCalculatorInterface sans avoir à modifier la logique existante. Cela rend le code plus extensible, maintenable et conforme au principe de conception SOLID "Ouvert pour l'extension, fermé pour la modification".

Le design pattern Strategy vous permet de résoudre le problème de complexité lié à l'utilisation de structures if/else en encapsulant les algorithmes dans des classes distinctes, ce qui rend le code plus flexible et modulaire.
*/
