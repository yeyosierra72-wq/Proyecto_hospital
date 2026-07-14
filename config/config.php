<?php
require_once __DIR__ . '/conexion.php';   // <- esta línea puede estar antes o después, no importa el orden aquí

// BASE_URL: ruta base del proyecto dentro del servidor.
// En vez de escribirla a mano, la calculamos automáticamente comparando
// dónde vive el proyecto contra la raíz que Apache está sirviendo
// ($_SERVER['DOCUMENT_ROOT']). Así funciona sin importar el nombre de
// la carpeta, si tiene espacios, o cuántos niveles tenga.
$raizProyecto = str_replace('\\', '/', dirname(__DIR__));
$raizServidor = str_replace('\\', '/', rtrim($_SERVER['DOCUMENT_ROOT'], '/\\'));
$rutaRelativa = str_replace($raizServidor, '', $raizProyecto);

define('BASE_URL', $rutaRelativa . '/');

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../includes/helpers.php';