<?php
class Dispatcher
{
    public function dispatch(array $routes, string $uri, string $method)
    {
        $path = parse_url($uri, PHP_URL_PATH);

        foreach ($routes as $route) {
            if ($route->method !== $method) continue;

            if (preg_match($route->regex, $path, $matches)) {
                $params = [];

                foreach ($matches as $key => $value) {
                    if (!is_int($key)) $params[$key] = $value;
                }

                return $this->invoke($route->handler, $params);
            }
        }

        http_response_code(404);
        echo "404";
        return null;
    }

    private function invoke($handler, array $params)
    {
        if (is_callable($handler)) {
            return call_user_func_array($handler, $params);
        }

        if (is_array($handler)) {
            [$class, $method] = $handler;
            $instance = is_string($class) ? new $class() : $class;
            return $instance->$method(...array_values($params));
        }

        throw new Exception("Handler inválido");
    }
}
