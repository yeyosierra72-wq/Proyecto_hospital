<?php
require_once __DIR__ . '/../config/config.php';
$titulo = 'Listado de Consultorios';

// INNER JOIN: traemos cada consultorio junto con los datos del doctor
// al que pertenece. Solo mostramos consultorios cuyo doctor sigue activo
// (WHERE d.estado = 1), igual que en el select del formulario.
$sql = "SELECT c.pk_consultorio, c.numero, c.ubicacion, d.nombre, d.especialidad
        FROM consultorio c
        INNER JOIN doctor d ON c.fk_doctor = d.pk_doctor
        WHERE d.estado = 1
        ORDER BY c.pk_consultorio DESC";

$resultado = $conn->query($sql);

include __DIR__ . '/../includes/header.php';
?>

<div class="container mt-4 alert alert-primary text-center">
    <h2>Listado de Consultorios</h2>
</div>

<table class="table table-striped container mt-4">
    <thead>
        <tr>
            <th>ID de Registro</th>
            <th>Número de consultorio</th>
            <th>Ubicación</th>
            <th>Nombre del doctor</th>
            <th>Especialidad</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // mysqli usa fetch_assoc() para leer cada fila del resultado como
        // un arreglo asociativo ($fila['columna']).
        while ($fila = $resultado->fetch_assoc()):
        ?>
        <tr>
            <!-- htmlspecialchars() al mostrar: misma razón que en doctor/mostrar.php,
                 protege contra XSS si algún dato guardado tuviera código HTML/JS -->
            <td><?php echo htmlspecialchars($fila['pk_consultorio']); ?></td>
            <td><?php echo htmlspecialchars($fila['numero']); ?></td>
            <td><?php echo htmlspecialchars($fila['ubicacion']); ?></td>
            <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
            <td><?php echo htmlspecialchars($fila['especialidad']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
