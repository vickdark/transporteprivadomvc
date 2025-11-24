<?php
class controllervehiculos extends Controller
{
    public function index()
    {
        $this->render('vehiculos/index', [
            'title' => 'Vehículos'
        ]);
    }
}
?>