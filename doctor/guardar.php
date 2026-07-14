<?php
/**
 * guardar.php (doctor)
 * ---------------------
 * Recibe los datos del formulario y los inserta en la base de datos.
 *
 * Cambios clave respecto a la versión original:
 *  1. Se usa un prepared statement en vez de concatenar el SQL a mano
 *     (evita SQL Injection).
 *  2. Se valida en el servidor, no solo se confía en el "required" del HTML.
 *  3. La redirección con mensaje/tipo se centraliza en redirigir()
 *     (helpers.php), en vez de repetir el header() con urlencode en
 *     cada archivo.
 */

require_once __DIR__ . '/../config/config.php';

// 1) Recibimos y limpiamos los datos que llegan del formulario por POST.
//    El operador ?? '' evita un error si por alguna razón el campo no llega.
$nombre       = limpiar($_POST['nombre'] ?? '');
$especialidad = limpiar($_POST['especialidad'] ?? '');
$telefono     = limpiar($_POST['telefono'] ?? '');

// filter_var con FILTER_VALIDATE_EMAIL revisa que el formato sea un email
// válido; si no lo es, devuelve false. Esto es una segunda capa de
// validación además del type="email" del HTML (que se puede saltar).
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);

// 2) Validación en servidor: si algo viene vacío o el email es inválido,
//    regresamos al formulario con un mensaje de error y NO tocamos la BD.
if ($nombre === '' || $especialidad === '' || $telefono === '' || !$email) {
    redirigir('formulario.php', 'Todos los campos son obligatorios y el email debe ser válido', 'error');
}

// 3) Prepared statement: los signos "?" son marcadores de posición.
//    MySQL recibe la consulta y los datos por separado, así que el
//    contenido de las variables NUNCA se interpreta como parte del SQL.
//    Esto es lo que evita la inyección SQL (SQL Injection).
$sql = "INSERT INTO doctor (nombre, especialidad, telefono, email) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    // Si prepare() falla, normalmente es un error de sintaxis SQL nuestro
    // (columna mal escrita, etc.), no del usuario.
    redirigir('formulario.php', 'Error al preparar la consulta', 'error');
}

// bind_param(): enlaza las variables de PHP a los "?" en el mismo orden
// en que aparecen en el SQL. La cadena "ssss" indica el tipo de cada uno:
// s = string, i = integer, d = double, b = blob.
// Aquí los 4 campos son texto, por eso son 4 "s".
$stmt->bind_param('ssss', $nombre, $especialidad, $telefono, $email);

// 4) Ejecutamos la consulta y redirigimos según el resultado.
if ($stmt->execute()) {
    redirigir('formulario.php', 'Doctor registrado correctamente', 'success');
} else {
    redirigir('formulario.php', 'Error al guardar el doctor', 'error');
}

// 5) Cerramos statement y conexión (buenas prácticas de limpieza).
$stmt->close();
$conn->close();
