<?php
include(__DIR__ . '/../../../config/bootstrap.php');

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: /user_dashboard');
    exit();
}

$title = 'Admin Dashboard';
include(__DIR__ . '/../layouts/_header.php');
?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Panel de Administración</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="card mb-3" style="width: 18rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title" >Usuarios</h5>
                                    <p class="card-text">Gestiona los usuarios de la aplicación.</p>
                                    <a href="<?php echo '/admin/users'; ?>" class="btn btn-primary">Ir a
                                        Usuarios</a>
                                </div>
                            </div>




<?php
include(__DIR__ . '/../layouts/_footer.php');