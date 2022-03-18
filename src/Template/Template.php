<?php

namespace Kek\Template;

interface Template
{
    /**
     * @param array $params
     * @return string
     */
    public function render(array $params = []): string;
}
