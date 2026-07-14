<?php
require_once __DIR__ . '/../config/config.php';
$titulo = 'Formulario de Consultorios';

// Solo mostramos doctores ACTIVOS (estado = 1) en el select, para no poder
// asignar un consultorio nuevo a un doctor que ya fue dado de baja.
$sqlDoctores = "SELECT pk_doctor, nombre, especialidad FROM doctor WHERE estado = 1 ORDER BY nombre ASC";
$resultadoDoctores = $conn->query($sqlDoctores);

include __DIR__ . '/../includes/header.php';
?>

<div class="alert alert-primary text-center text-dark container mt-4">
    <h1>Formulario de Consultorios</h1>
</div>

<form action="guardar.php" method="POST" class="container mt-4">

    <div class="mb-3">
        <label for="doctor" class="form-label">Ingresa el doctor:</label>
        <select name="fk_doctor" id="doctor" class="form-control" required>
            <option value="">Seleccione un doctor</option>
            <?php
            // fetch_assoc() va leyendo cada fila del resultado, como un cursor.
            // El while repite el bloque por cada doctor encontrado,
            // generando una <option> dinámica por cada uno.
            while ($doc = $resultadoDoctores->fetch_assoc()):
            ?>
                <option value="<?php echo htmlspecialchars($doc['pk_doctor']); ?>">
                    <?php echo htmlspecialchars($doc['nombre'] . ' - ' . $doc['especialidad']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="numero" class="form-label">Número:</label>
        <input type="text" class="form-control" id="numero" name="numero" required>
    </div>

    <div class="mb-3">
        <label for="ubicacion" class="form-label">Ubicación:</label>
        <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
    </div>

    <button type="submit" class="btn btn-primary form-control">Guardar</button>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
