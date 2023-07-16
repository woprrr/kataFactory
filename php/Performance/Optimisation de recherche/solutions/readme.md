# Solution

## KATA 1

### Clean Code
- Les noms des classes, des méthodes et des variables sont significatifs et expriment clairement leur intention.
- Le code est bien structuré et lisible, avec une indentation appropriée et une mise en forme cohérente.
- Les commentaires sont présents pour expliquer le code de manière claire et apporter des informations complémentaires.

### SOLID
- **Single Responsibility Principle (SRP)** : Chaque classe a une responsabilité unique et une seule raison de changer. Par exemple, la classe `AnagramsFinder` est responsable de la recherche d'anagrammes, tandis que la classe `SortUtils` se concentre uniquement sur le tri des chaînes de caractères. Cela permet d'obtenir des classes plus spécialisées et faciles à maintenir.
- **Open/Closed Principle (OCP)** : Le code est ouvert à l'extension mais fermé à la modification. L'utilisation d'une interface `AnagramInterface` permet d'ajouter de nouvelles implémentations de la recherche d'anagrammes sans avoir à modifier le code existant. Cela facilite l'ajout de nouvelles fonctionnalités tout en maintenant la stabilité du code existant.
- **Liskov Substitution Principle (LSP)** : Les classes dérivées (`AnagramsFinder`) peuvent être utilisées de manière interchangeable avec leur classe de base (`AnagramInterface`) sans altérer le comportement attendu du programme. Cela garantit une cohérence dans l'utilisation des classes et facilite l'extension du système.
- **Interface Segregation Principle (ISP)** : Les interfaces (`AnagramInterface`) sont spécifiques à un ensemble cohérent de fonctionnalités et évitent d'imposer des méthodes inutiles aux classes qui les implémentent. Cela permet aux classes de ne dépendre que des fonctionnalités nécessaires, évitant ainsi une surcharge inutile.
- **Dependency Inversion Principle (DIP)** : Les classes dépendent des abstractions (`AnagramInterface`) plutôt que des détails concrets. Cela permet de coupler les classes à des interfaces plutôt qu'à des implémentations concrètes, ce qui facilite la substitution et la modularité.

### Design VS Performance :
Le choix de la performance sur le design a été fait en optimisant les algorithmes de recherche d'anagrammes. 

Par exemple, en utilisant un tableau associatif pour regrouper les mots ayant la même forme triée, on réduit le nombre de comparaisons nécessaires. De plus, le tri des caractères au sein de la classe `SortUtils` permet d'accélérer la comparaison des mots.

Notez que cette optimisation peut conduire à un code moins "pur" du point de vue du design, car elle privilégie la performance au détriment d'une structure plus modulaire et extensible.

Il peut également une certaine duplication de code et une complexité accrue pour maintenir les performances optimales et ici c'est assumé.

Au global le code respecte les principes *SOLID* et le *Clean Code* en **privilégiant la performance sur le design**. Cela permet d'obtenir un code efficace tout en gardant à l'esprit la maintenabilité et l'extensibilité du système.

**NOTE :**
Adaptez toujours vos code pour répondre aux besoins en premier ensuite recherchez les meilleurs décision concernant le design.

** NOTE 2 :**
Les méthodes wordListsProvider() et wordProvider() retournent des itérables qui utilisent yield pour générer dynamiquement les ensembles de données de test.

**Cela permet d'économiser de la mémoire, car les données ne sont pas stockées en mémoire à l'avance, mais générées à la volée lors de l'exécution des tests.**

Cela rend les tests plus efficaces et plus flexibles, en particulier lorsque vous travaillez avec de grandes quantités de données de test ou lorsque vous avez des ensembles de données dynamiques.
