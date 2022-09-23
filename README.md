# Kek

[![Tests](https://github.com/ubermanu/kek/actions/workflows/tests.yml/badge.svg)](https://github.com/ubermanu/kek/actions/workflows/tests.yml)

<br>
<p align="center">
    <img src="docs/images/kek-logo.svg" alt width="120">
</p>
<br>

Another small micro framework.

## Install

    composer require ubermanu/kek

## Example

```php
require_once 'vendor/autoload.php';

$app = app();
$app->get('/ping', fn() => 'pong');

echo $app->run()->body; // pong
```
