<?php

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {
  public function testApplyDiscountForElectronicsCategory() {
      $product = new Product('Laptop', 1000, 'Electronics');
      $product->applyDiscount(0.1);
      $this->assertEquals(900, $product->getPrice());
  }

  public function testApplyDiscountForClothingCategory() {
      $product = new Product('Shirt', 50, 'Clothing');
      $product->applyDiscount(0.2);
      $this->assertEquals(40, $product->getPrice());
  }

  public function testApplyDiscountForBooksCategory() {
      $product = new Product('Book', 20, 'Books');
      $product->applyDiscount(0.15);
      $this->assertEquals(17, $product->getPrice());
  }
}

class ShoppingCartTest extends TestCase {
  public function testCalculateTotalPriceWithNoProducts() {
      $cart = new ShoppingCart();
      $this->assertEquals(0, $cart->calculateTotalPrice());
  }

  public function testCalculateTotalPriceWithProducts() {
      $p1 = new Product('Laptop', 1000, 'Electronics');
      $p2 = new Product('Shirt', 50, 'Clothing');

      $cart = new ShoppingCart();
      $cart->addProduct($p1);
      $cart->addProduct($p2);

      $this->assertEquals(1050, $cart->calculateTotalPrice());
  }
}

class Product {
    public function __construct(
        private string $name,
        private float $price,
        private string $category
    ) {}

    public function applyDiscount($discount): void {
        if ($this->category == 'Electronics') {
            $this->price = $this->price - ($this->price * $discount);
        } elseif ($this->category == 'Clothing') {
            $this->price = $this->price - ($this->price * $discount / 2);
        } elseif ($this->category == 'Books') {
            $this->price = $this->price - ($this->price * $discount / 5);
        }
    }
    
    public function getPrice(): int {
        return $this->price;
    }
}

class ShoppingCart {
    private $products = [];

    public function addProduct($product): void {
        $this->products[] = $product;
    }

    public function calculateTotalPrice(): float {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice();
        }
        return $total;
    }
}

// Utilisation du code

$p1 = new Product('Laptop', 1000, 'Electronics');
$p1->applyDiscount(0.1);

$p2 = new Product('Shirt', 50, 'Clothing');
$p2->applyDiscount(0.2);

$cart = new ShoppingCart();
$cart->addProduct($p1);
$cart->addProduct($p2);
var_dump($cart->calculateTotalPrice()); // 945
