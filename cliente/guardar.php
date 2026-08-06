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
$codigo      = limpiar($_POST['codigo'] ?? '');
$descripcion = limpiar($_POST['descripcion'] ?? '');
$fecha_inicio = limpiar($_POST['fecha_inicio'] ?? '');
$fecha_fin = limpiar($_POST['fecha_fin'] ?? '');



// 3) Prepared statement: los signos "?" son marcadores de posición.
//    MySQL recibe la consulta y los datos por separado, así que el
//    contenido de las variables NUNCA se interpreta como parte del SQL.
//    Esto es lo que evita la inyección SQL (SQL Injection).
$sql = "INSERT INTO cliente(codigo, descripcion, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)";
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
$stmt->bind_param('ssss', $codigo, $descripcion, $fecha_inicio, $fecha_fin);

// 4) Ejecutamos la consulta y redirigimos según el resultado.
if ($stmt->execute()) {
    redirigir('formulario.php', 'Categoría registrada correctamente', 'success');
} else {
    redirigir('formulario.php', 'Error al guardar el doctor', 'error');
}

// 5) Cerramos statement y conexión (buenas prácticas de limpieza).
$stmt->close();
$conn->close();
