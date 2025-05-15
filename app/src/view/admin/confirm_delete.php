<?php
// Establecer el título antes de incluir el header
global $userData;
$title = 'Confirmar Eliminación';
$isAdminPage = true;

include(__DIR__ . '/../layouts/_header.php');
?>

<div class="admin-panel">
    <div class="admin-content">
        <div class="admin-section">
            <div class="confirm-delete">
                <h2>Confirmar eliminación</h2>
                <p>¿Estás seguro de que deseas eliminar al usuario <strong><?= htmlspecialchars($userData['name']) ?></strong>?</p>
                <p class="warning">Esta acción no se puede deshacer.</p>
                
                <form method="POST">
                    <div class="confirm-actions">
                        <input type="hidden" name="confirm_delete" value="yes">
                        <button type="submit" class="admin-btn delete-btn">Sí, eliminar usuario</button>
                        <a href="/admin_dashboard" class="admin-btn cancel-btn">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . '/../layouts/_footer.php'); ?>
