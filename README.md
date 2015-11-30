# PW Exercise 2 - Product Configuration

[![Build Status](https://travis-ci.org/mihaeu/pw-product-configuration.svg?branch=develop)](https://travis-ci.org/mihaeu/pw-product-configuration)
[![Coverage Status](https://coveralls.io/repos/mihaeu/pw-product-configuration/badge.svg?branch=develop&service=github)](https://coveralls.io/github/mihaeu/pw-product-configuration?branch=develop)
![PHP v7](https://img.shields.io/badge/PHP-%3E%3D7-blue.svg)

## Requirements (by [Stefan Priebsch](https://thephp.cc/company/consultants/stefan-priebsch))

Erstellen sie die Geschäftslogik für einen Produktkonfigurator.
Dabei gelten die folgenden Geschäftsregeln:

✓ Artikel werden durch eine eindeutige ID identifiziert und
  haben einen Namen

✗ beim Kauf von bestimmten Artikeln können verschiedene Optionen
  hinzugewählt werden

✓ es gibt drei verschiedene Arten von Artikeln: Artikel ohne
  Optionen, Artikel mit maximal einer Option und Artikel mit
  mindestens einer und höchstens drei Optionen

✗ bestimmte Optionen sind nicht miteinander kombinierbar

✗ normalerweise sind Optionen jeweils nur auf bestimmte Artikel
  anwendbar; bestimmte Optionen wie Garantieverlängerungen oder
  Zusatzleistungen können jedoch auf alle Artikel angewendet
  werden, sofern diese generell Optionen zulassen

✓ jeder Artikel und jede Option haben einen Preis

✗ es kann pro Geschäftsvorgang nur ein einziger Artikel gekauft
  werden

✓ für den zu kaufenden Artikel müssen sowohl der Basispreis
  des Artikels als auch der Gesamtpreis inklusive aller
  gewählten Optionen angezeigt werden

## Getting started

```bash
# fetch repo
git clone https://github.com/mihaeu-ro/pw-product-configuration
cd pw-product-configuration

# download local composer
curl -sS https://getcomposer.org/installer | php

# fetch dependencies
php composer.phar install

# run tests
vendor/bin/phpunit -c phpunit.xml.dist --testdox
```