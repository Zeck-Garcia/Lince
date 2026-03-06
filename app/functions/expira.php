<?php
    function verificarSessaoFixa($tempoMaximo) {
        if (isset($_SESSION['sessao_criada_em'])) {
            $tempoTotalDecorrido = time() - $_SESSION['sessao_criada_em'];
            if ($tempoTotalDecorrido > $tempoMaximo) {
                finalizarSessao();
            }
        } else {
            $_SESSION['sessao_criada_em'] = time();
        }
    }

    function finalizarSessao() {
        session_unset();
        session_destroy();

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            http_response_code(401);
            echo json_encode(['erro' => 'sessao_expirada', 'redirect' => 'login']);
            exit();
        }
        
        // header("Location: login");
        if (headers_sent()) {
            echo "<script>window.location.href='login';</script>";
        } else {
            header("Location: login");
        }
        exit();
    }