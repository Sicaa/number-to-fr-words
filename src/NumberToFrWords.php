<?php declare(strict_types=1);

namespace Sicaa\NumberToFrWords;

final class NumberToFrWords
{
    const UNITS = [
        1 => 'un',
        2 => 'deux',
        3 => 'trois',
        4 => 'quatre',
        5 => 'cinq',
        6 => 'six',
        7 => 'sept',
        8 => 'huit',
        9 => 'neuf',
    ];

    const TEN_TO_TEN = [
        10 => 'dix',
        20 => 'vingt',
        30 => 'trente',
        40 => 'quarante',
        50 => 'cinquante',
        60 => 'soixante',
        70 => 'soixante-dix',
        80 => 'quatre-vingt',
        90 => 'quatre-vingt-dix',
        100 => 'cent',
    ];

    const DECADES = [
        11 => 'onze',
        12 => 'douze',
        13 => 'treize',
        14 => 'quatorze',
        15 => 'quinze',
        16 => 'seize',
        17 => 'dix-sept',
        18 => 'dix-huit',
        19 => 'dix-neuf',
    ];

    const LARGE_NUMBERS = [
        1 => 'mille',
        'million',
        'milliard',
        'trillion',
        'quadrillion',
        'quintillion',
    ];

    public static function output(int $number): string
    {
        $reversedSplit = str_split(strrev((string) $number), 3);

        $words = [];
        foreach (array_reverse($reversedSplit) as $k => $piece) {
            $piece = strrev($piece);

            if ($k == 0 && $piece == 1 && count($reversedSplit) == 2) { // Exception for 1*** (we don't say "un mille")
                $words[] = '';
                continue;
            }

            $words[] = self::upTo3Digits($piece);
        }

        $maxLargeNumber = count($words) - 1;

        $output = '';
        foreach ($words as $k => $word) {
            if ($k > 0) {
                $largeNumber = self::LARGE_NUMBERS[$maxLargeNumber];
                if ($words[$k - 1] != 'un' && $largeNumber != 'mille') {
                    $largeNumber .= 's';
                }

                $output .= ' '.$largeNumber.' ';
                $maxLargeNumber--;
            }

            $output .= $word;
        }

        return trim($output);
    }

    private static function upTo3Digits(string $stringNumber): string
    {
        if (strlen($stringNumber) == 1) {
            return self::UNITS[$stringNumber];
        }

        $output1 = $output2 = '';

        $decade = (int) substr($stringNumber, -2, 1);
        $unit = (int) substr($stringNumber, -1);

        if (strlen($stringNumber) > 2) {
            $hundred = (int) substr($stringNumber, -3, 1);

            if ($hundred == 1) { // 1**
                $output2 = self::TEN_TO_TEN[$hundred * 100].' ';
            } else if ($hundred > 1) {
                $output2 = self::UNITS[$hundred].' cent';
                $output2 .= $decade.$unit <= 0 ? 's' : ' '; // No "s" if "cent" is the final word
            }
        }

        if ($decade.$unit <= 0) {
            return $output2.$output1;
        }

        if ($unit == 0) { // All *0
            $output1 = self::TEN_TO_TEN[$decade.$unit];
        } else if ($decade == 1) { // 11 to 19
            $output1 = self::DECADES[$decade.$unit];
        } else if (in_array($decade, [7, 9])) { // 7* and 9*
            $and = '-';
            if ($decade == 7 && $unit == 1) // 71
                $and = '-et-';
            $output1 = self::TEN_TO_TEN[$decade * 10 - 10].$and.self::DECADES[$unit + 10];
        } else if ($decade == 0) { // *0*
            $output1 = self::UNITS[$unit];
        } else if ($unit == 1) { // **1
            $and = '-et-';
            if ($decade == 8) // 81
                $and = '-';
            $output1 = self::TEN_TO_TEN[$decade * 10].$and.self::UNITS[$unit];
        } else { // All others
            $output1 = self::TEN_TO_TEN[$decade * 10].'-'.self::UNITS[$unit];
        }

        return $output2.$output1;
    }
}
