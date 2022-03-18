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
