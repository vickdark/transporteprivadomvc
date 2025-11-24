<?php
class controllerusuarios extends Controller
{
    public function index()
    {
        $this->render('usuarios/index', [
            'title' => 'Usuarios'
        ]);
    }
}
?>