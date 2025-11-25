<?php
class Route
{
    public string $method;
    public string $pattern;
    public string $regex;
    public $handler;

    public function __construct($method, $pattern, $regex, $handler)
    {
        $this->method  = $method;
        $this->pattern = $pattern;
        $this->regex   = $regex;
        $this->handler = $handler;
    }
}
