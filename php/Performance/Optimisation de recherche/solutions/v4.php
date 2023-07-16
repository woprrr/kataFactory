<?php

use PHPUnit\Framework\TestCase;

class AnagramSortingException extends Exception {}

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
  public static function sortString(?string $str): string
  {
    if ($str === null) {
      throw new AnagramSortingException('Input string cannot be null');
    }

    $chars = str_split($str);
    sort($chars);

    return implode('', $chars);
  }
}

class AnagramsFinderTest extends TestCase {
  public function testFindAnagrams(): void
  {
    $finder = new AnagramsFinder();

    $wordLists = $this->wordListsProvider();
    foreach ($wordLists as $words => $expected) {
      $this->assertEquals($expected, $finder->findAnagrams($words));
    }
  }

  private function wordListsProvider(): iterable
  {
    yield [
      ['cat', 'dog', 'tac', 'god', 'act'],
      [['cat', 'tac', 'act'], ['dog', 'god']]
    ];

    yield [
      ['hello', 'world', 'llohe', 'owrld', 'hlelo', 'dlrow'],
      [['hello', 'llohe', 'hlelo'], ['world', 'owrld', 'dlrow']]
    ];

    yield [
      ['abc', 'def', 'ghi'],
      []
    ];

    yield [
      [],
      []
    ];

    yield [
      ['hello'],
      []
    ];
  }
}

class SortUtilsTest extends TestCase {
  public function testSortString(): void
  {
    $wordProvider = $this->wordProvider();
    foreach ($wordProvider as $word => $expected) {
      $sortedString = SortUtils::sortString($word);
      $this->assertEquals($expected, $sortedString);
    }
  }

  public function testSortStringWithException(): void
  {
    $this->expectException(AnagramSortingException::class);

    SortUtils::sortString(null);
  }

  private function wordProvider(): iterable
  {
    yield ['cba', 'abc'];
    yield ['hello', 'ehllo'];
    yield ['world', 'dlorw'];
  }
}

// Exécution des tests unitaires
$result = PHPUnit::run([
  AnagramsFinderTest::class,
  SortUtilsTest::class,
]);
