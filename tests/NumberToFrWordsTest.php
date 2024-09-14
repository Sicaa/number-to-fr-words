<?php declare(strict_types=1);

namespace Sicaa\NumberToFrWords;

use PHPUnit\Framework\TestCase;
use Sicaa\NumberToFrWords\NumberToFrWords;

final class NumberToFrWordsTest extends TestCase
{
    public function numberProvider()
    {
        return [
            [0, 'zéro'],
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
            [1000000, 'un million'],
            [197465151, 'cent quatre-vingt-dix-sept millions quatre cent soixante-cinq mille cent cinquante-et-un'],
            [1000000000, 'un milliard'],
            [1000002000000, 'un trillion deux millions'],
            [1000000000002000, 'un quadrillion deux mille'],
            [1000000000000000000, 'un quintillion'],
            [9223372036854775807, 'neuf quintillions deux cent vingt-trois quadrillions trois cent soixante-douze trillions trente-six milliards huit cent cinquante-quatre millions sept cent soixante-quinze mille huit cent sept']
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
