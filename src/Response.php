<?php

namespace Kek;

class Response
{
    /**
     * @var float
     */
    public float $startTime;

    /**
     * @var string
     */
    public string $contentType;

    /**
     * @var string
     */
    public string $body = '';

    /**
     * @var int
     */
    public int $statusCode = 200;

    /**
     * @param float $time
     */
    public function __construct(float $time = 0.0)
    {
        $this->startTime = !empty($time) ? $time : \microtime(true);
    }

    /**
     * @return int
     */
    public function length(): int
    {
        return \strlen($this->body);
    }
}
