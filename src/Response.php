<?php

namespace Kek;

class Response
{
    /**
     * The initial starting time of the request.
     * @var float
     */
    public float $startTime;

    /**
     * The content type of the response.
     * @var string
     */
    public string $type;

    /**
     * Content of the response.
     * @var string
     */
    public string $body = '';

    /**
     * Status code of the response.
     * @var int
     */
    public int $code = 200;

    /**
     * @param float $time
     */
    public function __construct(float $time = 0.0)
    {
        $this->startTime = !empty($time) ? $time : \microtime(true);
    }

    /**
     * Returns the length of the response body.
     * @return int
     */
    public function length(): int
    {
        return \strlen($this->body);
    }

    /**
     * Returns the response time in milliseconds.
     * @return float
     */
    public function time(): float
    {
        return \microtime(true) - $this->startTime;
    }
}
