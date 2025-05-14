<?php
include(__DIR__ . '/../../../config/bootstrap.php');
include(__DIR__ . '/../../controllers/UserController.php');

// Establecer el título antes de incluir el header
$title = 'Panel de Administración';

// Validación de autorización
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    $_SESSION['message'] = 'No tienes permiso para acceder a esta página.';
    $_SESSION['message_type'] = 'error';
    header('Location: /homepage');
    exit();
}

include(__DIR__ . '/../layouts/_header.php');
?>

<div class="admin-panel">
    <div class="admin-header">
        <h1 class="admin-title">Panel de Administración</h1>
        <p class="admin-welcome">Bienvenido, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Administrador') ?>.</p>
    </div>

    <div class="admin-content">
        <div class="admin-section">
            <div class="section-header">
                <h2 class="section-title">Gestión de Usuarios</h2>
                <div class="section-actions">
                    <button class="btn admin-btn"><i class="fas fa-plus"></i> Nuevo Usuario</button>
                    <button class="btn admin-btn"><i class="fas fa-filter"></i> Filtrar</button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th class="actions-column">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Obtener la lista de usuarios
                        $userController = new UserController();
                        $users = $userController->getAllUsers();
                        foreach ($users as $user) {
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id']) ?></td>
                                <td><?= htmlspecialchars($user['name']) ?></td>
                                <td><?= htmlspecialchars($user['username']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td class="actions-column">
                                    <div class="action-buttons">
                                        <a href="/admin/edit_user.php?id=<?= htmlspecialchars($user['id']) ?>" class="action-btn edit-btn">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <a href="/admin/delete_user.php?id=<?= htmlspecialchars($user['id']) ?>" class="action-btn delete-btn">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <div class="pagination">
                    <span class="pagination-info">Mostrando 1-<?= count($users) ?> de <?= count($users) ?> usuarios</span>
                    <div class="pagination-controls">
                        <button class="pagination-btn" disabled>&laquo;</button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn" disabled>&raquo;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . '/../layouts/_footer.php'); ?>
