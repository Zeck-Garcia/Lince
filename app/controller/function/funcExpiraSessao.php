<?php

// verificarSessao(5);
// verificarSessao(43200);
verificarSessao(7200);

function verificarSessao($tempoExpiracao) {
    if (isset($_SESSION['inicio_sessao'])) {
        $tempoDecorrido = time() - $_SESSION['inicio_sessao'];

        $_SESSION["tempoExpira"] = $tempoExpiracao;
        $_SESSION["tempoDecorrido"] = $tempoDecorrido;
        if ($tempoDecorrido > $tempoExpiracao) {
            session_unset();
            session_destroy();
            header("Location: login");
            exit();
        } else {
            $_SESSION['inicio_sessao'] = time();
        }
    } else {
        $_SESSION['inicio_sessao'] = time();
    }
}

?>