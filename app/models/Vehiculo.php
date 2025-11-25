<?php
class Vehiculo
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->migrate();
    }

    private function migrate()
    {
        $sql = "CREATE TABLE IF NOT EXISTS vehiculos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            placa VARCHAR(20) NOT NULL,
            marca VARCHAR(50) NOT NULL,
            modelo VARCHAR(50) NOT NULL,
            anio INT NOT NULL,
            color VARCHAR(30) NOT NULL,
            capacidad INT NOT NULL,
            estado VARCHAR(20) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB";
        $this->pdo->exec($sql);
    }

    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM vehiculos ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM vehiculos WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO vehiculos (placa, marca, modelo, anio, color, capacidad, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['placa'],
            $data['marca'],
            $data['modelo'],
            (int)$data['anio'],
            $data['color'],
            (int)$data['capacidad'],
            $data['estado']
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("UPDATE vehiculos SET placa = ?, marca = ?, modelo = ?, anio = ?, color = ?, capacidad = ?, estado = ? WHERE id = ?");
        return $stmt->execute([
            $data['placa'],
            $data['marca'],
            $data['modelo'],
            (int)$data['anio'],
            $data['color'],
            (int)$data['capacidad'],
            $data['estado'],
            $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM vehiculos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
