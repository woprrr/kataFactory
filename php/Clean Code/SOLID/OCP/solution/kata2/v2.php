<?php

use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase {
  public function testGetShippingCostsGround() {
      $order = new Order(1, [], new DefaultShippingStrategy());
      $shippingCosts = $order->getShippingCosts();
      $this->assertEquals(5.95, $shippingCosts);
  }

  public function testGetShippingCostsExpress() {
      $order = new Order(1, [], new ExpressShippingStrategy());
      $shippingCosts = $order->getShippingCosts();
      $this->assertEquals(15.95, $shippingCosts);
  }

  public function testGetShippingCostsInternational() {
      $order = new Order(1, [], new InternationalShippingStrategy());
      $shippingCosts = $order->getShippingCosts();
      $this->assertEquals(25.95, $shippingCosts);
  }

  public function testGetShippingCostsWithException() {
      $shippingStrategy = $this->createMock(ShippingStrategy::class);
      $shippingStrategy->method('calculateShippingCosts')
          ->willThrowException(new Exception());

      $order = new Order(1, [], $shippingStrategy);

      $this->expectException(ShippingCostsCalculationException::class);

      $order->getShippingCosts();
  }
}

class ShippingCostsCalculationException extends Exception {
    public function __construct() {
        parent::__construct("Error calculating shipping costs");
    }
}

interface ShippingStrategy {
    public function calculateShippingCosts(float $totalCost): float;
}

class DefaultShippingStrategy implements ShippingStrategy {
    public function calculateShippingCosts(float $totalCost): float {
        return $totalCost > 50 ? 0 : 5.95;
    }
}

class ExpressShippingStrategy implements ShippingStrategy {
    public function calculateShippingCosts(float $totalCost): float {
        return 15.95;
    }
}

class InternationalShippingStrategy implements ShippingStrategy {
    public function calculateShippingCosts(float $totalCost): float {
        return 25.95;
    }
}

class Order {
    public function __construct(
        private int $id,
        private array $items,
        private ShippingStrategy $shippingStrategy
    ) {}

    private function getTotalCost(): float {
        // Calculate the total cost of items
    }

    public function getShippingCosts(): float {
        $totalCost = $this->getTotalCost();

        try {
            return $this->shippingStrategy->calculateShippingCosts($totalCost);
        } catch (Exception $e) {
            throw new ShippingCostsCalculationException();
        }
    }
}
