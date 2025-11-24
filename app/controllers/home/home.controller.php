<?php
class controllerhome extends Controller
{
    public function index()
    {
        $this->render('home/index', [
            'title' => 'Bienvenido'
        ]);
    }
}
?>