<?php

namespace Kek;

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
    public function action(): callable
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function path(): string
    {
        return $this->path;
    }

    /**
     * @param callable $resource
     * @return $this
     */
    public function middleware(callable $resource): Route
    {
        $this->middlewares[] = $resource;
        return $this;
    }

    /**
     * @return callable[]
     */
    public function middlewares(): array
    {
        return $this->middlewares;
    }
}
