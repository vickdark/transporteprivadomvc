<?php
$conexionOk = false;
$mensajeConexion = '';
try {
    Database::getConnection();
    $conexionOk = true;
    $mensajeConexion = 'Conexión exitosa a la base de datos.';
} catch (Throwable $e) {
    $mensajeConexion = 'Error de conexión: ' . $e->getMessage();
}
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Bienvenido</h3>
    </div>
    <div class="card-body">
        <p><?= $mensajeConexion ?></p>
        <p>Esta es la página inicial de tu sistema.</p>
        <p>Usa el menú para navegar a los módulos.</p>
        <p>Para más información, consulta la documentación.</p> 
        <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
        <p>Contacto: <a href="mailto:contacto@example.com">contacto@example.com</a></p>
        <p>Teléfono: +123456789</p>
        <p>Dirección: Calle Falsa 123, Ciudad, País</p>
        <p>Horario de atención: Lunes a Viernes, 9:00 AM - 6:00 PM</p>
        <p>Horario de sábados, 10:00 AM - 4:00 PM</p>
        <p>Horario de domingos, 12:00 PM - 2:00 PM</p>

    </div>
    <div class="card-footer">
        Inicio
    </div>
</div>