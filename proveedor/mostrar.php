<?php
require_once __DIR__ . '/../config/config.php';
$titulo = 'Listado de proveedores';

// Consulta simple: traemos todos los doctores, activos e inactivos.
// (No filtramos por estado aquí porque esta vista es de administración;
// el filtro WHERE estado = 1 se usa más adelante, en el SELECT del
// formulario de consultorios, para no poder asignar un consultorio
// a un doctor dado de baja).
$sql = "SELECT pk_proveedor, nombre, telefono
        FROM proveedor
        ORDER BY nombre ASC";

$resultado = $conn->query($sql);

include __DIR__ . '/../includes/header.php';
?>

<div class="container mt-4 alert alert-primary text-center">
    <h2>Listado de Proveedores</h2>
</div>

<table class="table table-striped container mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
          
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
            <td><?php echo htmlspecialchars($doc['pk_proveedor']); ?></td>
            <td><?php echo htmlspecialchars($doc['nombre']); ?></td>
            <td><?php echo htmlspecialchars($doc['telefono']); ?></td>
            
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
