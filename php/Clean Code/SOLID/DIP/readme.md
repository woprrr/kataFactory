# Interface Segregation Principle

## Rappel ISP
Les clients ne devraient pas être forcés de dépendre d'interfaces dont ils n'ont pas besoin. Les interfaces volumineuses doivent être divisées en interfaces plus spécifiques, afin que les clients puissent utiliser uniquement les fonctionnalités dont ils ont besoin.

## KATA 1 (Débutant)
@TODO

### Sample code

```php
class MySQLDatabase {
  public function save(Order $order) {
      if (empty($order->id)) {
          $this->insert($order);
      } else {
          $this->update($order);
      }
  }

  private function insert(Order $order) {
      // Insertion dans la base de données MySQL
  }

  private function update(Order $order) {
      // Mise à jour dans la base de données MySQL
  }
}

class OrderService {
  private MySQLDatabase $database;

  public function __construct(MySQLDatabase $database) {
      $this->database = $database;
  }

  public function saveOrder(Order $order): void {
      $this->database->save($order);
  }
}
```

### Contraintes Supplémentaires :

### Pour aller encore plus loin...


## KATA 2 (Sénior)

### Sample code

```php
<?php

use PHPUnit\Framework\TestCase;

class OrderProcessorTest extends TestCase {
    public function testProcessOrder() {
        // Préparation des données de commande
        $order = new Order();
        $order->id = 123;
        $order->amount = 100.0;
        
        // Instanciation des dépendances
        $validator = new OrderValidator();
        $paymentProcessor = new PaymentProcessor();
        
        // Instanciation de la classe à tester
        $orderProcessor = new OrderProcessor($validator, $paymentProcessor);
        
        // Exécution de la méthode à tester
        $orderProcessor->processOrder($order);
        
        // Assertions pour vérifier le bon fonctionnement du code
        // ...
    }
}

class Order {
    public $id;
    public $amount;
}

class OrderValidator {
    public function validate($order) {
        // Logique de validation de commande
    }
}

class PaymentProcessor {
    public function processPayment($order) {
        // Logique de traitement du paiement
    }
}

class OrderProcessor {
    private $validator;
    private $paymentProcessor;
    
    public function __construct(OrderValidator $validator, PaymentProcessor $paymentProcessor) {
        $this->validator = $validator;
        $this->paymentProcessor = $paymentProcessor;
    }
    
    public function processOrder($order) {
        $this->validator->validate($order);
        $this->paymentProcessor->processPayment($order);
        // Logique supplémentaire pour le traitement de la commande
    }
}

$validator = new OrderValidator();
$paymentProcessor = new PaymentProcessor();
$orderProcessor = new OrderProcessor($validator, $paymentProcessor);
$order = new Order();
$order->id = 123;
$order->amount = 100.0;

$orderProcessor->processOrder($order);
```

@TODO be continue...
