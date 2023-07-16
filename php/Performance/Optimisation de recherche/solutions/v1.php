<?php

use PHPUnit\Framework\TestCase;

class AnagramsFinderTest extends TestCase {
  public function testFindAnagrams(): void
  {
    $finder = new AnagramsFinder();

    $words = ['cat', 'dog', 'tac', 'god', 'act'];
    $expected = [['cat', 'tac', 'act'], ['dog', 'god']];
    $this->assertEquals($expected, $finder->findAnagrams($words));

    $words = ['hello', 'world', 'llohe', 'owrld', 'hlelo', 'dlrow'];
    $expected = [['hello', 'llohe', 'hlelo'], ['world', 'owrld', 'dlrow']];
    $this->assertEquals($expected, $finder->findAnagrams($words));

    $words = ['abc', 'def', 'ghi'];
    $expected = [];
    $this->assertEquals($expected, $finder->findAnagrams($words));

    $words = [];
    $expected = [];
    $this->assertEquals($expected, $finder->findAnagrams($words));

    $words = ['hello'];
    $expected = [];
    $this->assertEquals($expected, $finder->findAnagrams($words));
  }
}

class SortUtilsTest extends TestCase {
  public function testSortString(): void
  {
    $this->assertEquals('abc', SortUtils::sortString('cba'));
    $this->assertEquals('ehllo', SortUtils::sortString('hello'));
    $this->assertEquals('dlorw', SortUtils::sortString('world'));
  }
}

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
