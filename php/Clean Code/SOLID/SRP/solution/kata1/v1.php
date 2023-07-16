<?php

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {
    public function testDisplayOnCatalog() {
        $product = new Product('Laptop', 'Powerful laptop', 1000, 10);
        
        // Assurez-vous que la méthode displayOnCatalog ne génère aucune erreur
        $this->expectOutputString('');
        $product->displayOnCatalog();
    }

    public function testUpdateStock() {
        $product = new Product('Laptop', 'Powerful laptop', 1000, 10);
        $product->updateStock(5);
        
        // Vérifiez que la mise à jour du stock est correcte
        $this->assertEquals(15, $product->stock);
    }

    public function testProcessOrder() {
        $product = new Product('Laptop', 'Powerful laptop', 1000, 10);
        $order = new OrderVO('123', 'John Doe', 'john@example.com', 2);
        
        // Assurez-vous que la méthode processOrder ne génère aucune erreur
        $this->expectOutputString('');
        $product->processOrder($order);
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

@TODO
/* Ajout de tests Unitaires */
