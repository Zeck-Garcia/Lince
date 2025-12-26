<?php

include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    header("Content-Type: application/json");

    $peridoMesSet = filter_input(INPUT_POST, "periodoMesSet");

    switch($servicoSet){
        case 0:
            $servicoValue = " AND tbProtec.servicoFeitoProtec IS NULL";
        break;

        case 1:
            $servicoValue = " AND tbProtec.servicoFeitoProtec IS NOT NULL";
        break;

        default:
            $servicoValue = "";
        break;
    }

    foreach($listClient as $codCliente){
        $selectLoadTable = "SELECT tbProtec.pedidoProtec, tbProtec.valorProtec, tbProtec.dataCompraProtec, tbProtec.servicoFeitoProtec, tbProtec.idProtec, tbCliente.NomeCliente, tbCliente.codClienteCliente, tbLojas.codLojas, tbLojas.nomeLojas, tbNomeServico.codNomeServico, tbNomeServico.nomeNomeServico, tbLogin.nomeCompletoLogin

        FROM tbProtec 

        LEFT JOIN tbCliente
        ON tbCliente.codClienteCliente = tbProtec.codClienteProtec

        LEFT JOIN tbLojas
        ON tbLojas.codLojas = tbProtec.lojaProtec

        LEFT JOIN tbNomeServico
        ON tbNomeServico.idNomeServico = tbProtec.codProduto

        LEFT JOIN tbLogin
        ON tbLogin.idLogin = tbProtec.feitoPorProtec

        WHERE codClienteProtec = '" . $codCliente['codClienteCliente'] . "'

        ORDER BY dataCompraProtec ASC";
        
        $qryLoadTable = $operation->executarSQL($selectLoadTable);
        
        if(mysqli_num_rows($qryLoadTable) > 0){
            while($dados = $operation->listar($qryLoadTable)){
                $dadosPlanilha[] = [
                    "cod loja" => $dados["codLojas"],
                    "Loja" => $dados["nomeLojas"],
                    "cod Cliente" => $dados["codClienteCliente"],
                    "nome Cliente" => $dados["NomeCliente"],
                    "Pedido" => $dados["pedidoProtec"],
                    "Data compra" => (new DateTime($dados["dataCompraProtec"]))->format("d/m/Y"),
                    "Cod produto" => $dados["codNomeServico"],
                    "Descrição produto" => $dados["nomeNomeServico"],
                    "Valor" => $dados["valorProtec"],
                    "Data servico" => ($dados["servicoFeitoProtec"] == "" ? "" : (new DateTime($dados["servicoFeitoProtec"]))->format("d/m/Y")),
                    "Feito por" => $dados["nomeCompletoLogin"],
                ];
            }
        } else {
            $dadosPlanilha = [];
        }

    }

    // Empresa sempre 1
    // Tienda //distiral fica com o codigo da loja senao fica com 17
    // Ref. Pedido
    // Pedido //1042
    // Fecha //pegar a data atual dd-mm-yyyy
    // FechaServ //pegar a data atual dd-mm-yyyy
    // Observación
    // Cliente pedido de estoque sempre 0
    // Nombre Cli
    // Dirección
    // Cod. Postal
    // Población
    // Cod. País
    // Teléfono
    // Email
    // Línea //seguencia numerica de 1 até a ultima linha
    // Artículo //codigo do produto
    // Descripción
    // Descripción2
    // Descripción3
    // Cantidad //qtd de item pedido
    // Dto1
    // Dto2
    // Dto3
    // Dto4
    // Precio
    // Fecha Alta
    // Serie Pedido
    // Dirección Envío
    // Confirmado //sempre S
    // Usuario
    // Dni/Cif
    // Forma Pago
    // Direnv Nombre
    // Direnv Dirección
    // Direnv Cpostal
    // Direnv Población
    // Direnv Cpais
    // Direnv Telefono
    // Direnv Email
    // Tipo Entrega
    // Tipo Entrega Linea
    // Importe cobro
    // Tipo Pago 
    // Precio Coste
    // Vendedor
    // Cant. Pedido Prov
    // RefPed Prov
    // Fecha PedProv
    // Recibir
    // Fecha Recepción
    // Entregar
    // Fecha Entrega
    // Almacén //armazem de destino da loja que ira receber
    // Pedido Web
    // Situación Pedido
    // Refped Lin
    // Proveedor
    // Descripción Proveedor
    // Descripcion 2 Proveedor
    // Fecha Cobro




    echo json_encode($dadosPlanilha);
?>