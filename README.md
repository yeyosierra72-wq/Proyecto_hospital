# Sistema Hospital — Doctores y Consultorios

Proyecto de práctica con dos formularios (doctor y consultorio), sus
respectivos listados, base de datos relacional con llave foránea,
y una estructura organizada tipo "mini proyecto real".

## Estructura del proyecto

```
proyecto_hospital/
├── config/
│   ├── config.php            # BASE_URL + carga conexion.php y helpers.php
│   ├── conexion.php           # conexión real a la BD (NO se sube a git)
│   └── conexion.example.php   # plantilla de conexión (SÍ se sube a git)
├── includes/
│   ├── header.php             # <head> + apertura de <body> + navbar
│   ├── footer.php              # cierre de <body> + modal de alerta
│   ├── navbar.php              # menú de navegación
│   └── helpers.php             # funciones reutilizables (limpiar, redirigir, alertas)
├── doctor/
│   ├── formulario.php          # alta de doctor
│   ├── guardar.php             # inserta el doctor (prepared statement)
│   └── mostrar.php             # listado de doctores
├── consultorio/
│   ├── formulario.php          # alta de consultorio (select de doctores activos)
│   ├── guardar.php             # inserta el consultorio (prepared statement)
│   └── mostrar.php             # listado de consultorios (INNER JOIN con doctor)
├── database/
│   └── hospital.sql            # script de creación de la BD + datos de ejemplo
├── index.php                   # página de inicio con acceso a las 4 secciones
└── .gitignore
```

## Instalación (XAMPP / Laragon / WAMP)

1. Copia la carpeta `proyecto_hospital` dentro de tu carpeta de servidor
   (`htdocs` en XAMPP, `www` en Laragon).
2. Importa la base de datos:
   - Abre phpMyAdmin y ejecuta el contenido de `database/hospital.sql`, **o**
   - desde consola: `mysql -u root -p < database/hospital.sql`
3. Revisa `config/conexion.php`: por defecto usa `root` sin contraseña
   (típico en XAMPP local). Si tu MySQL usa otro usuario/contraseña,
   ajústalos ahí.
4. Revisa `config/config.php`: la constante `BASE_URL` debe coincidir con
   el nombre de la carpeta del proyecto. Si la carpeta se llama distinto,
   cambia esa línea.
5. Abre en el navegador: `http://localhost/proyecto_hospital/`

## Qué cambió respecto a la versión de un solo archivo

- **Prepared statements** (`$conn->prepare()` + `bind_param()`) en vez de
  concatenar variables directo en el SQL → evita SQL Injection.
- **Validación en servidor** en cada `guardar.php`, no solo `required` en
  el HTML (que se puede saltar fácilmente).
- **`json_encode()`** en vez de `echo` directo dentro del `<script>` de
  SweetAlert2 → evita XSS reflejado a través de la URL.
- **`htmlspecialchars()`** al mostrar datos guardados en las tablas → evita
  XSS almacenado si algún dato tuviera código HTML/JS.
- **Estructura por módulo** (`doctor/`, `consultorio/`) con `includes/`
  compartidos → nada de copiar y pegar el mismo bloque de HTML en cada
  archivo (principio DRY).
- **`BASE_URL`** centralizada → los links del menú funcionan igual sin
  importar desde qué carpeta se cargue la página.
- **`conexion.example.php` + `.gitignore`** → patrón real de cómo se
  manejan credenciales en un repositorio de equipo.

## Próximos pasos sugeridos (para seguir creciendo el proyecto)

1. Login con sesiones (`password_hash()` / `password_verify()`) y proteger
   las páginas del formulario detrás de `session_start()` + verificación.
2. Editar y dar de baja lógica (`estado = 0`) en vez de solo insertar.
3. Front controller (`index.php?pagina=...` con whitelist) una vez que
   haya sesiones, para centralizar también la verificación de login.
4. Subir el proyecto a GitHub: inicializar git, confirmar que
   `config/conexion.php` no aparece en `git status` (gracias al
   `.gitignore`), y hacer commits pequeños por módulo
   (`feature/doctor`, `feature/consultorio`).
