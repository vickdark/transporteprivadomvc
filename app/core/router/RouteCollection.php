<?php
class RouteCollection
{
    private $routes = [];

    public function add(Route $route)
    {
        $this->routes[] = $route;
    }

    public function all()
    {
        return $this->routes;
    }
}
