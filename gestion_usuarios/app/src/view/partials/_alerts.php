<?php if (isset($_SESSION['message'])): ?>
    <div class="alert <?= $_SESSION['message_type'] === 'error' ? 'alert-error' : 'alert-success' ?>">
        <?= htmlspecialchars($_SESSION['message']) ?>
    </div>
    <?php
    // Limpiar los mensajes después de mostrarlos
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
    ?>
<?php endif; ?>
