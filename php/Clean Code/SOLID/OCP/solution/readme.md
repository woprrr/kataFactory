# Solution

## KATA 1
### Clean Code
- Les noms des classes, des méthodes et des variables sont significatifs et expriment clairement leur intention.
- Le code est bien structuré et lisible, avec une indentation appropriée et une mise en forme cohérente.
- Les commentaires sont présents pour expliquer le code de manière claire et apporter des informations complémentaires.

### SOLID
- **SRP** (Single Responsibility Principle) : Chaque classe et méthode a une seule responsabilité.
- **OCP** (Open/Closed Principle) : Le code est partiellement respectueux de ce principe grâce à l'utilisation du pattern Strategy pour les stratégies de réduction. Cependant, il n'y a pas d'exemple de nouvelle stratégie ajoutée ultérieurement dans le code fourni.
- **ISP** (Interface Segregation Principle) : Les clients dépendent uniquement des interfaces dont ils ont besoin.
- **DIP** (Dependency Inversion Principle) : Les classes dépendent d'abstractions plutôt que d'implémentations concrètes.

### Design patterns :
- **Strategy Pattern** : Utilisé pour les différentes stratégies de réduction (DiscountStrategy). Cela permet de définir différentes stratégies de réduction et de les appliquer dynamiquement.
- **Factory Method Pattern** : Utilisé pour la création des produits (ProductFactory). Cela permet d'encapsuler la création des produits dans des sous-classes de ProductFactory, offrant ainsi une flexibilité pour créer différents types de produits.

Le code respecte les principes du Clean Code et SOLID en favorisant la *lisibilité*, la *maintenabilité* et *l'extensibilité* du code. 
Les design patterns **Strategy** et **Factory Method** sont utilisés de manière a  répondre aux besoins de flexibilité et de gestion des différents types de produits et de stratégies de réduction. Vous êtes sur que ce code est évolutif et ne vous générera pas de dette.

**Attention toutesfois, si jamais vous êtes amené a modifier et complexifié vos besoins il faudras challenger les Design patterns. Voir la section [Pour aller encore plus loin...] de l'énnoncer afin de définir des défis supplémentaires.**

## KATA 2
### Clean Code
- Les noms des classes, des méthodes et des variables sont significatifs et expriment clairement leur intention.
- Les méthodes sont courtes et concises, se concentrant sur une seule responsabilité.
- Le code est bien structuré et lisible, avec une indentation appropriée et une mise en forme cohérente.
- Les commentaires sont présents pour expliquer le code de manière claire et apporter des informations complémentaires.

### SOLID

- Le principe de Responsabilité Unique (SRP) est respecté, chaque classe et méthode ayant une seule responsabilité.
- Le principe Ouvert/Fermé (OCP) est respecté, car les stratégies de livraison peuvent être étendues sans modifier la classe Order.
- Le principe de Ségrégation des Interfaces (ISP) est respecté, car les clients dépendent uniquement de l'interface ShippingStrategy dont ils ont besoin.
- Le principe d'Inversion de Dépendance (DIP) est respecté, car la classe Order dépend d'une abstraction (ShippingStrategy) plutôt que d'une implémentation concrète.
- Les tests unitaires sont également présents pour vérifier le bon fonctionnement des différentes stratégies de livraison, ainsi que la gestion appropriée des exceptions avec l'utilisation de mocks.

### Résumé KATA 2
Le code semble respecter les principes du Clean Code et SOLID, en favorisant la $ *lisibilité*, la *maintenabilité* et *l'extensibilité* du code.
