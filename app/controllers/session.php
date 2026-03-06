<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if (ob_get_length()) ob_clean(); 

    $usuario = $_POST['txtLogin'] ?? '';
    $senha   = $_POST['txtSenha'] ?? '';

    if (empty($usuario) || empty($senha)) {
        echo "erro";
        exit;
    }

    $auth = new Auth();
    $dados = $auth->validar($usuario, $senha);

    if ($dados) {
        $_SESSION['idAgente']     = $dados['idUser'];
        $_SESSION['nomeAgente']   = $dados['nomeUser'];
        $_SESSION['classeAgente'] = $dados['classeUser'];
        $_SESSION['logado']       = true;

        $_SESSION['sessao_criada_em'] = time();

        $rotas = [
            1 => "adm",
            2 => "colaborador",
            4 => "recursoHumano",
            5 => "encomendas",
        ];

        $destino = $rotas[$dados['classeUser']] ?? "home";
        echo $destino;
    } else {
        echo "erro";
    }
    exit;
