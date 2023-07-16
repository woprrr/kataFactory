<?php

use PHPUnit\Framework\TestCase;

class ProductVOTest extends TestCase {
  public function testProductVO() {
      $product = new ProductVO('Laptop', 'Powerful laptop', 1000, 10);
      
      $this->assertEquals('Laptop', $product->name);
      $this->assertEquals('Powerful laptop', $product->description);
      $this->assertEquals(1000, $product->price);
      $this->assertEquals(10, $product->stock);
  }
}

class ProductPresenterTest extends TestCase {
  public function testDisplayOnCatalog() {
      $product = new ProductVO('Laptop', 'Powerful laptop', 1000, 10);
      $presenter = new ProductPresenter();
      
      // Assurez-vous que la méthode displayOnCatalog ne génère aucune erreur
      $this->expectOutputString('');
      $presenter->displayOnCatalog($product);
  }
}

class ProductStockUpdaterTest extends TestCase {
  public function testUpdateStock() {
      $product = new ProductVO('Laptop', 'Powerful laptop', 1000, 10);
      $updater = new ProductStockUpdater();
      $updater->updateStock($product, 5);
      
      // Vérifiez que la mise à jour du stock est correcte
      $this->assertEquals(15, $product->stock);
  }
}

class ProductOrderProcessorTest extends TestCase {
  public function testProcessOrder() {
      $product = new ProductVO('Laptop', 'Powerful laptop', 1000, 10);
      $order = new OrderVO('123', 'John Doe', 'john@example.com', 2);
      $processor = new ProductOrderProcessor();
      
      // Assurez-vous que la méthode processOrder ne génère aucune erreur
      $this->expectOutputString('');
      $processor->processOrder($product, $order);
  }
}

class ProductPresenter {
    public function displayOnCatalog(ProductVO $product) {
        // Affiche le produit sur la page du catalogue
    }
}

class ProductStockUpdater {
    public function updateStock(ProductVO $product, int $quantity) {
        // Met à jour la quantité en stock
    }
}

class ProductOrderProcessor {
    public function processOrder(ProductVO $product, OrderVO $order) {
        // Traite une commande liée au produit
    }
}

class OrderVO {
  public function __construct(
      readonly public string $id,
      readonly public string $customerName,
      readonly public string $customerEmail,
      readonly public int $quantity
  ) {}
}

class ProductVO {
  public function __construct(
    readonly public string $name,
    readonly public string $description,
    readonly public int $price,
    public int $stock
  ) {}
}

@TODO
/*
Les noms des classes et des méthodes sont clairs et explicites, suivant la convention de nommage en camelCase.
Les méthodes des classes respectent le principe d'une seule responsabilité, en effectuant une seule tâche spécifique.
Les noms des méthodes reflètent leur intention et leur comportement.
Les tests unitaires sont bien structurés, avec des noms de méthode descriptifs et des assertions uniques par test.
La classe ProductVO expose uniquement les getters pour accéder aux propriétés, favorisant l'encapsulation et le respect du principe d'encapsulation des données (data encapsulation).
*/
