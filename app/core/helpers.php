<?php
$scriptName = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
$scriptDir = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
$baseTmp = rtrim(str_replace('\\', '/', dirname($scriptDir)), '/');
if ($baseTmp === '/' || $baseTmp === '') { $baseTmp = ''; }
if (!defined('BASE_URL')) { define('BASE_URL', $baseTmp); }
if (!function_exists('url')) {
    function url(string $path): string { return BASE_URL . $path; }
}
if (!function_exists('asset')) {
    function asset(string $path): string { return BASE_URL . '/public/' . ltrim($path, '/'); }
}

