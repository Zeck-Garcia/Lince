<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $exit = $_POST['exit'] ?? false;

    if ($exit) {
        $_SESSION = array();

        session_destroy();

        if (ob_get_length()) ob_clean();

        echo "sessao_expirada";
        exit();
    } else {
        echo "erro_acesso_direto";
        exit();
    }
