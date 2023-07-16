<?php

use PHPUnit\Framework\TestCase;

class DefaultDiscountStrategyTest extends TestCase {
    public function testApplyDiscount() {
        $strategy = new DefaultDiscountStrategy();
        $price = 100;

        $discountedPrice = $strategy->applyDiscount($price);
        $this->assertEquals($price, $discountedPrice);
    }
}

class ClothingDiscountStrategyTest extends TestCase {
    public function testApplyDiscount() {
        $strategy = new ClothingDiscountStrategy();
        $price = 100;

        $discountedPrice = $strategy->applyDiscount($price);
        $this->assertEquals(80, $discountedPrice);
    }
}

class BookDiscountStrategyTest extends TestCase {
    public function testApplyDiscount() {
        $strategy = new BookDiscountStrategy();
        $price = 100;

        $discountedPrice = $strategy->applyDiscount($price);
        $this->assertEquals(90, $discountedPrice);
    }
}

class ProductTest extends TestCase {
    public function testGetPrice() {
        $product = new Product('Laptop', 1000);
        $this->assertEquals(1000, $product->getPrice());
    }
}

class ShoppingCartTest extends TestCase {
    public function testCalculateTotalPriceWithNoProducts() {
        $strategy = new DefaultDiscountStrategy();
        $cart = new ShoppingCart($strategy);
        $this->assertEquals(0, $cart->calculateTotalPrice());
    }

    public function testCalculateTotalPriceWithProducts() {
        $strategy = new DefaultDiscountStrategy();

        $p1 = new Product('Laptop', 1000);
        $p2 = new Product('Shirt', 50);

        $cart = new ShoppingCart($strategy);
        $cart->addProduct($p1);
        $cart->addProduct($p2);

        $this->assertEquals(1050, $cart->calculateTotalPrice());
    }
}

interface DiscountStrategy {
  public function applyDiscount(float $price): float;
}

class DefaultDiscountStrategy implements DiscountStrategy {
  public function applyDiscount(float $price): float {
      return $price;
  }
}

class ClothingDiscountStrategy implements DiscountStrategy {
  public function applyDiscount(float $price): float {
      return $price - ($price * 0.2);
  }
}

class BookDiscountStrategy implements DiscountStrategy {
  public function applyDiscount(float $price): float {
      return $price - ($price * 0.1);
  }
}

class Product {
  public function __construct(
    private string $name,
    private float $price
  ) {}

  public function getPrice(): float {
      return $this->price;
  }
}

class ShoppingCart {
  public function __construct(
    private DiscountStrategy $discountStrategy,
    private array $products = []
  ) {}

  public function addProduct(Product $product): void {
      $this->products[] = $product;
  }

  public function calculateTotalPrice(): float {
      $total = 0;
      foreach ($this->products as $product) {
          $total += $this->discountStrategy->applyDiscount($product->getPrice());
      }

      return $total;
  }
}
