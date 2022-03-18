<?php

namespace Kek;

/**
 * @return App
 */
function app(): App
{
    return new App();
}

/**
 * @param string $filename
 * @param array $params
 * @return string
 * @throws Exception
 */
function view(string $filename, array $params = []): string
{
    return (new \Kek\Template\PhpFile($filename))->render($params);
}

/**
 * @param string $key
 * @param array $params
 * @return string
 */
function __(string $key, array $params = []): string
{
    $translation = \Kek\Language\Current::instance()->translate($key);
    return vsprintf($translation, $params);
}
