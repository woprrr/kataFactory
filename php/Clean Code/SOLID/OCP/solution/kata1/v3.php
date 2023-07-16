<?php

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {
    public function testApplyDiscountForProduct() {
        $discountStrategy = new DefaultDiscountStrategy();
        $product = new Product('Laptop', 1000, $discountStrategy);
        $product->applyDiscount();
        $this->assertEquals(900, $product->getPrice());
    }

    public function testApplyDiscountForClothingProduct() {
        $discountStrategy = new ClothingDiscountStrategy();
        $clothingProduct = new ClothingProduct('Shirt', 50, $discountStrategy);
        $clothingProduct->applyDiscount();
        $this->assertEquals(40, $clothingProduct->getPrice());
    }

    public function testApplyDiscountForBookProduct() {
        $discountStrategy = new BookDiscountStrategy();
        $bookProduct = new BookProduct('Book', 20, $discountStrategy);
        $bookProduct->applyDiscount();
        $this->assertEquals(17, $bookProduct->getPrice());
    }
}

class ShoppingCartTest extends TestCase {
    public function testCalculateTotalPriceWithNoProducts() {
        $cart = new ShoppingCart();
        $this->assertEquals(0, $cart->calculateTotalPrice());
    }

    public function testCalculateTotalPriceWithProducts() {
        $discountStrategy = new DefaultDiscountStrategy();

        $p1 = new Product('Laptop', 1000, $discountStrategy);
        $p2 = new ClothingProduct('Shirt', 50, $discountStrategy);

        $cart = new ShoppingCart();
        $cart->addProduct($p1);
        $cart->addProduct($p2);

        $this->assertEquals(1050, $cart->calculateTotalPrice());
    }
}

interface DiscountStrategy {
    public function applyDiscount(Product $product);
}

class DefaultDiscountStrategy implements DiscountStrategy {
    public function applyDiscount(Product $product) {
        // No discount applied
    }
}

class ClothingDiscountStrategy implements DiscountStrategy {
    public function applyDiscount(Product $product) {
        $product->setPrice($product->getPrice() - ($product->getPrice() * 0.2));
    }
}

class BookDiscountStrategy implements DiscountStrategy {
    public function applyDiscount(Product $product) {
        $product->setPrice($product->getPrice() - ($product->getPrice() * 0.15));
    }
}

class Product {
    private $name;
    private $price;
    private $discountStrategy;

    public function __construct($name, $price, DiscountStrategy $discountStrategy) {
        $this->name = $name;
        $this->price = $price;
        $this->discountStrategy = $discountStrategy;
    }

    public function applyDiscount() {
        $this->discountStrategy->applyDiscount($this);
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    // Getters and other methods...
}

class ClothingProduct extends Product {
    // Additional methods specific to clothing products...
}

class BookProduct extends Product {
    // Additional methods specific to book products...
}

class ShoppingCart {
    private $products = [];

    public function addProduct(Product $product) {
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
