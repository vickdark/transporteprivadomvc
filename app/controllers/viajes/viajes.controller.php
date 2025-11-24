<?php
class controllerviajes extends Controller
{
    public function index()
    {
        $this->render('viajes/index', [
            'title' => 'Viajes'
        ]);
    }
}
?>