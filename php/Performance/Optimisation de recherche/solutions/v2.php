<?php

use PHPUnit\Framework\TestCase;

interface AnagramInterface {
  public function findAnagrams(array $words): array;
}

class AnagramsFinder implements AnagramInterface {
  private const MAX_WORD_GROUP_SIZE = 1;

  public function findAnagrams(array $words): array
  {
    $anagrams = [];
    $groups = [];

    foreach ($words as $word) {
      $sortedWord = SortUtils::sortString($word);

      if (!isset($groups[$sortedWord])) {
        $groups[$sortedWord] = [];
      }

      $groups[$sortedWord][] = $word;
    }

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

class AnagramsFinderTest extends TestCase {
  /**
   * @dataProvider wordListsProvider
   */
  public function testFindAnagrams(array $words, array $expected): void
  {
    $finder = new AnagramsFinder();
    $this->assertEquals($expected, $finder->findAnagrams($words));
  }

  public function wordListsProvider(): array
  {
    return [
      [
        ['cat', 'dog', 'tac', 'god', 'act'],
        [['cat', 'tac', 'act'], ['dog', 'god']]
      ],
      [
        ['hello', 'world', 'llohe', 'owrld', 'hlelo', 'dlrow'],
        [['hello', 'llohe', 'hlelo'], ['world', 'owrld', 'dlrow']]
      ],
      [
        ['abc', 'def', 'ghi'],
        []
      ],
      [
        [],
        []
      ],
      [
        ['hello'],
        []
      ],
    ];
  }
}

class SortUtilsTest extends TestCase {
  /**
   * @dataProvider wordProvider
   */
  public function testSortString(string $word, string $expected): void
  {
    $sortedString = SortUtils::sortString($word);
    $this->assertEquals($expected, $sortedString);
  }

  public function wordProvider(): array
  {
    return [
      ['cba', 'abc'],
      ['hello', 'ehllo'],
      ['world', 'dlorw'],
    ];
  }
}

// Exécution des tests unitaires
$result = PHPUnit::run([
    AnagramsFinderTest::class,
    SortUtilsTest::class,
]);
