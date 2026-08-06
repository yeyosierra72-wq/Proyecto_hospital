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
    <a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php">software</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuPrincipal">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('proyecto', 'formulario.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>proyecto/formulario.php">Nuevo proyecto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('proyecto', 'mostrar.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>proyecto/mostrar.php">Ver proyectos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('cliente', 'formulario.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>cliente/formulario.php">Nuevo cliente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('cliente', 'mostrar.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>cliente/mostrar.php">Ver clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('proveedor', 'formulario.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>proveedor/formulario.php">Crear proveedors</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('proveedor', 'mostrar.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>proveedor/mostrar.php">Ver proveedors</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('categoria', 'formulario.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>categoria/formulario.php">Crear categorias</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('categoria', 'mostrar.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>categoria/mostrar.php">Ver categorias</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('medicamentos', 'formulario.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>medicamentos/formulario.php">Crear medicamentos</a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link <?php echo esActivo('medicamentos', 'mostrar.php', $carpetaActual, $archivoActual); ?>"
             href="<?php echo BASE_URL; ?>medicamentos/mostrar.php">Ver medicamentos</a>
        </li>






      </ul>
    </div>
  </div>
</nav>
