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

class ProductVOTest extends TestCase {
  public function testEquality() {
      $product1 = new ProductVO('Laptop', 1000);
      $product2 = new ProductVO('Laptop', 1000);

      $this->assertTrue($product1 == $product2);
  }

  public function testInequality() {
      $product1 = new ProductVO('Laptop', 1000);
      $product2 = new ProductVO('Shirt', 50);

      $this->assertFalse($product1 == $product2);
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

        $p1 = new ProductVO('Laptop', 1000);
        $p2 = new ProductVO('Shirt', 50);

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

class ProductVO {
    public function __construct(
        public readonly string $name,
        public readonly float $price
    ) {}
}

class ShoppingCart {
    public function __construct(
        private DiscountStrategy $discountStrategy,
        private array $products = []
    ) {}

    public function addProduct(ProductVO $product): void {
        $this->products[] = $product;
    }

    public function calculateTotalPrice(): float {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $this->discountStrategy->applyDiscount($product->price);
        }

        return $total;
    }
}
