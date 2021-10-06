<?php declare(strict_types=1);

namespace Sicaa\NumberToFrWords;

use PHPUnit\Framework\TestCase;
use Sicaa\NumberToFrWords\NumberToFrWords;

final class NumberToFrWordsTest extends TestCase
{
    public function numberProvider()
    {
        return [
            [1, 'un'],
            [2, 'deux'],
            [3, 'trois'],
            [4, 'quatre'],
            [5, 'cinq'],
            [6, 'six'],
            [7, 'sept'],
            [8, 'huit'],
            [9, 'neuf'],
            [10, 'dix'],
            [11, 'onze'],
            [15, 'quinze'],
            [99, 'quatre-vingt-dix-neuf'],
            [100, 'cent'],
            [400, 'quatre cents'],
            [1127, 'mille cent vingt-sept'],
            [1100, 'mille cent'],
            [1337, 'mille trois cent trente-sept'],
            [1664, 'mille six cent soixante-quatre'],
            [1900, 'mille neuf cents'],
            [2000, 'deux mille'],
            [10492, 'dix mille quatre cent quatre-vingt-douze'],
            [197465151, 'cent quatre-vingt-dix-sept millions quatre cent soixante-cinq mille cent cinquante-et-un'],
        ];
    }

    /**
     * @dataProvider numberProvider
     */
    public function testNumberToFrWordOutput($number, $stringExpected)
    {
        self::assertSame($stringExpected, NumberToFrWords::output($number));
    }
}
