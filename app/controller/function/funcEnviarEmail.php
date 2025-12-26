<?php
    include_once "../../../app/models/manipulacaoDeDados.php";
    $operation = new manipulacaoDeDados();

    //email
    require_once 'funcConfigEmail.php';
    $emailSender = new EmailSender();

    $retornoOrcamentoSet = filter_input(INPUT_POST, "retornoOrcamentoSet");
    $actionSet = filter_input(INPUT_POST, "actionSet");
    $numberOrderCompraSet = filter_input(INPUT_POST, "numberOrderCompraSet");

    $param = [];

    $selectEnviarEmail = "SELECT tbFornecedor.emailFornecedor, tbOrderCompra.numeroOrcamentoOrderCompra, tbUser.emailUser , tbOrderCompra.aprovadoRejeitadoOrderCompra, tbOrderCompra.enviarEmailOrderCompra, tbUser.nomeUser, tbOrderCompra.textoAprovadorOrderCompra 
                        
                        FROM tbOrderCompra

                        LEFT JOIN tbFornecedor
                        ON tbFornecedor.idFornecedor = tbOrderCompra.idFornecedorOrderCompra

                        LEFT JOIN tbUser
                        ON tbUser.idUser = tbOrderCompra.idSolicitanteOrderCompra

                        WHERE codOrderCompra = ? LIMIT 1";

    $type = "s";
    $param[] = $numberOrderCompraSet;

    $qryEnviarEmail = $operation->executarSQL($selectEnviarEmail, $type, $param);

    if(mysqli_num_rows($qryEnviarEmail) > 0){
       $dadosEmail = $operation->listar($qryEnviarEmail);
    }
    
    switch($actionSet){
        case "solicitarOrcamento":
            $cama = ""; 

            $pastaAnexo = "../../views/pages/anexoOrderCompraEmail/";

            if(is_dir($pastaAnexo)){
                $files = scandir($pastaAnexo);
                $files = array_diff($files, array(".",".."));
                
                foreach($files as $key => $value){
                    if (preg_match("/^" . preg_quote($numberOrderCompraSet, '/') . "(\.|_|-|\s|$)/", $value)) {
                        $cama = $value;
                    }
                }
            }

            $textAnexo = ($cama == "" ? "" : "<p>Conforme conversado anteriomente, segue em anexo o documento do orcamento que me foi enviado.</p>" );

            $assunto = "Solicitação de orçamento";
    
            $mensagem = "<div style='margin: auto; width: 90%; font-size: 16pt;'>
                            <h2>Olá,tudo bem?</h2>
                            <p>Venho através desse email, dar andamento no pedido de orçamento <strong>{$dadosEmail[0]['numeroOrcamentoOrderCompra']}</strong></p>
                            {$textAnexo}
                            <p>Qualquer dúvida estou a disposição para mais esclarecimento através do email: {$dadosEmail[0]['emailUser']}</p>
                            <p>Aguardo retorno e agradeço desde já pela atenção.</p>
                            <p>Att: {$dadosEmail[0]['nomeUser']}</p>
        
                            <h4>Grupo GFeira</h4>
                        </div>";
                        
            $email = $dadosEmail[0]["emailFornecedor"];
    
            $nomeCompleto = "";
    
            $mensagemAlt = "Mensagem em texto simples";

            $caminhoBaseDoProjeto = dirname(__DIR__, 2);
            $caminhoAnexo = $caminhoBaseDoProjeto . '/views/pages/anexoOrderCompraEmail/' . $cama;
            $nomeAnexoNoEmail = "Orcamento_" . $cama;

            if ($cama == null || !file_exists($caminhoAnexo) || !is_readable($caminhoAnexo)) {
                $caminhoAnexo = null;
                $nomeAnexoNoEmail = null;
            }

            $resultado = $emailSender->enviar(
                $email,
                $nomeCompleto, 
                mb_convert_encoding($assunto, 'ISO-8859-1', 'UTF-8'),  
                mb_convert_encoding($mensagem, 'ISO-8859-1', 'UTF-8'),
                $mensagemAlt,
                $caminhoAnexo,
                $nomeAnexoNoEmail
            );

            $operation->setTabela("tbOrderCompra");
            $operation->setCampos("emailEnviadoAoFornecedorOrderCompra");
            
            $operation->setValorNaTabela("codOrderCompra");
            $operation->setValorPesquisa($numberOrderCompraSet);
            $operation->setTipoValorPesquisa("s");

            $operation->setTypes("i");
            $operation->setParams([1]);

            $operation->alterar();
        break;
    }

    switch($retornoOrcamentoSet){
        case "avisarSolicitante":
            $assunto = "Solicitação de orçamento " . $numberOrderCompraSet;
    
            if($dadosEmail[0]['aprovadoRejeitadoOrderCompra'] == 1){
                $valueAqui = "aprovado";
                if($dadosEmail[0]['enviarEmailOrderCompra'] == 1){
                    $valueAli = "Já foi enviado para o fornecedor um email solicitando conclusão do orçamento.";
                } else {
                    $valueAli = "O fornecedor não sabe que o orçamento foi aprovado, então contacte o fornecedor para conlcuir o orçamento." . "<br><strong>Texto da aprovação:</strong>" . $dadosEmail[0]['textoAprovadorOrderCompra'];
                }
            } else {
                $valueAqui = "rejeitado";
                $valueAli = "<strong>Motivo da rejeição:</strong> " . $dadosEmail[0]['textoAprovadorOrderCompra'];
            }

            $mensagem = "<div style='margin: auto; width: 90%; font-size: 16pt;'>
                            <h2>Olá,</h2>
                            <p>O seu orçamento foi {$valueAqui}.</p>
                            <p>{$valueAli}</p>
        
                            <h4>Grupo GFeira</h4>
                        </div>";
                        
            $email = $dadosEmail[0]['emailUser'];
    
            $nomeCompleto = "";
    
            $mensagemAlt = "Mensagem em texto simples";
            $resultado = $emailSender->enviar(
                $email,
                $nomeCompleto, 
                mb_convert_encoding($assunto, 'ISO-8859-1', 'UTF-8'),  
                mb_convert_encoding($mensagem, 'ISO-8859-1', 'UTF-8'),
                $mensagemAlt
            );
        break;
    }

    echo 1;

?>