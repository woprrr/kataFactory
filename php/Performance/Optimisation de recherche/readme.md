# Open-Close Principle

## Rappel OCP
Les entités logicielles (classes, modules, etc.) doivent être ouvertes à l'extension mais fermées à la modification. Cela signifie qu'on devrait pouvoir ajouter de nouvelles fonctionnalités en étendant le code existant plutôt qu'en le modifiant directement.

## KATA 1 (Intermédiaire)
Vous avez une liste de mots et vous devez trouver tous les anagrammes présents dans la liste. Un anagramme est un mot formé en réarrangeant les lettres d'un autre mot. Vous devez trouver tous les paires d'anagrammes dans la liste.

Votre tâche consiste à optimiser le code de recherche des anagrammes pour le rendre plus performant. Actuellement, le code effectue une recherche naïve en comparant chaque mot avec tous les autres mots de la liste. Vous devez trouver une approche plus efficace pour réduire le nombre de comparaisons et améliorer les performances.

Le **kata consiste à optimiser le code de recherche des anagrammes** en utilisant des techniques appropriées telles que l'indexation, le tri, le hachage, etc. L'objectif est d'améliorer les **performances du code** tout en obtenant un bon taux de maintenabilité.

```sh
# INPUT
$words = ['cat', 'dog', 'tac', 'god', 'act'];

# OUTPUT
[
  ['cat', 'tac', 'act'],
  ['dog', 'god']
]
```

### Sample code

```php
<?php

interface AnagramInterface {
  public function findAnagrams(array $words): array;
}

class AnagramsFinder implements AnagramInterface {
  private const MAX_WORD_GROUP_SIZE = 1;

  public function findAnagrams(array $words): array
  {
    $anagrams = [];
  
    $groups = $this->groupWordBySortedForm($words);

    return $this->filterWordGroups($groups);
  }

  private function groupWordBySortedForm(): array
  {
    $groups = [];
    foreach ($words as $word) {
        $sortedWord = SortUtils::sortString($word);
        $groups[$sortedWord][] = $word;
    }

    return $groups;
  }

  private function filterWordGroups($groups): array
  {
    $anagrams = [];

    foreach ($groups as $group) {
      if (count($group) > self::MAX_WORD_GROUP_SIZE) {
          $anagrams[] = $group;
      }
    }

    return $anagrams;
  }
}

final class SortUtils {
  public static function sortString(string $str): string
  {
    $chars = str_split($str);
    sort($chars);

    return implode('', $chars);
  }
}
```

### Contraintes Supplémentaires :
- Vous devez respecter le principe SOLID SRP (Single Responsibility Principle) et 
découper votre code en fonctions/méthodes claires et distinctes.
- Vous pouvez utiliser des structures de données supplémentaires si nécessaire (DS  (DataStructure), VO (Value Object), DTO (Data Transfert Object)).
- Assurez-vous de tester votre solution avec des cas de test variés pour vous assurer 
qu'elle fonctionne correctement.

### Pour aller encore plus loin...
- Appliquez TDD
- Appliquez le BabyStep
- Vérifiez le respect de l'intégralité des principes SOLID & clean code
  - Expliquez pourquoi certains principes ne sont pas appliquable de façon **pure** pour privilégié la performance.
