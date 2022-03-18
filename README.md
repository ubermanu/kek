# Kek

[![Tests](https://github.com/ubermanu/kek/actions/workflows/tests.yml/badge.svg)](https://github.com/ubermanu/kek/actions/workflows/tests.yml)

Another small micro framework.

## Install

    composer require ubermanu/kek

## Example

```php
require_once 'vendor/autoload.php';

$app = new \Kek\App();
$app->get('/ping', fn() => 'pong');

echo $app->execute()->getBody();
```
