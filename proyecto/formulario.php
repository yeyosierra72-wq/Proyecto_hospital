<?php
require_once __DIR__ . '/../config/config.php';
$titulo = 'Formulario de categorías';
include __DIR__ . '/../includes/header.php';
?>

<div class="alert alert-primary text-center text-dark container mt-4">
    <h1>Formulario de Proyectos</h1>
</div>d

<form action="guardar.php" method="POST" class="container mt-4">

    <div class="mb-3">
        <label for="codigo" class="form-label">codigo:</label>
        <input type="text" class="form-control" id="codigo" name="codigo" required>
    </div>

    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="text" class="form-control" id="telefono" name="telefono" required>
    </div>

    <div class="mb-3">
        <label for="domicilio" class="form-label">Domicilio:</label>
        <input type="text" class="form-control" id="domicilio" name="domicilio" required>
    </div>

    <div class="mb-3">
        <label for="razon_social" class="form-label">Razón Social:</label>
        <input type="text" class="form-control" id="razon_social" name="razon_social" required>
    </div>
  
    

    

    <button type="submit" class="btn btn-primary form-control">Guardar</button>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
