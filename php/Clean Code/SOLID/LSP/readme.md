# Liskov Substitution Principle

## Rappel LSP
Les objets d'une classe dérivée doivent pouvoir être utilisés en remplacement des objets de la classe de base sans altérer la cohérence du programme. En d'autres termes, les classes dérivées doivent être substituables par leurs classes de base sans causer de problèmes inattendus.


## KATA 1 (Débutant)
Prenons l'exemple d'une classe `Order` qui est responsable de gèrer les méthodes de livraison et leurs côuts associés. Cependant, la classe viole le principe ouvert à l'extension fermé à la modification (OCP) car il y a une logique de gestion en fonction de la méthode de livraison au sein de la classe `Order`.

### Sample code

```php
<?php

class Report {
  public function __construct(
    private string $date,
    private string $title,
    private array $data,
  ) {}

  public function getContent()
  {
    return [
      'date' => $this->date,
      'title' => $this->title,
      'data' => $this->data,
    ];
  }
}

class StringReport extends Report {
    public function getStringContent()
    {
      return implode(', ', $this->data);
    }
}

class HtmlFormatter {
  public function format(Report $report)
  {
    $content = $report->getContent();

    $data = "";
    foreach ($content['data'] as $value) {
      $data .= "<li>$value</li>";
    }

    return "
    <h2>{$content['title']}</h2>
    <em>Date : {$content['date']}</em>
    <h4>Données :</h4>
    <ul>
      $data
    </ul>
    ";
  }
}

//$report = new Report("18/06/2023", "Liskov Help me", ["keepCalm", "Breath", "Love Woprrr"]);
$report = new StringReport("18/06/2023", "Liskov Help me", ["keepCalm", "Breath", "Love Woprrr"]);
$htmlFormater = new HtmlFormatter();
$reportResult = $htmlFormater->format($report);
var_dump($reportResult);
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
