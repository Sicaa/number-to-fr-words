# Number To FR Words

![Build Status](https://img.shields.io/circleci/build/github/Sicaa/number-to-fr-words)

## English

I've written this tiny library to easily transform a number into french words. This project came up when I had to automatically write on bank checks for a client. At this time, the only solution was to use an old and heavy Pear package (https://pear.php.net/package/Numbers_Words). Naturally, the following documentation is therefore written in French.

## Français

Lib PHP simple pour convertir un nombre en mots (français). Ce projet a vu le jour lorsque j'ai eu besoin d'écrire automatiquement sur des chèques bancaires pour un client. À l'époque, la seule solution aurait été d'utiliser une ancienne lib Pear (https://pear.php.net/package/Numbers_Words).

### Utilisation

```bash
composer require sicaa/number-to-fr-words
```

```php
<?php

use Sicaa\NumberToFrWords\NumberToFrWords;

var_dump(NumberToFrWords::output(1337));

// string(29) "mille trois cent trente-sept"
```

### Limitations

Le nombre maximal supporté dépend de la plateforme sur laquelle est utilisée l'outil. Au délà de la valeur de PHP_INT_MAX, PHP interprète l'entier en tant que nombre décimal (voir http://php.net/manual/fr/language.types.integer.php). La classe ne prenant pas en charge les nombres non entiers, sur un support 64-bit, le nombre maximal pris en charge est 9223372036854775807.

```php
<?php

var_dump(NumberToFrWords::output(9223372036854775807));

// string(192) "neuf quintillions deux cent vingt-trois quadrillions trois cent soixante-douze trillions trente-six milliards huit cent cinquante-quatre millions sept cent soixante-quinze mille huit cent sept"

var_dump(NumberToFrWords::output(9223372036854775808));

// Fatal error: Uncaught exception 'Exception' with message 'NumberToFrWords::output: $number must be an integer'
```
