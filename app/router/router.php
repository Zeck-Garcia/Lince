<?php
date_default_timezone_set('Europe/Lisbon');
setlocale(LC_ALL, 'pt_PT');
    function getRoutePrefix() {
        $url = isset($_GET["url"]) ? explode("/", $_GET["url"]) : ["home"];
        return $url[0];
    }

    $currentPrefix = getRoutePrefix();
     
    //PASSAR TODAS AS SUBMENU PARA JS
    $routes = array(
        "colaborador" => [
            "home" => "app/views/pages/bemVindo.php",
            
            "criarOrdemCompra" => "app/views/pages/pgCriarOrderCompra.php",
            "listarOrdemCompra" => "app/views/pages/pgListarOrderCompra.php",
            "criarUltilizadores" => "app/views/pages/pgCriarUltilizadores.php",
            "listarUltilizadores" => "app/views/pages/pgListarUltilizadores.php",
        ], 
        
        "adm" => [
            "home" => "app/views/pages/bemVindo.php",
            
            "criarOrdemCompra" => "app/views/pages/pgCriarOrderCompra.php",
            "listarOrdemCompra" => "app/views/pages/pgListarOrderCompra.php",
            "criarUltilizadores" => "app/views/pages/pgCriarUltilizadores.php",
            "listarUltilizadores" => "app/views/pages/pgListarUltilizadores.php",

            "cadastarProdutoFornecedorProduto" => "app/views/pages/pgCadastarProdutoFornecedorProduto.php",


            "teste1" => "app/views/pages/modulo/moduloSofa.php",

            "formacao" => "app/views/pages/pgFormacao.php",
        ], 

        "recursoHumano" => [
            "home" => "app/views/pages/bemVindo.php",
            "formacao" => "app/views/pages/pgFormacao.php",
            "criarOrdemCompra" => "app/views/pages/pgCriarOrderCompra.php",
            "listarOrdemCompra" => "app/views/pages/pgListarOrderCompra.php",
        ],

        "aqui" => [
            "home" => "app/views/pages/bemVindo.php",

            "fazerPedidoLoja" => "app/views/pages/pgCriarPedidoLoja.php",
            "verPedidosLoja" => "app/views/pages/pgVerPedidosLoja.php",
            
            "criarOrdemCompra" => "app/views/pages/pgCriarOrderCompra.php",
            "listarOrdemCompra" => "app/views/pages/pgListarOrderCompra.php",
            "criarUltilizadores" => "app/views/pages/pgCriarUltilizadores.php",
            "listarUltilizadores" => "app/views/pages/pgListarUltilizadores.php",
            
            "listarEncomendasLojas" => "app/views/pages/pgListEncomendasLojas.php",
            "listarEncomendasFeitasLojas" => "app/views/pages/pgReverListEncomendasFeita.php",
            "anularDocumentoLoja" => "app/views/pages/pgAnularDocumentoLoja.php",
            "verAnularDocumento" => "app/views/pages/pgVerAnularDocumento.php",
            "removerArtigoEncomenda" => "app/views/pages/pgAnularRemoverArtigoEncomenda.php",

            "transfePendenteAceitar" => "app/views/pages/pgTransfePendentePorAceitar.php",
            "transfeFaltaStock" => "app/views/pages/pgTransfePorFaltaStock.php",
            "alterarPgto" => "app/views/pages/pgAlterarPgto.php",
            "overViewEncomendas" => "app/views/pages/pgOverViewEncomendas.php",
            
            "solicitarFerias" => "app/views/pages/pgSolicitarFerias.php",
            "novoColaborador" => "app/views/pages/pgNovoColaborador.php",
            "criarEscala" => "app/views/pages/pgCriarEscala.php",
        ],

        "page404" => "app/views/pages/pg404.php",
        "login" => "login.php",
    );

    if ($_GET) {
        $url = isset($_GET["url"]) ? explode("/", $_GET["url"]) : ["home"];
        $prefix = $url[0]; 
        $param = $_GET["param"] ?? "home"; 
    
        if (array_key_exists($prefix, $routes)) {
            $route = $routes[$prefix];
    
            if (is_array($route)) {
                require_once $route[$param] ?? $routes["page404"];
            } else {
                require_once $route;
            }
        } else {
            require_once $routes["page404"];
        }
    
        include_once "app/views/pages/rodape.php";
    } else {
        include_once "login.php";
        //include_once "app/views/pages/footer.php";
    }

?>

