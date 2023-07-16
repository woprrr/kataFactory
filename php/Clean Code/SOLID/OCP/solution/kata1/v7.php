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
        $product1 = new ProductVO('1', 'Laptop', 1000);
        $product2 = new ProductVO('1', 'Laptop', 1000);

        $this->assertTrue($product1 == $product2);
    }

    public function testInequality() {
        $product1 = new ProductVO('1', 'Laptop', 1000);
        $product2 = new ProductVO('2', 'Shirt', 50);

        $this->assertFalse($product1 == $product2);
    }
}

class ShoppingCartTest extends TestCase {
    public function testCalculateTotalPriceWithNoProducts() {
        $cart = new ShoppingCart(new DefaultDiscountStrategy(), new DefaultProductFactory());
        $this->assertEquals(0, $cart->calculateTotalPrice());
    }

    public function testCalculateTotalPriceWithProducts() {
        $cart = new ShoppingCart(new DefaultDiscountStrategy(), new DefaultProductFactory());
        $cart->addToCart('Laptop', 1000);
        $cart->addToCart('Shirt', 50);

        $this->assertEquals(1050, $cart->calculateTotalPrice());
    }
}

class ProductFactoryTest extends TestCase {
  public function testCreateDefaultProduct() {
      $factory = new DefaultProductFactory();
      $product = $factory->createProduct('Laptop', 1000);

      $this->assertInstanceOf(ProductVO::class, $product);
      $this->assertEquals('Laptop', $product->name);
      $this->assertEquals(1000, $product->price);
  }

  public function testCreateClothingProduct() {
      $factory = new ClothingProductFactory();
      $product = $factory->createProduct('Shirt', 50);

      $this->assertInstanceOf(ClothingProductVO::class, $product);
      $this->assertEquals('Shirt', $product->name);
      $this->assertEquals(50, $product->price);
  }

  public function testCreateDefaultProductForUnknownType() {
      $factory = new DefaultProductFactory();
      $product = $factory->createProduct('Unknown', 100);

      $this->assertInstanceOf(ProductVO::class, $product);
      $this->assertEquals('Unknown', $product->name);
      $this->assertEquals(100, $product->price);
  }
}

interface DiscountStrategy {
    public function applyDiscount(float $price): float;
}

class DefaultDiscountStrategy implements DiscountStrategy {
    private const DISCOUNT_RATE = 0.0; // Aucune réduction

    public function applyDiscount(float $price): float {
        return $price - ($price * self::DISCOUNT_RATE);
    }
}

class ClothingDiscountStrategy implements DiscountStrategy {
    private const DISCOUNT_RATE = 0.2; // Réduction de 20%

    public function applyDiscount(float $price): float {
        return $price - ($price * self::DISCOUNT_RATE);
    }
}

class ProductVO {
    public function __construct(
        public readonly string $uuid,
        public readonly string $name,
        public readonly float $price
    ) {}
}

abstract class ProductFactory {
    abstract public function createProduct(string $name, float $price): ProductVO;
}

class DefaultProductFactory extends ProductFactory {
    public function createProduct(string $name, float $price): ProductVO {
        $uuid = generateUuid(); // Génération de l'UUID unique
        return new ProductVO($uuid, $name, $price);
    }
}

class ClothingProductFactory extends ProductFactory {
    public function createProduct(string $name, float $price): ProductVO {
        $uuid = generateUuid();

        if ($name === 'Shirt') {
            return new ClothingProductVO($uuid, $name, $price);
        }
        // Ajouter d'autres conditions pour d'autres types de produits

        return new ProductVO($uuid, $name, $price);
    }
}

class ClothingProductVO extends ProductVO {
    // Définition spécifique pour les produits de type Clothing
}

class ShoppingCart {
    private array $products = [];
    private DiscountStrategy $discountStrategy;
    private ProductFactory $productFactory;

    public function __construct(DiscountStrategy $discountStrategy, ProductFactory $productFactory) {
        $this->discountStrategy = $discountStrategy;
        $this->productFactory = $productFactory;
    }

    public function addToCart(string $name, float $price): void {
        $product = $this->productFactory->createProduct($name, $price);
        $this->products[$product->uuid] = $product;
    }

    public function calculateTotalPrice(): float {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $this->discountStrategy->applyDiscount($product->price);
        }

        return $total;
    }
}

// Génère un UUID unique
function generateUuid(): string {
    return uniqid();
}
