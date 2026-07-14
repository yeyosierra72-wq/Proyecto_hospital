<?php
/**
 * helpers.php
 * ------------
 * Funciones reutilizables para todo el proyecto.
 * Centralizar esta lógica evita copiar y pegar el mismo código en cada
 * formulario (principio DRY: "Don't Repeat Yourself").
 */

/**
 * Limpia un valor recibido de un formulario.
 * Por ahora solo quita espacios en blanco al inicio/final (trim), pero
 * al estar centralizada, si mañana se necesita limpiar más cosas
 * (por ejemplo quitar etiquetas HTML con strip_tags), se cambia UNA vez
 * aquí y aplica a todo el proyecto.
 */
function limpiar($valor) {
    return trim($valor ?? '');
}

/**
 * Redirige a una página con un mensaje y un tipo de alerta,
 * y termina la ejecución del script (exit).
 *
 * @param string $pagina  archivo al que se redirige, ej. 'formulario.php'
 * @param string $mensaje texto que se mostrará en el modal
 * @param string $tipo    'success' o 'error'
 *
 * urlencode() es indispensable aquí: convierte espacios, acentos y símbolos
 * a su versión segura para URL (el espacio se vuelve %20, por ejemplo).
 * Sin esto, un mensaje con espacios o acentos rompería la URL generada.
 */
function redirigir($pagina, $mensaje, $tipo = 'success') {
    header("Location: {$pagina}?msg=" . urlencode($mensaje) . "&tipo=" . urlencode($tipo));
    exit();
}

/**
 * Imprime el script de SweetAlert2 SOLO si vienen los parámetros
 * ?msg= y ?tipo= en la URL (es decir, si venimos de un redirigir()).
 *
 * OJO CON LA SEGURIDAD:
 * En la versión original, $_GET se imprimía directo dentro del <script> con
 * echo. Eso es una vulnerabilidad de tipo XSS (Cross-Site Scripting):
 * cualquiera podría armar a mano una URL como
 *   formulario.php?msg=');alert(document.cookie);//&tipo=error
 * y ese código JavaScript se ejecutaría en el navegador de quien abra el link.
 *
 * La solución es json_encode(): convierte el texto de PHP en una cadena de
 * JavaScript ya escapada de forma segura (comillas, backslashes, etc.),
 * en vez de pegar el texto tal cual dentro del <script>.
 */
function mostrarAlertaSiExiste() {
    if (isset($_GET['msg'], $_GET['tipo'])) {
        $mensaje = $_GET['msg'];

        // Whitelist: solo aceptamos 'success' como válido, cualquier otro
        // valor que venga en la URL se trata como 'error' por seguridad.
        $tipo   = ($_GET['tipo'] === 'success') ? 'success' : 'error';
        $titulo = ($tipo === 'success') ? 'Éxito' : 'Error';
        ?>
        <script>
        Swal.fire({
            icon: <?php echo json_encode($tipo); ?>,
            title: <?php echo json_encode($titulo); ?>,
            text: <?php echo json_encode($mensaje); ?>,
            showConfirmButton: true,
            timer: 4000
        }).then(() => {
            // Quita ?msg&tipo de la URL cuando el modal se cierra
            history.replaceState(null, '', window.location.pathname);
        });
        // Y también los quita de inmediato: si el usuario refresca la página
        // antes de que el modal se cierre solo, evita que vuelva a aparecer.
        history.replaceState(null, '', window.location.pathname);
        </script>
        <?php
    }
}
