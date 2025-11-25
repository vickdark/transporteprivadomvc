<?php
class Router
{
    private $collection;
    private $compiler;
    private $dispatcher;

    public function __construct()
    {
        $this->collection = new RouteCollection();
        $this->compiler   = new PatternCompiler();
        $this->dispatcher = new Dispatcher();
    }

    public function get($pattern, $handler)
    {
        $this->add('GET', $pattern, $handler);
    }

    public function post($pattern, $handler)
    {
        $this->add('POST', $pattern, $handler);
    }

    private function add($method, $pattern, $handler)
    {
        $regex = $this->compiler->compile($pattern);
        $route = new Route($method, $pattern, $regex, $handler);
        $this->collection->add($route);
    }

    public function run($uri, $method)
    {
        return $this->dispatcher->dispatch(
            $this->collection->all(),
            $uri,
            $method
        );
    }
}
