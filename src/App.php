<?php

namespace Kek;

class App
{
    /**
     * @var array
     */
    protected array $routes = [];

    /**
     * @param string $timezone
     */
    public function __construct(string $timezone = 'UTC')
    {
        \date_default_timezone_set($timezone);
    }

    /**
     * @param string $method
     * @param string $path
     * @param callable $action
     * @return Route
     * @internal
     */
    public function addRoute(string $method, string $path, callable $action): Route
    {
        $route = new Route($path, $action);
        $this->routes[$method][$path] = $route;
        return $route;
    }

    /**
     * @param string $path
     * @param callable $action
     * @return Route
     */
    public function get(string $path, callable $action): Route
    {
        return $this->addRoute(Request::METHOD_GET, $path, $action);
    }

    /**
     * @param string $path
     * @param callable $action
     * @return Route
     */
    public function post(string $path, callable $action): Route
    {
        return $this->addRoute(Request::METHOD_POST, $path, $action);
    }

    /**
     * @param Request|null $request
     * @return Response
     */
    public function execute(?Request $request = null): Response
    {
        $request ??= new Request();
        $response = new Response();

        $url = \parse_url($request->getUrl(), PHP_URL_PATH);
        $method = $request->getMethod();
        $method = (Request::METHOD_HEAD == $method) ? Request::METHOD_GET : $method;

        if (!isset($this->routes[$method])) {
            $this->routes[$method] = [];
        }

        $matchedRoute = null;
        $matchedParams = [];

        /* @var Route $route */
        foreach ($this->routes[$method] as $routeUrl => $route) {

            // convert urls like '/users/:uid/posts/:pid' to regular expression
            $regex = '@' . \preg_replace('@:[^/]+@', '([^/]+)', $routeUrl) . '@';
            if (!\preg_match($regex, $url, $matches)) {
                continue;
            }

            \array_shift($matches);
            $matchedRoute = $route;
            $matchedParams = $matches;
            break;
        }

        if ($matchedRoute instanceof Route && ('/' === $matchedRoute->getPath()) && ($url != $matchedRoute->getPath())) {
            return $response;
        }

        if ($matchedRoute == null) {
            return $response;
        }

        // Combine keys and values to one array
        $url = $matchedRoute->getPath();
        $keys = [];
        $keyRegex = '@^' . \preg_replace('@:[^/]+@', ':([^/]+)', $url) . '$@';
        \preg_match($keyRegex, $url, $keys);
        \array_shift($keys);
        $params = \array_combine($keys, $matchedParams);

        $arguments = [$request, $params];

        foreach ($matchedRoute->getMiddlewares() as $middleware) {
            \call_user_func_array($middleware, $arguments);
        }

        $result = \call_user_func_array($matchedRoute->getAction(), $arguments);
        if ($result instanceof Response) {
            return $result;
        }

        return $response->setBody($result);
    }
}
