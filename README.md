# Kek

Another small micro framework.

Example:

```php
$app = new \Kek\App();
$app->get('/ping', fn() => 'pong');
$app->listen();
```
