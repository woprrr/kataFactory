<?php

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {
  public function testApplyDiscountForProduct() {
      $product = new Product('Laptop', 1000);
      $product->applyDiscount(0.1);
      $this->assertEquals(900, $product->getPrice());
  }

  public function testApplyDiscountForClothingProduct() {
      $clothingProduct = new ClothingProduct('Shirt', 50);
      $clothingProduct->applyDiscount(0.2);
      $this->assertEquals(40, $clothingProduct->getPrice());
  }

  public function testApplyDiscountForBookProduct() {
      $bookProduct = new BookProduct('Book', 20);
      $bookProduct->applyDiscount(0.15);
      $this->assertEquals(17, $bookProduct->getPrice());
  }
}

class ShoppingCartTest extends TestCase {
  public function testCalculateTotalPriceWithNoProducts() {
      $cart = new ShoppingCart();
      $this->assertEquals(0, $cart->calculateTotalPrice());
  }

  public function testCalculateTotalPriceWithProducts() {
      $p1 = new Product('Laptop', 1000);
      $p2 = new ClothingProduct('Shirt', 50);

      $cart = new ShoppingCart();
      $cart->addProduct($p1);
      $cart->addProduct($p2);

      $this->assertEquals(1050, $cart->calculateTotalPrice());
  }
}

interface Discountable {
  public function applyDiscount($discount);
}

class Product implements Discountable {
  private $name;
  private $price;

  public function __construct($name, $price) {
      $this->name = $name;
      $this->price = $price;
  }

  public function applyDiscount($discount) {
      $this->price = $this->price - ($this->price * $discount);
  }

  // Getters and other methods...
}

class ClothingProduct extends Product {
  public function applyDiscount($discount) {
      $this->price = $this->price - ($this->price * $discount / 2);
  }

  // Additional methods specific to clothing products...
}

class BookProduct extends Product {
  public function applyDiscount($discount) {
      $this->price = $this->price - ($this->price * $discount / 5);
  }

  // Additional methods specific to book products...
}

class ShoppingCart {
  private $products = [];

  public function addProduct(Discountable $product) {
      $this->products[] = $product;
  }

  public function calculateTotalPrice() {
      $total = 0;
      foreach ($this->products as $product) {
          $total += $product->getPrice();
      }
      return $total;
  }
}

// Utilisation du code

$p1 = new Product('Laptop', 1000);
$p1->applyDiscount(0.1); // Applique une réduction de 10%

$p2 = new ClothingProduct('Shirt', 50);
$p2->applyDiscount(0.2); // Applique une réduction de 20%

$cart = new ShoppingCart();
$cart->addProduct($p1);
$cart->addProduct($p2);
