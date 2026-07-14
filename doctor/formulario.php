<?php
require_once __DIR__ . '/../config/config.php';
$titulo = 'Formulario de Doctores';
include __DIR__ . '/../includes/header.php';
?>

<div class="alert alert-primary text-center text-dark container mt-4">
    <h1>Formulario de Doctores</h1>
</div>

<form action="guardar.php" method="POST" class="container mt-4">

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>

    <div class="mb-3">
        <label for="especialidad" class="form-label">Especialidad:</label>
        <input type="text" class="form-control" id="especialidad" name="especialidad" required>
    </div>

    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="text" class="form-control" id="telefono" name="telefono" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <button type="submit" class="btn btn-primary form-control">Guardar</button>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
