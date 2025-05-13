<?php
if (isset($_SESSION['message'])) :
    $alertClass = 'alert-success';

// Sí existe un tipo de mensaje, ajustar la clase correspondiente
    if (isset($_SESSION['message_type'])) {
        if ($_SESSION['message_type'] == 'error') {
            $alertClass = 'alert-error';
        }
    }
    ?>

    <div class="alert <?= $alertClass ?>">
        <?php
        echo htmlspecialchars($_SESSION['message'], ENT_QUOTES);
        ?>
    </div>

    <?php
    unset($_SESSION['message']);
    if (isset($_SESSION['message_type'])) {
        unset($_SESSION['message_type']);
    }

endif;