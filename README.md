# Kek

Another small micro framework.

## Install

    composer require ubermanu/kek

## Example

```php
require_once 'vendor/autoload.php';

$app = new \Kek\App();
$app->get('/ping', fn() => 'pong');
$app->listen();
```
