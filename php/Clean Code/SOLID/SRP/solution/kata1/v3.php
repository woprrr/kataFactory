<?php

use PHPUnit\Framework\TestCase;

class ProductVOTest extends TestCase {
  public function testProductVO(): void {
      $product = new ProductVO(
          name: 'Laptop',
          description: 'Powerful laptop',
          price: 1000,
          stock: 10
      );

      $this->assertEquals('Laptop', $product->name);
      $this->assertEquals('Powerful laptop', $product->description);
      $this->assertEquals(1000, $product->price);
      $this->assertEquals(10, $product->stock);
  }
}

class ProductPresenterTest extends TestCase {
  /**
   * @dataProvider productProvider
   */
  public function testDisplayOnCatalog(ProductVO $product): void {
      $presenter = new ProductPresenter();

      // Assurez-vous que la méthode displayOnCatalog ne génère aucune erreur
      $this->expectOutputString('');
      $presenter->displayOnCatalog($product);
  }

  public function productProvider(): array {
      return [
          [new ProductVO(
              name: 'Laptop',
              description: 'Powerful laptop',
              price: 1000,
              stock: 10
          )],
          // Ajoutez d'autres données de test si nécessaire
      ];
  }
}

class ProductStockUpdaterTest extends TestCase {
  /**
   * @dataProvider stockUpdateProvider
   */
  public function testUpdateStock(ProductVO $product, int $quantity, int $expectedStock): void {
      $updater = new ProductStockUpdater();
      $updater->updateStock($product, $quantity);

      // Vérifiez que la mise à jour du stock est correcte
      $this->assertEquals($expectedStock, $product->stock);
  }

  /**
   * @dataProvider insufficientStockProvider
   */
  public function testUpdateStockWithInsufficientStock(ProductVO $product, int $quantity): void {
      $updater = new ProductStockUpdater();

      // Assurez-vous que l'exception est levée lorsqu'il y a un stock insuffisant
      $this->expectException(InsufficientStockException::class);
      $updater->updateStock($product, $quantity);
  }

  public function stockUpdateProvider(): array {
      return [
          [new ProductVO(
              name: 'Laptop',
              description: 'Powerful laptop',
              price: 1000,
              stock: 10
          ), 5, 5],
          // Ajoutez d'autres données de test si nécessaire
      ];
  }

  public function insufficientStockProvider(): array {
      return [
          [new ProductVO(
              name: 'Laptop',
              description: 'Powerful laptop',
              price: 1000,
              stock: 5
          ), 10],
          // Ajoutez d'autres données de test si nécessaire
      ];
  }
}

class ProductOrderProcessorTest extends TestCase {
  /**
   * @dataProvider orderProcessingProvider
   */
  public function testProcessOrder(ProductVO $product, OrderVO $order): void {
      $processor = new ProductOrderProcessor();

      // Assurez-vous que la méthode processOrder ne génère aucune erreur
      $this->expectOutputString('');
      $processor->processOrder($product, $order);
  }

  /**
   * @dataProvider insufficientStockProvider
   */
  public function testProcessOrderWithInsufficientStock(ProductVO $product, int $quantity): void {
      $order = new OrderVO(
          id: '123',
          customerName: 'John Doe',
          customerEmail: 'john@example.com',
          quantity: $quantity
      );
      $processor = new ProductOrderProcessor();

      // Assurez-vous que l'exception est levée lorsqu'il y a un stock insuffisant
      $this->expectException(InsufficientStockException::class);
      $processor->processOrder($product, $order);
  }

  public function orderProcessingProvider(): array {
      return [
          [new ProductVO(
              name: 'Laptop',
              description: 'Powerful laptop',
              price: 1000,
              stock: 10
          ), new OrderVO(
              id: '123',
              customerName: 'John Doe',
              customerEmail: 'john@example.com',
              quantity: 2
          )],
          // Ajoutez d'autres données de test si nécessaire
      ];
  }
}

class InsufficientStockException extends Exception {
  public function __construct() {
      parent::__construct("Insufficient stock for the product");
  }
}

class ProductPresenter {
    public function displayOnCatalog(ProductVO $product): void {
        // Affiche le produit sur la page du catalogue
    }
}

class ProductStockUpdater {
    public function updateStock(ProductVO $product, int $quantity): void {
        if ($quantity > $product->stock) {
            throw new InsufficientStockException();
        }

        $product->stock -= $quantity;
    }
}

class ProductOrderProcessor {
    public function processOrder(ProductVO $product, OrderVO $order): void {
        if ($order->quantity > $product->stock) {
            throw new InsufficientStockException();
        }

        $product->stock -= $order->quantity;
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
data providers pour les tests testDisplayOnCatalog, testUpdateStock, testUpdateStockWithInsufficientStock, testProcessOrder et testProcessOrderWithInsufficientStock. Cela permet de fournir différentes données de test à chaque méthode de test et d'exécuter les tests avec ces différentes données. Cela rend les tests plus modulaires et facilite l'ajout de nouvelles données de test à l'avenir
*/
