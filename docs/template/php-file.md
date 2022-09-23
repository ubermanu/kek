# PHP File

## Usage

The following example shows how to render a `php-file` template as response:

```php
$app->get('/ping', fn() => view('template.phtml', ['name' => 'John']));
```
