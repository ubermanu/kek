<?php

namespace Kek;

class Response
{
    /**
     * @var float
     */
    protected float $startTime;

    /**
     * @var string
     */
    protected string $contentType;

    /**
     * @var string
     */
    protected string $body = '';

    /**
     * @param float $time
     */
    public function __construct(float $time = 0.0)
    {
        $this->startTime = !empty($time) ? $time : \microtime(true);
    }

    /**
     * @param string $type
     * @param string $charset
     * @return $this
     */
    public function setContentType(string $type, string $charset): self
    {
        $this->contentType = $type . ((!empty($charset) ? '; charset=' . $charset : ''));
        return $this;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }
}
