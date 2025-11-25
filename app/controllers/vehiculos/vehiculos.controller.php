<?php
class controllervehiculos extends Controller
{
    public function index()
    {
        $this->render('vehiculos/index', [
            'title' => 'Vehículos'
        ]);
    }
    
    public function list()
    {
        header('Content-Type: application/json');
        $model = new Vehiculo();
        echo json_encode($model->all());
    }

    public function create()
    {
        header('Content-Type: application/json');
        $payload = $_POST;
        $required = ['placa','marca','modelo','anio','color','capacidad','estado'];
        foreach ($required as $key) {
            if (!isset($payload[$key]) || trim($payload[$key]) === '') {
                http_response_code(422);
                echo json_encode(['error' => 'Datos incompletos']);
                return;
            }
        }
        $model = new Vehiculo();
        $id = $model->create($payload);
        echo json_encode(['id' => $id]);
    }

    public function show($id)
    {
        header('Content-Type: application/json');
        $model = new Vehiculo();
        $row = $model->find((int)$id);
        if (!$row) {
            http_response_code(404);
            echo json_encode(['error' => 'No encontrado']);
            return;
        }
        echo json_encode($row);
    }

    public function update($id)
    {
        header('Content-Type: application/json');
        $payload = $_POST;
        $required = ['placa','marca','modelo','anio','color','capacidad','estado'];
        foreach ($required as $key) {
            if (!isset($payload[$key]) || trim($payload[$key]) === '') {
                http_response_code(422);
                echo json_encode(['error' => 'Datos incompletos']);
                return;
            }
        }
        $model = new Vehiculo();
        $ok = $model->update((int)$id, $payload);
        echo json_encode(['updated' => $ok]);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        $model = new Vehiculo();
        $ok = $model->delete((int)$id);
        echo json_encode(['deleted' => $ok]);
    }
}
?>
