<?php
date_default_timezone_set('Europe/Lisbon');
setlocale(LC_ALL, 'pt_PT');

function runRouter($routes) {
    $url = isset($_GET["url"]) ? explode("/", rtrim($_GET["url"], '/')) : ["home"];
    $prefix = $url[0];
    $param = $url[1] ?? ($_GET["param"] ?? "home");

    $classeAtual = $_SESSION['classeAgente'] ?? null;

    $restritos = ["recursoHumano" => 4, "adm" => 1, "encomendas" => 5, "colaborador" => 2, "fornecedor" => 3];

    if (array_key_exists($prefix, $restritos) && $classeAtual != $restritos[$prefix]) {
        if (!headers_sent()) {
            header("Location: " . URL_SITE . "home");
        } else {
            echo "<script>window.location.href='" . URL_SITE . "home';</script>";
        }
        exit;
    }

    if (array_key_exists($prefix, $routes)) {
        $route = $routes[$prefix];
        $file = is_array($route) ? ($route[$param] ?? $routes["page404"]) : $route;

        if (file_exists($file)) {
            require_once $file;
        } else {
            require_once "app/views/pages/pg404.php";
        }
    } else {
        require_once "app/views/pages/pg404.php";
    }
}

$routes = array(
    "home" => [
        "home" => "app/views/pages/pgHome.php",
    ],

    "page404" => "app/views/pages/pg404.php",
    "login" => "app/views/pages/login.php",

    "recursoHumano" => [
        "home" => "app/views/pages/pgBemVindo.php",
        "formacao" => "app/views/pages/pgFormacao.php",
        "calculo-hora" => "app/views/pages/pgCalculoHora.php"
    ],

    "adm" => [
        "home" => "app/views/pages/pgBemVindo.php",
        "utilizadores" => "app/views/pages/pgUltilizadores.php",
        "ordem-compra" => "app/views/pages/pgOrdemCompra.php",
    ],

    "gestorLoja" => [
        "home" => "app/views/pages/pgGestorLoja.php",
    ],

    "api" => [
        "login-process" => "app/controllers/session.php",
        "exit" => "app/functions/funcExit.php",

        "get-load-list-table-formando" => "app/functions/getLoadListTableFormando.php",
        "crud-formando" => "app/functions/crudFormando.php",
        
        //curso
        "get-load-list-table-curso" => "app/functions/getLoadListTableCurso.php",
        "crud-curso" => "app/functions/crudCurso.php",
        
        //local
        "get-load-list-table-local" => "app/functions/getLoadListTableLocal.php",
        "crud-local" => "app/functions/crudLocal.php",
        
        //funcionario
        "get-load-list-table-funcionario" => "app/functions/getLoadListTableFuncionario.php",
        "crud-funcionario" => "app/functions/crudFuncionario.php",
        "search-dados-funcionario" => "app/functions/getSearchDadosFuncionario.php",

        "load-list-loja-slc" => "app/functions/getLoadListLoja.php",
        "load-list-curso-slc" => "app/functions/getLoadListCurso.php",
        "load-list-departamento-slc" => "app/functions/getLoadListDepartamento.php",
        "load-list-cargo-slc" => "app/functions/getLoadListCargo.php",

        "load-list-utilizador" => "app/functions/getLoadListUtilizador.php",
    ],

    "modal" => [
        "modal-confirme" => "app/views/modal/modalConfirme.php",
        //pg formando
        "modal-add-formando" => "app/views/modal/modeloAddFormando.php",
        "modal-add-curso" => "app/views/modal/modalAddCurso.php",
        "modal-add-local" => "app/views/modal/modalAddLocal.php",
        "modal-add-funcionario" => "app/views/modal/modalAddFuncionario.php",

        "modal-utilizador" => "app/views/modal/modalUtilizador.php",
    ],
);

runRouter($routes);
