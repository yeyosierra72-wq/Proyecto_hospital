<?php
require_once __DIR__ . '/../config/config.php';
$titulo = 'Formulario de Proveedores';
include __DIR__ . '/../includes/header.php';
?>

<div class="alert alert-primary text-center text-dark container mt-4">
    <h1>Formulario de proveedor</h1>
</div>

<form action="guardar.php" method="POST" class="container mt-4">

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>

    <div class="mb-3">
        <label for="telefono" class="form-label">telefono:</label>
        <input type="text" class="form-control" id="telefono" name="telefono" required>
    </div>


    <button type="submit" class="btn btn-primary form-control">Guardar</button>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
