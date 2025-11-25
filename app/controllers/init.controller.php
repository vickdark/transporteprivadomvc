<?php
class Controller
{
    protected function render($view, $data = [])
    {
        $title = isset($data['title']) ? $data['title'] : null;
        ob_start();
        include __DIR__ . '/../views/' . $view . '.php';
        $content = ob_get_clean();
        include __DIR__ . '/../views/init.php';
    }
}
