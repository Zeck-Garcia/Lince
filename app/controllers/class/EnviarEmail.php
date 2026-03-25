<?php

class EnviarEmail {
    private $db;
    private $configEmail;
    private $app;
    private $anoY;
    private $fornecedor;
    private $utilizador;
    private $orderCompra;

    private $hora;
    private $tempoHora;

    public function __construct()
    {
        $this->db = new manipulacaoDeDados();
        $this->app = new Application();
        $this->configEmail = new ConfigEmail();
        $this->anoY = date("Y");
        $this->fornecedor = new Fornecedor();
        $this->utilizador = new Utilizador();
        $this->orderCompra = new OrdemCompra();

        $this->hora = date("H");

        if($this->hora > 12 && $this->hora < 18){
            $this->tempoHora = "boa tarde, ";
        } else if($this->hora > 18 && $this->hora < 23){
            $this->tempoHora = "boa noite, ";
        } else {
            $this->tempoHora = "bom dia, ";
        }
    }

    /**
     * faz o gerenciamento para onde vai o email
     */
    public function gerirEnvio(array $dados){
        //print_r($dados);
        $dadosJson = json_decode($dados["dados"], true);
        $dadosT = $this->app->limparInputs($dadosJson);
        $action = $dadosT["action"];
        
        switch($action){
            case "externo":
                $result = $this->EmailExterno($dadosT);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;
            case "interno":
                $result = $this->EmailInterno($dadosT);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;
        }
    }

    private function EmailInterno(array $dados){
        switch($dados["destino"]){
            case "emailFornecedor":
                $result = $this->enviarEmailFornecedorAprovacaoOrdemCompra($dados["orderCompra"]);
                
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;

            case "enviarEmailAdminNovaOrder":
                $result = $this->avisarAdminNovaOrderCompra($dados["orderCompra"]);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;

            case "emailAprovaRejeitaSolicitante":
                $result = $this->emailAprovaRejeitaSolicitante($dados["idSolicitante"]);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;
        }
    }

    private function emailAprovaRejeitaSolicitante(int $id){
        $result = $this->utilizador->getUtilizadorById($id);

        $assunto = "Resultado da Ordem de Compra";
            
        $mensagem = "<div style='margin: auto; width: 90%; font-size: 16pt;'>
                        <p>Olá, {$this->tempoHora}</p>

                        <p>Já temos a resposta da sua Ordem de Compra submetida.</p>
                        <p>Aceda o sistema para consulta-la</p>

                        <p>Email automático, não responda a esse email.</p>
                        <p><a href='https://privado.grupofeira.pt/s2e/login'>Lince - ERP Interno</a></p>
                        <br>
                        <h4>Grupo GFeira</h4>
                    </div>";
                    
        $email = str_replace(" ", "", trim($result[0]["email"]));

        $sendEmail = [
            'destinatario' => $email,
            'subject' => $assunto,
            'body' => $mensagem,
        ];
            
        $result = $this->configEmail->enviar($sendEmail);
        
        if ($result) {
            return ["sucesso" => true, "msg" => "Email enviado com sucesso"];
        } else {
            return [
                "sucesso" => false,
                "msg" => "Houve um problema ao enviar o email: " . $result["msg"],
            ];
        }

        return ["sucesso" => true, "msg" => "Email enviado com sucesso"];
    }

    private function enviarEmailFornecedorAprovacaoOrdemCompra(int $dados){
        $orderCompra = $dados;

        $resultOrder = $this->orderCompra->searchOrderCompraById($orderCompra);
        
        if(count($resultOrder) > 0){
            $idUser = $resultOrder[0]["idSolicitante"];

            $resultFornecedor = $this->fornecedor->getDadosFornecedorById($resultOrder[0]["idFornecedor"]);

            if(count($resultFornecedor) > 0){
                $resultDadosUtilizador = $this->utilizador->getUtilizadorById($idUser);
                
                if(count($resultDadosUtilizador) > 0){
                    $resultArquivos = $this->app->searchListArquivo($orderCompra,1);
                    $textAnexo = '';
                    $dir = [];

                    if(count($resultArquivos) > 0){
                        foreach($resultArquivos as $value){
                            $caminho = BASE_PATH . "/public/assets/uploads/orders/";
                            $nomeFile = $value["nomeHash"];
                            $completo = $caminho . $nomeFile;
                            
                            $ext = pathinfo($completo, PATHINFO_EXTENSION);
                            $type = $this->app->getMimeType($ext);

                            $dir[] = [
                                "ContentID" => $value["nomeHash"],
                                "Name" => $value["nomeHash"],
                                "ContentType" => $type,
                                "Content" => base64_encode(file_get_contents($caminho . $nomeFile)),
                            ];

                        }
                        $textAnexo = "<p> Em anexo, envio o orçamento me passado para a vossa análise.</p>";
                    }
        
                    $assunto = "Solicitação de orçamento {$resultOrder[0]["numeroOrcamento"]}";
            
                    $mensagem = "<div style='margin: auto; width: 90%; font-size: 16pt;'>
                                    <p>Olá, {$this->tempoHora}</p>
                                    <p>Espero que esteja bem.</p>
                                    
                                    <p>Gostaria de dar seguimento ao pedido de orçamento <strong>{$resultOrder[0]["numeroOrcamento"]}</strong> solicitado anteriormente.{$textAnexo}</p>

                                    <p>Caso necessite de esclarecimentos adicionais, estou à total disposição através deste e-mail {$resultDadosUtilizador[0]['email']} ou pelo contacto direto.</p>

                                    <p>Fico a aguardar o vosso retorno e agradeço desde já pela atenção.</p>
                                    <p>Melhores cumprimentos,</p>
                                    <p><strong>" . ucfirst($resultDadosUtilizador[0]['nome']) . "</strong></p>
                                    <br>
                                    <h4>Grupo GFeira</h4>
                                </div>";
                                
                    $email = str_replace(" ", "", trim($resultFornecedor[0]["email"]));
            
                    $sendEmail = [
                        'destinatario' => $email,
                        'subject' => $assunto,
                        'body' => $mensagem,
                        "anexos" => $dir
                    ];
                        
                    $result = $this->configEmail->enviar($sendEmail);
                  
                    if ($result) {
                        $resultFinal = $this->confirmEnvioEmailAoFornecedor($orderCompra);

                        if($resultFinal["sucesso"]){
                            return ["sucesso" => true, "msg" => $result["msg"], "result" => $email];
                        }
                        return ["sucesso" => true, "msg" => "Email enviado com sucesso, mas houve um erro ao marcar que o email foi enviado ao fornecedor. Contacte o suporte do sistema"];
                    } else {
                        return [
                            "sucesso" => false,
                            "msg" => "Houve um problema ao enviar o email: " . $result["msg"],
                        ];
                    }
                } else {
                    return ["sucesso" => false, "msg" => "Dados do utilizador não foi encontrado para enviar o email para o fornecedor, consulte os rigisto do utilizador e depois click em enviar email ao fornecedor"];
                }
            } else {
                return ["sucesso" => false, "msg" => "Houve um erro ao tentar localizar os dados do fornecedor, tente atualizar o registo do fornecedor e volte e a página e cleinte em em enviar email ao fornecedor"];
            }
        } else {
            return ["sucesso" => false, "msg" => "Não foi encontrada nenhuma ordem de compra, por isso não podemos enviar o email"];
        }
    }

    private function confirmEnvioEmailAoFornecedor(int $id){
        $select = "UPDATE tbOrderCompra 
                    SET emailEnviadoAoFornecedorOrderCompra=? 
                    WHERE codOrderCompra=?";
        $qry = $this->db->executarSQL($select, [
            1,
            $id
            ]);
        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Finalização com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Houve um erro ao marcar o envio do email ao fornecedor"];
    }

    private function EmailExterno(array $dados){
        $action = $dados["action"];
         if($action == "pin"){
            $dadosSend = [
                "nome" => $dados["nome"],
                "pinNumber" => $dados["pinNumber"],
                "email" => $dados["email"],
            ];
            $result = $this->inicio($dadosSend);

            return [
                    "sucesso" => $result["sucesso"],
                    "msg" => $result["msg"],
                ];
        }
    }

    private function inicio(array $dados){
        $email = $dados["email"];
        $nome = $dados["nome"];

        $assunto = "Recuperação de Acesso - Guepardo Entregas";
        $mensagem = "Texto do email";
        $mensagemAlt = "Mensagem em texto simples";

        $result = $this->configEmail->enviar(
            $email,
            $nome, 
            $assunto,  
            $mensagem,
            $mensagemAlt
        );

        if ($result) {
            return [
                "sucesso" => true,
                "msg" => "Email enviado com sucesso"];
        } else {
            return [
                "sucesso" => false,
                "msg" => $result["msg"],
            ];
        }
    }

    private function avisarAdminNovaOrderCompra(int $idOrder){
        //buscar dados da order para ver para quem foi enviado
        //com os dados pegar o contacto do admin
        //enviar o email
        $resultDadosOrder = $this->orderCompra->searchOrderCompraById($idOrder);
        
        if(count($resultDadosOrder) > 0){
            if($resultDadosOrder[0]["idAdminResponsavel"] == 0){
                return ["sucesso" => false, "msg" => "Como você não escolheu nenhum resposável, não podemos notifica-lo. Não se preocupe, a Ordem será entregue aos resposnáveis na mesma"];
            } else {
                $resultDadosAdm = $this->utilizador->getUtilizadorById($resultDadosOrder[0]["idAdminResponsavel"]);

                if(count($resultDadosAdm) > 0){
                    
                        $dadosSend = [
                            "codOrder" => $idOrder,
                            "prioridade" => $resultDadosOrder[0]["nomeprioridade"],
                            "email" => $resultDadosAdm[0]["email"],
                        ];
    
                        $resultMonteEmail = $this->monteEmailAvisa($dadosSend);
    
                        if($resultMonteEmail){
                            return ["sucesso" => $resultMonteEmail["sucesso"], "msg" => $resultMonteEmail["msg"]];
                        } else {
                            return ["sucesso" => false, "msg" => "Houve um erro ao enviar o email " . $resultMonteEmail["msg"]];
                        }
                } else {
                    //
                    return ["sucesso" => false, "msg" => "Os dados do administrado não foram encontrado"];
                }
            }
        } else {
            return ["sucesso" => false, "msg" => "O administrador para essa Ordem de Compra não foi encontrado"];
        }
    }

    private function monteEmailAvisa(array $dados){
        $assunto = "Nova ordem de compra para aprovação";
            
        $mensagem = "<div style='margin: auto; width: 90%; font-size: 16pt;'>
                        <p>Olá, {$this->tempoHora}</p>
                        
                        <p>Você tem a Ordem de Compra <strong>{$dados['codOrder']}</strong> para verificar</p>

                        <p>A Ordem de Compra foi Classificada com prioridade <strong>{$dados['prioridade']}</strong></p>

                        <p>Não hesite em ver a Ordem de Compra</p>
                        <p>Melhores cumprimentos,</p>
                        <p>Email automático, não responda a esse email.</p>
                        <p><a href='https://privado.grupofeira.pt/s2e/login'>Lince - ERP Interno</a></p>
                        <br>
                        <h4>Grupo GFeira</h4>
                    </div>";
                    
        $email = str_replace(" ", "", trim($dados["email"]));

        $sendEmail = [
            'destinatario' => $email,
            'subject' => $assunto,
            'body' => $mensagem,
        ];
            
        $result = $this->configEmail->enviar($sendEmail);
        
        if ($result) {
            return ["sucesso" => true, "msg" => "O admistrador já foi contacto sobre a usa Ordem de Compra."];
        } else {
            return [
                "sucesso" => false,
                "msg" => "Houve um problema ao enviar o email: " . $result["msg"],
            ];
        }
    }

}
