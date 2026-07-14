<?php
/**
 * conexion.example.php
 * ----------------------
 * Esta es una PLANTILLA. No se usa directamente en el proyecto.
 *
 * Cómo usarla:
 *   1. Copia este archivo y renómbralo a "conexion.php" (misma carpeta).
 *   2. Llena tus datos reales de conexión ahí.
 *   3. "conexion.php" NUNCA se sube a git (revisa el .gitignore),
 *      así cada quien que clone el proyecto usa sus propias credenciales
 *      sin exponer las tuyas ni pisar las de nadie más.
 */

$servidor    = "localhost";
$usuario     = "tu_usuario";
$contrasena  = "tu_contraseña";
$base_datos  = "hospital";

$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
