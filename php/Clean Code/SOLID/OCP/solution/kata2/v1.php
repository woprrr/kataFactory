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
          ->willThrowException(new Exception("Error calculating shipping costs"));

      $order = new Order(1, [], $shippingStrategy);

      $this->expectException(Exception::class);
      $this->expectExceptionMessage("Error calculating shipping costs");

      $order->getShippingCosts();
  }
}

// Interface pour la stratégie de calcul des frais de livraison
interface ShippingStrategy {
    public function calculateShippingCosts(float $totalCost): float;
}

// Stratégie de livraison par défaut
class DefaultShippingStrategy implements ShippingStrategy {
    public function calculateShippingCosts(float $totalCost): float {
        return $totalCost > 50 ? 0 : 5.95;
    }
}

// Stratégie de livraison express
class ExpressShippingStrategy implements ShippingStrategy {
    public function calculateShippingCosts(float $totalCost): float {
        return 15.95;
    }
}

// Stratégie de livraison internationale
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
        // calcule le coût total des articles
    }

    public function getShippingCosts(): float {
        $totalCost = $this->getTotalCost();

        try {
            return $this->shippingStrategy->calculateShippingCosts($totalCost);
        } catch (Exception $e) {
            throw new Exception("Error calculating shipping costs", 0, $e);
        }
    }
}
