<?php

class EnviarMsgSMS{
    private $app;
    private $configSms;
    private $orderCompra;
    private $utilizador;

    public function __construct()
    {
        $this->configSms = new ConfigMsgSMS();
        $this->app = new Application();
        $this->orderCompra = new OrdemCompra();
        $this->utilizador = new Utilizador();
    }

    public function gerirEnvio(array $dados){
        $jsonDados = json_decode($dados["dados"], true);

        $dadosT = $this->app->limparInputs($jsonDados);

        switch($dadosT["action"]){
            case "externo":
                break;
            case "interno":
                $result = $this->interno($dadosT);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;
        }
    }

    private function interno(array $dados){
        switch($dados["destino"]){
            case "enviarEmailAdminNovaOrder":
                $dadosSend = [
                    "codOrder" => $dados["orderCompra"],
                ];
                $result = $this->avisarAdminNovaOrderCompra($dadosSend);

                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;
        }
    }

    private function avisarAdminNovaOrderCompra(array $dados){
        $resultOrder = $this->orderCompra->searchOrderCompraById($dados["codOrder"]);

        if($resultOrder[0]["idAdminResponsavel"] == 0){
            return ["sucesso" => false, "msg" => "Como você não escolheu nenhum resposável, não podemos notifica-lo. Não se preocupe, a Ordem será entregue aos resposnáveis na mesma"];
        } else {
            //bucsar os dadso do user
            $resultDadosAdm = $this->utilizador->getUtilizadorById($resultOrder[0]["idAdminResponsavel"]);

            if(count($resultDadosAdm) > 0){
                if($resultDadosAdm[0]["contacto"] == '' || $resultDadosAdm[0]["contacto"] == null){
                    return ["sucesso" => false, "msg" => "Esse utilizador não deixou salvo o contacto telefônico para ser notificado. A sua Ordem de Compra será finalizada na mesma, apenas o adm não será notificado"];
                } else {
                    $dadosSend = array(
                        "contacto" => $resultDadosAdm[0]["contacto"],
                        "mensagem" => "Voce tem uma nova Ordem de Compra {$dados["codOrder"]}",
                    );
                    
                    $result = $this->configSms->sendSMS($dadosSend);
    
                    if ($result["sucesso"]) {
                        return [
                            "sucesso" => true,
                            "msg" => $result["msg"]];
                    } else {
                        return [
                            "sucesso" => false,
                            "msg" => $result["msg"],
                        ];
                    }
                }
            } else {
                return ["sucesso" => false, "msg" => "Os dados do administrado não foram encontrado para enviar o sms"];
            }
        }
    }
}
