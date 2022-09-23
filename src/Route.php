<?php

namespace Kek;

class Route
{
    /**
     * @var string
     */
    public string $path;

    /**
     * @var callable
     */
    public $action;

    /**
     * @var callable[]
     */
    public array $middlewares = [];

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
     * @param callable $resource
     * @return $this
     */
    public function middleware(callable $resource): Route
    {
        $this->middlewares[] = $resource;
        return $this;
    }
}
