<?php

namespace Kek\Framework;

class Route
{
    /**
     * @var string
     */
    protected string $path;

    /**
     * @var callable
     */
    protected $action;

    /**
     * @var callable[]
     */
    protected array $middlewares = [];

    /**
     * @param string $path
     * @param callable $action
     */
    public function __construct(string $path, callable $action)
    {
        $this->path = $path;
        $this->action = $action;
    }

    /**
     * @return callable
     */
    public function getAction(): callable
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param callable $resource
     * @return $this
     */
    public function addMiddleware(callable $resource): self
    {
        $this->middlewares[] = $resource;
        return $this;
    }

    /**
     * @return callable[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
