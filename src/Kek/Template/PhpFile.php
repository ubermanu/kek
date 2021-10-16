<?php

namespace Kek\Template;

use Kek\Exception;

class PhpFile implements Template
{
    /**
     * @var string
     */
    protected string $filename;

    /**
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * @param array $params
     * @return string
     * @throws Exception
     */
    public function render(array $params = []): string
    {
        if (!file_exists($this->filename)) {
            throw new Exception(sprintf('The file %s could not be found.', $this->filename));
        }

        extract($params);
        ob_start();
        include($this->filename);
        return ob_get_clean();
    }
}
