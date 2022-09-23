# Getting Started

**KEK** is a simple PHP microframework for building web applications and APIs.

## Install

    composer require ubermanu/kek

## Usage

Create a small API endpoint:

```php
require_once 'vendor/autoload.php';

$app = app();
$app->get('/', fn() => 'Hello world!');

// Run the app and print the response
echo $app->run()->body;
```

Run this example using the built-in PHP server:

    php -S localhost:8000

Then access your endpoint in your browser at [http://localhost:8000](http://localhost:8000).
