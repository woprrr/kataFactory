# Single Responsability Principle

## Rappel
Le principe de la Responsabilité unique (Single Responsibility Principle) stipule qu'une classe ou un module ne devrait avoir qu'une seule raison de changer. En d'autres termes, une entité logicielle doit être responsable d'une seule tâche spécifique.

## KATA
Prenons l'exemple d'une classe "Product" qui est responsable de la gestion des informations d'un produit, de son affichage sur la page du catalogue, de son stock, et de la gestion des commandes le concernant. Cependant, cette classe viole le principe de la Responsabilité unique (SRP) car elle a plusieurs raisons de changer.

### Sample code

```php
<?php

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
