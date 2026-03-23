<?php
    require_once __DIR__ . '/ConfigEmail.php';

class EnviarEmail {
    private $db;
    private $configEmail;
    private $app;
    private $anoY;
    private $fornecedor;
    private $utilizador;
    private $orderCompra;

    public function __construct()
    {
        $this->db = new manipulacaoDeDados();
        $this->app = new Application();
        $this->configEmail = new configEmail();
        $this->anoY = date("Y");
        $this->fornecedor = new Fornecedor();
        $this->utilizador = new Utilizador();
        $this->orderCompra = new OrdemCompra();
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
        }
    }

    private function enviarEmailFornecedorAprovacaoOrdemCompra(int $dados){
        
        $orderCompra = $dados;

        $hora = date("H");
        $tempoHora = '';
        if($hora > 12 && $hora < 18){
            $tempoHora = "boa tarde, ";
        } else if($hora > 18 && $hora < 23){
            $tempoHora = "boa noite, ";
        } else {
            $tempoHora = "bom dia, ";
        }

        $resultOrder = $this->orderCompra->searchOrderCompraById($orderCompra);
        
        if(count($resultOrder) > 0){
            $idUser = $resultOrder[0]["idSolicitante"];

            $resultFornecedor = $this->fornecedor->getDadosFornecedorById($resultOrder[0]["idFornecedor"]);

            if(count($resultFornecedor) > 0){
                $resultDadosUtilizador = $this->utilizador->getUtilizadorById($idUser);
                
                if(count($resultDadosUtilizador) > 0){
                    $resultArquivos = $this->app->searchListArquivo($orderCompra);
                    $textAnexo = '';
                    $dir = [];
                    if(count($resultArquivos) > 0){
                        foreach($resultArquivos as $value){
                            $dir[] = "public/assets/uploads/orders/" . $value["nomeHash"];
        
                        }
                        $textAnexo = "<p> Em anexo, envio o orçamento me passado para a vossa análise.</p>";
                    }
        
                    $assunto = "Solicitação de orçamento {$resultOrder[0]["numeroOrcamento"]}";
            
                    $mensagem = "<div style='margin: auto; width: 90%; font-size: 16pt;'>
                                    <p>Olá, {$tempoHora}</p>
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
            
                    $nomeCompleto = "";
            
                    $mensagemAlt = "Mensagem em texto simples";
        
                    $result = $this->configEmail->enviar(
                        $email,
                        $nomeCompleto, 
                        $assunto,  
                        $mensagem,
                        $mensagemAlt,
                        $dir,
                    );
                  
                    if ($result) {
                        $resultFinal = $this->confirmEnvioEmailAoFornecedor($orderCompra);

                        if($resultFinal["sucesso"]){
                            return ["sucesso" => true, "msg" => "Email enviado com sucesso", "result" => $email];
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
}
