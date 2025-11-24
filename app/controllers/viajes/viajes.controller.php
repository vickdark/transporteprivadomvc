<?php
class controllerviajes
{
    private function render($view, $data = [])
    {
        extract($data);
        ob_start();
        include "../app/views/$view.php";
        $content = ob_get_clean();
        include "../app/views/template.php";
    }
    public function index()
    {
        $this->render('viajes/index', ['title' => 'Viajes']);
    }
}
?>