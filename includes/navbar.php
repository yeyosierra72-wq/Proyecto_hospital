<?php
/**
 * navbar.php
 * -----------
 * Menú de navegación compartido. Se incluye una sola vez desde header.php,
 * así que si mañana se agrega o quita una página del menú, se cambia
 * en UN solo lugar en vez de en cada archivo.
 *
 * Usamos BASE_URL (definida en config.php) para que los links funcionen
 * igual sin importar si la página actual está en /doctor/ o /consultorio/.
 */

// Detectamos la carpeta y el archivo actual para resaltar el link activo del menú.
$carpetaActual  = basename(dirname($_SERVER['PHP_SELF']));
$archivoActual  = basename($_SERVER['PHP_SELF']);

// Pequeña función local para no repetir el mismo if/else cuatro veces abajo.
function esActivo($carpeta, $archivo, $carpetaActual, $archivoActual) {
    return ($carpeta === $carpetaActual && $archivo === $archivoActual) ? 'active' : '';
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php">Hospital</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuPrincipal">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('doctor', 'formulario.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>doctor/formulario.php">Nuevo doctor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('doctor', 'mostrar.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>doctor/mostrar.php">Ver doctores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('consultorio', 'formulario.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>consultorio/formulario.php">Nuevo consultorio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('consultorio', 'mostrar.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>consultorio/mostrar.php">Ver consultorios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('proveedor', 'formulario.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>proveedor/formulario.php">Crear proveedors</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('proveedor', 'mostrar.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>proveedor/mostrar.php">Ver proveedors</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
