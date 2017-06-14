<?php
    session_start();
    $sessionDestroyed = session_destroy();

    if ($sessionDestroyed) {
        header("Location: login.php");
    }
?>
