<?php
require_once __DIR__ . '/../config/config.php';
$titulo = 'Listado de Doctores';

// Consulta simple: traemos todos los doctores, activos e inactivos.
// (No filtramos por estado aquí porque esta vista es de administración;
// el filtro WHERE estado = 1 se usa más adelante, en el SELECT del
// formulario de consultorios, para no poder asignar un consultorio
// a un doctor dado de baja).
$sql = "SELECT codigo, descripcion, fecha_inicio, fecha_fin
        FROM cliente";

$resultado = $conn->query($sql);

include __DIR__ . '/../includes/header.php';
?>

<div class="container mt-4 alert alert-primary text-center">
    <h2>Listado de Categorías</h2>
</div>

<table class="table table-striped container mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>codigo</th>
            <th>Descripción</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // fetch_assoc() va leyendo fila por fila el resultado (como un cursor).
        // El while repite el bloque de abajo una vez por cada doctor encontrado.
        while ($doc = $resultado->fetch_assoc()):
        ?>
        <tr>
            <!--
                htmlspecialchars() aquí es importante: convierte caracteres como
                < > " ' en su versión segura para HTML (&lt; &gt; etc).
                Sin esto, si alguna vez un nombre trajera algo como
                "<script>alert(1)</script>", se ejecutaría en el navegador
                de quien vea esta tabla (XSS). Siempre se escapa el dato
                justo antes de imprimirlo en HTML, nunca antes de guardarlo.
            -->
            <td><?php echo htmlspecialchars($doc['codigo']); ?></td>
            <td><?php echo htmlspecialchars($doc['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($doc['fecha_inicio']); ?></td>
            <td><?php echo htmlspecialchars($doc['fecha_fin']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
