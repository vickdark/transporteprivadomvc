<?php
class Router
{
    private $routes = [];
    public function get($pattern, $handler)
    {
        $this->add('GET', $pattern, $handler);
    }
    public function post($pattern, $handler)
    {
        $this->add('POST', $pattern, $handler);
    }
    public function add($method, $pattern, $handler)
    {
        $regex = $this->compilePattern($pattern);
        $this->routes[] = [$method, $regex, $handler];
    }
    private function compilePattern($pattern)
    {
        $pattern = trim($pattern, '/');
        if ($pattern === '') {
            return '#^/$#';
        }
        $pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', $pattern);
        return '#^/' . $pattern . '/?$#';
    }
    public function dispatch($uri, $method)
    {
        $path = parse_url($uri, PHP_URL_PATH);
        foreach ($this->routes as [$m, $regex, $handler]) {
            if ($m !== $method) {
                continue;
            }
            if (preg_match($regex, $path, $matches)) {
                $params = [];
                foreach ($matches as $k => $v) {
                    if (!is_int($k)) {
                        $params[$k] = $v;
                    }
                }
                return $this->invoke($handler, $params);
            }
        }
        http_response_code(404);
        echo '404';
        return null;
    }
    private function invoke($handler, $params)
    {
        if (is_callable($handler)) {
            return call_user_func_array($handler, $params);
        }
        if (is_array($handler) && count($handler) === 2) {
            [$class, $method] = $handler;
            if (is_string($class)) {
                $class = new $class();
            }
            return $class->$method(...array_values($params));
        }
        return null;
    }
}
?>