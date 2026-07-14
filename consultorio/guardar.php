<?php
/**
 * guardar.php (consultorio)
 * ---------------------------
 * Recibe los datos del formulario (incluyendo la FK al doctor) y los
 * inserta en la base de datos usando un prepared statement.
 */

require_once __DIR__ . '/../config/config.php';

// 1) Recibimos y limpiamos los datos del formulario.
$fk_doctor = limpiar($_POST['fk_doctor'] ?? '');
$numero    = limpiar($_POST['numero'] ?? '');
$ubicacion = limpiar($_POST['ubicacion'] ?? '');

// 2) Validación básica en el servidor.
// El "required" del HTML se puede saltar fácilmente (herramientas de
// desarrollador del navegador, Postman, curl, etc.), así que SIEMPRE
// se valida también en PHP antes de tocar la base de datos.
if ($fk_doctor === '' || $numero === '' || $ubicacion === '') {
    redirigir('formulario.php', 'Todos los campos son obligatorios', 'error');
}

// Verificamos que fk_doctor sea un número antes de usarlo. Es una defensa
// extra (aunque el prepared statement de abajo ya nos protege de SQL
// Injection), porque además así evitamos mandar basura como fk_doctor
// a la base de datos y toparnos con el error de la llave foránea.
if (!ctype_digit($fk_doctor)) {
    redirigir('formulario.php', 'Doctor inválido', 'error');
}

// 3) Prepared statement: separamos el SQL de los datos.
// La llave foránea (fk_doctor) hace que, si el doctor no existiera,
// MySQL rechace el INSERT por sí solo (integridad referencial).
$sql = "INSERT INTO consultorio (fk_doctor, numero, ubicacion) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    redirigir('formulario.php', 'Error al preparar la consulta', 'error');
}

// bind_param: enlaza las variables PHP a los "?" en el mismo orden del SQL.
// "i" = integer (fk_doctor), "s" = string (numero, ubicacion)
$stmt->bind_param('iss', $fk_doctor, $numero, $ubicacion);

// 4) Ejecutamos y redirigimos según el resultado.
if ($stmt->execute()) {
    redirigir('formulario.php', 'Registro guardado correctamente', 'success');
} else {
    redirigir('formulario.php', 'Error al guardar el registro', 'error');
}

$stmt->close();
$conn->close();
