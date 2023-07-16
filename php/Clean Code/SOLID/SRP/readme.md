# Single Responsability Principle

## Rappel SRP
Le principe de la Responsabilité unique (Single Responsibility Principle) stipule qu'une classe ou un module ne devrait avoir qu'une seule raison de changer. En d'autres termes, une entité logicielle doit être responsable d'une seule tâche spécifique.

## KATA 1 (Débutant)
Prenons l'exemple d'une classe "Student" qui est responsable de contenir les informations des éléves et le noms/sujet de leurs cours associées.

Corrigez le code afin qu'il respecte le principe SRP.

### Sample code

```php
class Student {
  public function __construct(
      private int $id,
      readonly public string $name,
      readonly public int $courseId,
      readonly public string $courseName,
      readonly public array $courseSubjects
  ) {}

  public function getCourseSubjects(): string {
    return join(", ", $this->courseSubjects);
  }
}
```

### Contraintes Supplémentaires :
- Pratiquez le TDD
- Pratiquez le BabyStep
- Implementez les DesignPattern cohérents

### Pour aller encore plus loin...
- Adaptez le code pour respecter LoD

*Refaire le KATA en y ajoutant la régle métier suivante*

- Je souhaite ajouter la possibilité de notifier les étudiants lorsque de nouveaux sujets sont ajoutés à un cours. Les étudiants s'abonneraient au cours et recevraient des notifications lors de tout changement de sujets.
- Utilisez le design pattern `Observer` afin de rendre cela possible

*Refaire le KATA au sein d'un projet Symfony*

- Définir un événement
- Créer un listener d'événements
- Dispatch les événements
- Réagir aux événements au sein du code

## KATA 2 (Intermédiaire)
Prenons l'exemple d'une classe "Product" qui est responsable de la gestion des informations d'un produit, de son affichage sur la page du catalogue, de son stock, et de la gestion des commandes le concernant. Cependant, cette classe viole le principe de la Responsabilité unique (SRP) car elle a plusieurs raisons de changer.

### Sample code

```php
class OrderVO {
  public function __construct(
      readonly public string $id,
      readonly public string $customerName,
      readonly public string $customerEmail,
      readonly public int $quantity
  ) {}
}

class Product {
  public function __construct(
    private string $name,
    private string $description,
    private int $price,
    private int $stock
  ) {}

  public function displayOnCatalog() {
      // Affiche le produit sur la page du catalogue
  }

  public function updateStock(int $quantity) {
      // Met à jour la quantité en stock
  }

  public function processOrder(OrderVO $order) {
      // Traite une commande liée au produit
  }
}
```

### Contraintes Supplémentaires :
- Pratiquez le RGR pendant l'exercice (Red, Green, Refactor)
- Pratiquez le BabyStep
- Respectez les principes :
  - Clean Code

### Pour aller encore plus loin...
- Adaptez le code pour implementer le design pattern [`Observer`](https://refactoring.guru/fr/design-patterns/observer "Le design pattern Observateur") avec le useCase suivant :
  - Nous souhaitons mettre en œuvre un mécanisme où certaines classes sont informées automatiquement lorsqu'il y a des changements d'état dans d'autres classes. Cela peut être utile pour suivre les modifications du stock des produits ou les commandes traitées.
  - `Product` agit comme le sujet observé, tandis que la classe `CatalogDisplay` sera l'observateur. A vous de jouer !
