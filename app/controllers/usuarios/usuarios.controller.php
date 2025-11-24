<?php
class controllerusuarios
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
        $this->render('usuarios/index', ['title' => 'Usuarios']);
    }
}
?>