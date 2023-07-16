# Interface Segregation Principle

## Rappel ISP
Les clients ne devraient pas être forcés de dépendre d'interfaces dont ils n'ont pas besoin. Les interfaces volumineuses doivent être divisées en interfaces plus spécifiques, afin que les clients puissent utiliser uniquement les fonctionnalités dont ils ont besoin.

## KATA 1 (Débutant)
@TODO

### Sample code

```php
interface Animal {
  public function walk(): void;
  public function fly(): void;
}

class Dog implements Animal {
  public function walk(): void {
    dd("Walking");
  }

  public function fly(): void {
    throw new Error("Dogs cannot fly");
  }
}

class Duck implements Animal {
  public function walk(): void {
    dd("Walking");
  }

  public function fly(): void {
    dd("Flying");
  }
}
```

### Contraintes Supplémentaires :

### Pour aller encore plus loin...


## KATA 2 (Sénior)

### Sample code

```php
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {
    public function testGetDetails() {
        // Créer un objet Product
        $product = new Product();

        // Appeler la méthode getDetails()
        $details = $product->getDetails();

        // Vérifier que les détails sont corrects
        $this->assertNotEmpty($details);
        // ...
        // Ajouter des assertions supplémentaires selon le comportement attendu
        // ...
    }

    public function testCalculateShippingCost() {
        // Créer un objet Product
        $product = new Product();

        // Appeler la méthode calculateShippingCost() avec une destination
        $cost = $product->calculateShippingCost('Destination A');

        // Vérifier que le coût d'expédition est correct
        $this->assertIsNumeric($cost);
        // ...
        // Ajouter des assertions supplémentaires selon le comportement attendu
        // ...
    }

    public function testProcessPayment() {
        // Créer un objet Product
        $product = new Product();

        // Appeler la méthode processPayment() avec des informations de paiement
        $result = $product->processPayment(['amount' => 10.99]);

        // Vérifier que le traitement du paiement s'est bien déroulé
        $this->assertTrue($result);
        // ...
        // Ajouter des assertions supplémentaires selon le comportement attendu
        // ...
    }

    public function testSendNotification() {
        // Créer un objet Product
        $product = new Product();

        // Appeler la méthode sendNotification() avec un message
        $product->sendNotification('Notification message');

        // Vérifier que la notification a été envoyée (par exemple, en vérifiant les logs, en utilisant un mock du service de notification, etc.)
        // ...
        // Ajouter des assertions supplémentaires selon le comportement attendu
        // ...
    }

    public function testGenerateReport() {
        // Créer un objet Product
        $product = new Product();

        // Appeler la méthode generateReport()
        $product->generateReport();

        // Vérifier que le rapport a été généré (par exemple, en vérifiant les fichiers de rapport, en utilisant un mock du service de génération de rapport, etc.)
        // ...
        // Ajouter des assertions supplémentaires selon le comportement attendu
        // ...
    }
}

class DigitalProductTest extends TestCase {
    public function testGetDetails() {
        // Créer un objet DigitalProduct
        $digitalProduct = new DigitalProduct();

        // Appeler la méthode getDetails()
        $details = $digitalProduct->getDetails();

        // Vérifier que les détails sont corrects
        $this->assertNotEmpty($details);
        // ...
        // Ajouter des assertions supplémentaires selon le comportement attendu
        // ...
    }

    public function testProcessPayment() {
        // Créer un objet DigitalProduct
        $digitalProduct = new DigitalProduct();

        // Appeler la méthode processPayment() avec des informations de paiement
        $result = $digitalProduct->processPayment(['amount' => 9.99]);

        // Vérifier que le traitement du paiement s'est bien déroulé
        $this->assertTrue($result);
        // ...
        // Ajouter des assertions supplémentaires selon le comportement attendu
        // ...
    }

    public function testSendNotification() {
        // Créer un objet DigitalProduct
        $digitalProduct = new DigitalProduct();

        // Appeler la méthode sendNotification() avec un message
        $digitalProduct->sendNotification('Digital product notification');

        // Vérifier que la notification a été envoyée (par exemple, en vérifiant les logs, en utilisant un mock du service de notification, etc.)
        // ...
        // Ajouter des assertions supplémentaires selon le comportement attendu
        // ...
    }
}

interface ProductInterface {
    public function getDetails();
    public function calculateShippingCost($destination);
    public function processPayment($paymentInfo);
    public function sendNotification($message);
    public function generateReport();
}

class Product implements ProductInterface {
    public function getDetails() {
        // Code pour récupérer les détails du produit dans la base de données
    }

    public function calculateShippingCost($destination) {
        // Code pour calculer le coût d'expédition du produit
    }

    public function processPayment($paymentInfo) {
        // Code pour traiter le paiement du produit
    }

    public function sendNotification($message) {
        // Code pour envoyer une notification concernant le produit
    }

    public function generateReport() {
        // Code pour générer un rapport sur le produit
    }
}

class DigitalProduct implements ProductInterface {
    public function getDetails() {
        // Code pour récupérer les détails du produit numérique dans la base de données
    }

    public function calculateShippingCost($destination) {
        // Ne devrait pas être implémenté pour un produit numérique
    }

    public function processPayment($paymentInfo) {
        // Code pour traiter le paiement du produit numérique
    }

    public function sendNotification($message) {
        // Code pour envoyer une notification concernant le produit numérique
    }

    public function generateReport() {
        // Ne devrait pas être implémenté pour un produit numérique
    }
}
```

@TODO be continue...
