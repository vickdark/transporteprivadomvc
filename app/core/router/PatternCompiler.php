<?php
class PatternCompiler
{
    public function compile(string $pattern): string
    {
        $pattern = trim($pattern, '/');
        if ($pattern === '') return '#^/$#';

        $pattern = preg_replace(
            '#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#',
            '(?P<$1>[^/]+)',
            $pattern
        );

        return '#^/' . $pattern . '/?$#';
    }
}
