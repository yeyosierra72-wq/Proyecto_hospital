<?php
require_once __DIR__ . '/../config/config.php';
$titulo = 'Formulario de categorías';
include __DIR__ . '/../includes/header.php';
?>

<div class="alert alert-primary text-center text-dark container mt-4">
    <h1>REgistrar Cliente</h1>
</div>

<form action="guardar.php" method="POST" class="container mt-4">

    <div class="mb-3">
        <label for="codigo" class="form-label">codigo</label>
        <input type="text" class="form-control" id="codigo" name="codigo" required>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
    </div>

    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">fecha_inicio</label>
        <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
    </div>

    <div class="mb-3">
        <label for="fecha_fin" class="form-label">fecha_fin</label>
        <input type="text" class="form-control" id="fecha_fin" name="fecha_fin" required>
    </div>
  
    

    <button type="submit" class="btn btn-primary form-control">Guardar</button>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
