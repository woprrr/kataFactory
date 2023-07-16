# Solution en quatres ittérations

## Law of Astonishment

### Cohérence syntaxique
Le code suit les conventions de codage courantes de PHP, ce qui rend le code plus prévisible pour les développeurs familiers avec le langage. Les noms des classes, des méthodes et des variables sont également choisis de manière cohérente et significative, facilitant la compréhension du code.

### Utilisation d'exceptions explicites
Les exceptions sont utilisées de manière appropriée pour signaler les erreurs ou les cas exceptionnels. Les exceptions spécifiques, telles que InvalidShapeException et InvalidDimensionsException, permettent de comprendre rapidement la nature du problème et d'y réagir de manière adéquate. Cela évite les surprises liées à des comportements inattendus lorsqu'une erreur se produit.

### Tests unitaires
Le code est accompagné de tests unitaires qui vérifient le bon fonctionnement des différentes fonctionnalités. Les tests permettent de s'assurer que le code se comporte conformément aux attentes et de détecter rapidement les problèmes ou les régressions. Cela évite les surprises liées à des bugs ou des comportements inattendus.

### Utilisation de constantes pour les messages d'erreur
Les messages d'erreur sont définis comme des constantes, ce qui permet de centraliser leur gestion et de faciliter leur modification ou leur traduction. Cela contribue à rendre le code plus prévisible en fournissant des messages d'erreur cohérents et compréhensibles.

## S.O.L.I.D

### Principe de responsabilité unique (Single Responsibility Principle)
Chaque classe a une responsabilité unique et clairement définie, ce qui facilite la compréhension et la maintenance du code. Par exemple, les classes `ReactangleShapeAreaCalculator` et `CircleShapeAreaCalculator` sont responsables du calcul de l'aire pour des formes spécifiques.

### Principe d'ouverture/fermeture (Open/Closed Principle)
Les classes sont ouvertes à l'extension par le biais d'interfaces et de l'injection de dépendances, tout en étant fermées à la modification. Par exemple, de nouvelles implémentations de l'interface ShapeAreaCalculatorInterface peuvent être ajoutées sans modifier le code existant.

### Principe de substitution de Liskov (Liskov Substitution Principle)
Les classes dérivées (`ReactangleShapeAreaCalculator` et `CircleShapeAreaCalculator`) peuvent être utilisées de manière interchangeable avec leur classe de base (`ShapeAreaCalculatorInterface`). Cela garantit une bonne polymorphie et une utilisation cohérente des objets.

### Principe de ségrégation des interfaces (Interface Segregation Principle)
Les interfaces sont conçues pour être spécifiques et ciblées, avec des méthodes adaptées à leur contexte. Par exemple, l'interface ShapeAreaCalculatorInterface expose uniquement les méthodes nécessaires pour le calcul de l'aire.

### Principe d'inversion des dépendances (Dependency Inversion Principle)
Le code utilise l'inversion des dépendances en reliant les classes par le biais d'interfaces. Cela permet une meilleure flexibilité et une réduction des dépendances directes entre les classes.

## Clean Code

### Nommage clair et explicite
Les noms des classes, des méthodes et des variables sont significatifs et facilitent la compréhension du code. Par exemple, les noms des classes telles que `ShapeAreaCalculatorContext`, `ReactangleShapeAreaCalculator` et `CircleShapeAreaCalculator` sont descriptifs de leur fonction.

### Fonctions et méthodes courtes
Les méthodes et les fonctions sont relativement courtes et suivent le principe de responsabilité unique. Cela permet une meilleure lisibilité et facilite la compréhension du code.

### Commentaires pertinents
Le code est accompagné de commentaires qui expliquent le but et le fonctionnement des différentes parties du code. Cela aide les autres développeurs à comprendre le code plus rapidement.

### Gestion des erreurs
Le code gère les erreurs de manière appropriée en lançant des exceptions spécifiques pour indiquer les problèmes rencontrés. Cela permet de séparer la logique de gestion des erreurs de la logique métier principale.

### Utilisation de constantes pour les messages d'erreur
Les messages d'erreur sont définis comme des constantes dans les classes correspondantes. Cela facilite la maintenance et permet une meilleure cohérence dans le traitement des erreurs.

### Injection de dépendances
Les dépendances sont injectées par le biais du constructeur, ce qui permet un couplage plus faible entre les différentes classes. Cela favorise la modularité et facilite les tests unitaires.
