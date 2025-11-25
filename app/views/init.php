<?php
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/sidebar.php';
?>

<!-- Content Wrapper - Contenido principal -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- Título dinámico: se muestra el valor de la variable $title si existe; de lo contrario, se deja vacío -->
                    <h1><?= isset($title) ? $title : '' ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <?= isset($content) ? $content : '' ?>
    </section>
</div>

<?php 
include __DIR__ . '/partials/footer.php'; 
?>
