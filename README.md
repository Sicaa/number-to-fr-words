# number-to-fr-words
Outil PHP pour convertir un nombre en mots (français)

## Utilisation

```php
<?php

var_dump(NumberToFrWords::output(1337));

// string(29) "mille trois cents trente-sept"
```

## Limitations

Le nombre maximal supporté dépend de la plateforme sur laquelle est utilisée l'outil. Au délà de la valeur de PHP_INT_MAX, PHP interprète l'entier en tant que nombre décimal (voir http://php.net/manual/fr/language.types.integer.php). La classe ne prenant pas en charge les nombres non entiers, sur un support 64-bit, le nombre maximal pris en charge est 9223372036854775807.

```php
<?php

var_dump(NumberToFrWords::output(9223372036854775807));

// string(197) "neuf quintillions deux cents vingt-trois quadrillions trois cents soixante-douze trillions trente-six milliards huit cents cinquante-quatre millions sept cents soixante-quinze mille huit cents sept"

var_dump(NumberToFrWords::output(9223372036854775808));

// Fatal error: Uncaught exception 'Exception' with message 'NumberToFrWords::output: $number must be an integer'
```
