<?php
require_once __DIR__ . '/config/config.php';
$titulo = 'Inicio - Sistema Hospital';
include __DIR__ . '/includes/header.php';
?>

<div class="container mt-5">
    <div class="alert alert-primary text-center">
        <h1>Sistema de Gestión Hospital</h1>
        <p class="mb-0">Proyecto de práctica: doctores y consultorios</p>
    </div>

    <div class="row g-4 mt-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Doctores</h5>
                    <a href="<?php echo BASE_URL; ?>doctor/formulario.php" class="btn btn-primary w-100 mb-2">Registrar doctor</a>
                    <a href="<?php echo BASE_URL; ?>doctor/mostrar.php" class="btn btn-outline-primary w-100">Ver doctores</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Consultorios</h5>
                    <a href="<?php echo BASE_URL; ?>consultorio/formulario.php" class="btn btn-primary w-100 mb-2">Registrar consultorio</a>
                    <a href="<?php echo BASE_URL; ?>consultorio/mostrar.php" class="btn btn-outline-primary w-100">Ver consultorios</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
