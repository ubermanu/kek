<?php
/**
 * Additional shorthands to be included if necessary.
 */

if (!function_exists('app')) {
    function app(): \Kek\App
    {
        return new \Kek\App();
    }
}

if (!function_exists('view')) {
    function view(string $filename, array $params = []): string
    {
        return (new \Kek\Template\PhpFile($filename))->render($params);
    }
}
