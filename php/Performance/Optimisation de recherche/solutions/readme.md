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

### Démarche

- [Ajout Tests Unitaire](v1.php)
  - Application du principe du TDD, sur du code inexistant on commence par coder les tests, dans le cas présent le code étant existant dois être tester en première intention.

  - Ces tests unitaires assurent une couverture à 100% pour le code de recherche des anagrammes et la fonction utilitaire de tri. Ils vérifient que les résultats obtenus correspondent aux attentes pour différentes combinaisons de mots, y compris des mots avec des anagrammes et des mots sans anagrammes.

- [Optimisation de la recherche](v2.php)
  - Dans cette version optimisée, nous utilisons un tableau associatif `$groups` pour regrouper les mots en fonction de leur forme triée. Ainsi, les mots qui sont des anagrammes auront la même clé dans le tableau `$groups`. Cela nous permet de réduire considérablement le nombre de comparaisons nécessaires.

  - En second temps, nous parcourons le tableau `$groups` et ne conservons que les groupes de mots contenant plus d'un mot (anagrammes). Ces groupes sont ajoutés au tableau `$anagrams`, qui est finalement renvoyé en tant que résultat.

  - Cette approche est déjà plus optimisée et permet de réduire la complexité de l'algorithme tout en améliorerant les performances de recherche des anagrammes globale.

  - En utilisant un **Data Provider**, nous pouvons définir plusieurs ensembles de données de test pour chaque cas, ce qui nous permet de couvrir une plus grande variété de scénarios de test. Cela optimise les cas de test en évitant la duplication de code et en rendant les tests plus clairs et plus faciles à maintenir.

- [Optimisation des tests](v3.php)
  - Maintenant, les méthodes `wordListsProvider()` et `wordProvider()` retournent des itérables qui utilisent **yield** pour générer dynamiquement les ensembles de données de test. **Expert tips : Cela permet d'économiser de la mémoire, car les données ne sont pas stockées en mémoire à l'avance, mais générées à la volée lors de l'exécution des tests.**
  Cela rend les tests plus efficaces et plus flexibles, en particulier lorsque vous travaillez avec de grandes quantités de données de test ou lorsque vous avez des ensembles de données dynamiques.
- [Travail sur le SOLID & Clean Code](v4.php)
  - *S.O.L.I.D*
    - *S*ingle Responsibility Principle (SRP) : Les classes AnagramsFinder et SortUtils ont une seule responsabilité et sont bien délimitées pour leurs tâches respectives.

    - **O**pen-Closed Principle (OCP) : Le code est conçu pour être ouvert à l'extension (ajout de nouvelles fonctionnalités) grâce à l'interface AnagramInterface, tout en restant fermé à la modification des classes existantes.

    - **L**iskov Substitution Principle (LSP) : Les classes AnagramsFinder et SortUtils respectent le principe de substitution de Liskov en implémentant l'interface AnagramInterface de manière conforme.

    - **I**nterface Segregation Principle (ISP) : L'interface AnagramInterface contient une seule méthode nécessaire pour la fonctionnalité requise, respectant ainsi le principe de ségrégation des interfaces.

    - **D**ependency inversion Principle (DIP) : Les classes dépendent des abstractions (interfaces) plutôt que des détails concrets. Par exemple, la classe AnagramsFinder dépend de l'interface AnagramInterface, ce qui permet d'utiliser différentes implémentations de la recherche d'anagrammes.

  - Clean Code
    - On favorise l'utilisation des **noms de variables** et de **méthodes explicites**, suit une structure logique et utilise des **commentaires pertinents** pour faciliter la compréhension sans en ajouter à outrance.
    - Les **tests unitaires** sont fournis pour valider le comportement des classes et garantir leur fonctionnement correct.
    - Ajout d'une exception personnalisée `AnagramSortingException` pour gérer les erreurs lors du tri des caractères d'un mot. La méthode SortUtils::sortString() entoure le bloc de code potentiellement problématique avec un bloc try-catch pour capturer toute exception Throwable (qui inclut les exceptions standard et les erreurs). Si une exception se produit, elle est identifiée sous la forme d'une `AnagramSortingException`, qui est ensuite gérée dans les tests appropriés.

### Justification des choix du design :
**Couplage fort entre AnagramsFinder et SortUtils**

Dans le but d'optimiser les performances, la classe AnagramsFinder appelle directement la méthode statique `SortUtils::sortString()` pour trier les caractères d'un mot. Cela crée un couplage fort entre ces deux classes, rendant AnagramsFinder dépendant de SortUtils. Une approche plus "pure" aux principes SOLID serait d'injecter une dépendance de tri dans AnagramsFinder via une interface, permettant une meilleure séparation des responsabilités.

**Manque d'abstraction pour la recherche d'anagrammes**

La classe `AnagramsFinder` gère à la fois la recherche d'anagrammes et le filtrage des groupes d'anagrammes. Cela peut violer le principe de responsabilité unique. Une approche plus propre serait de séparer ces deux responsabilités en utilisant des classes distinctes, ce qui améliorerait la cohésion et la séparation des préoccupations.

Ces décisions ont été prises pour optimiser la performance du code, en minimisant les opérations coûteuses et en simplifiant les processus de recherche des anagrammes. Cependant, elles peuvent sacrifier le respect "strict" des principes du clean code et SOLID, tels que la séparation des préoccupations, la réutilisabilité. Ce choix semble cohérent quand à la nature du script et ses fonctionalitès. En cas de complexification des règles de gestion, il faudras résoudre les deux éléments listés afin de s'assurer un bon équilibre entre performance / design.
