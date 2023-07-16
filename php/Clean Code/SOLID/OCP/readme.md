# Open-Close Principle

## Rappel OCP
Les entités logicielles (classes, modules, etc.) doivent être ouvertes à l'extension mais fermées à la modification. Cela signifie qu'on devrait pouvoir ajouter de nouvelles fonctionnalités en étendant le code existant plutôt qu'en le modifiant directement.

## KATA 1 (Débutant)
Prenons l'exemple d'une classe `Order` qui est responsable de gèrer les méthodes de livraison et leurs côuts associés. Cependant, la classe viole le principe ouvert à l'extension fermé à la modification (OCP) car il y a une logique de gestion en fonction de la méthode de livraison au sein de la classe `Order`.

### Sample code

```php
<?php

use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase {
    public function testGetShippingCostsGround() {
        $order = new Order(1, [], "ground");
        $shippingCosts = $order->getShippingCosts();
        $this->assertEquals(5.95, $shippingCosts);
    }

    public function testGetShippingCostsAir() {
        $order = new Order(1, [], "air");
        $shippingCosts = $order->getShippingCosts();
        $this->assertEquals(10.95, $shippingCosts);
    }

    public function testGetShippingCostsExpress() {
        $order = new Order(1, [], "express");
        $shippingCosts = $order->getShippingCosts();
        $this->assertEquals(15.95, $shippingCosts);
    }

    public function testGetShippingCostsInternational() {
        $order = new Order(1, [], "international");
        $shippingCosts = $order->getShippingCosts();
        $this->assertEquals(25.95, $shippingCosts);
    }
}

class Order {
  public function __construct(
    private int $id,
    private array $items,
    private string $shipping,
  ) {}

  private function getTotalCost(): int {
    // calculates total cost
  }

  public function getShippingCosts(): int {
    $totalCost = $this->getTotalCost();
    $shippingCosts = 0;

    if ($this->shipping === "ground") {
      $shippingCosts = $totalCost > 50 ? 0 : 5.95;
    } elseif ($this->shipping === "air") {
      $shippingCosts = 10.95;
    } elseif ($this->shipping === "express") {
      $shippingCosts = 15.95;
    } elseif ($this->shipping === "international") {
      $shippingCosts = 25.95;
    }

    return $shippingCosts;
  }
}
```

### Contraintes Supplémentaires :
- Pratiquez le RGR pendant l'exercice (Red, Green, Refactor)
- Pratiquez le BabyStep
- Respectez les principes :
  - Clean Code

### Pour aller encore plus loin...
- Adaptez le code pour implementer le design pattern [`strategy`](https://refactoring.guru/fr/design-patterns/strategy "Le design pattern stratégie")

## KATA 2 (Sénior)
Prenons l'exemple d'une classe "Product" qui est responsable de la gestion des informations de produit. La classes `Cart` est chargée d'encapsuler des `Product` et afficher le prix total du panier avec les produits choisit. Cependant, la classe viole le principe ouvert à l'extension fermé à la modification (OCP) car il y a une logique de gestion en fonction du produit au sein de la classe `Product`.

### Sample code

```php
<?php

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
```

### Contraintes Supplémentaires :
- Pratiquez le TDD
- Pratiquez le BabyStep
- Respectez les principes :
  - SOLID dans sa globalité (pas que (O))
  - Clean Code
- Implementez les DesignPattern cohérents

### Pour aller encore plus loin...
- Adaptez le code pour implémenter un des design pattern ci-dessous

#### Factory Method Pattern
Si la création des objets ProductVO dans ShoppingCart devient plus complexe ou nécessite une logique spécifique, vous pouvez envisager d'utiliser le Factory Method Pattern pour encapsuler la création d'objets ProductVO. Cela permettrait de déléguer la création des objets ProductVO à des sous-classes de la classe ShoppingCart, tout en conservant la flexibilité et la possibilité d'ajouter de nouveaux types de produits.

#### Composite Pattern
Si vous avez besoin de traiter les produits du panier de manière hiérarchique ou de gérer des produits composés, le Composite Pattern peut être utilisé pour représenter les produits individuels et les produits composés comme une structure d'arbre. Cela permettrait de traiter les produits individuels et les produits composés de manière uniforme, en utilisant une interface commune.

#### Observer Pattern
Si vous souhaitez implémenter un mécanisme de notification pour informer d'autres parties de l'application lorsque des changements se produisent dans le panier (par exemple, lorsqu'un produit est ajouté ou supprimé), vous pouvez utiliser l'Observer Pattern. Cela permettrait de créer une relation d'observation entre le panier et les observateurs intéressés, qui seraient notifiés des changements et pourraient prendre les mesures appropriées.
