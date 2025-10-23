<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    require_once 'funcConfigEmail.php';
    $emailSender = new EmailSender();

    $dateAtual = date("d/m/Y");
    $dateAnterior = date("Y-m-d", strtotime('-1 days'));
    
    $type = "s";
    $param = [$dateAnterior];
    $select = "SELECT codOrderCompra FROM tbOrderCompra WHERE dataCriacaoOrderCompra = ? AND aprovadoRejeitadoOrderCompra IS NULL";

    $qry = $operation->executarSQL($select, $type, $param);

    $list = [];
    if($qry->num_rows > 0){
        $dados = $operation->listar($qry);

        foreach($dados as $value){
            $list[] = $value;
        }
    }

    if(count($list) > 0){

        $selecEnviar = "SELECT emailUser FROM tbUser WHERE ativoUser = 1 AND classeUser = 1 AND receberEmailUser = 1";

        $qryEnviar = $operation->executarSQL($selecEnviar);

        if($qryEnviar->num_rows > 0){
            $dadosEnviar = $operation->listar($qryEnviar);

            foreach($dadosEnviar as $valueEnviar){
                $assunto = "Nova ordem de compra para aprovação " . $dateAtual;
                $qtd = count($list);
                $head = "<div style='margin: auto; width: 90%; font-size: 16pt;'>
                                <h2>Olá,</h2>
                                <p>Hoje você tem {$qtd} Ordem de Compra para aprovação.</p>";
                $x = [];
                foreach($list as $valueList){
                    foreach($valueList as $a){
                        $x[] = $a;    
                    }
                }

                $body = implode(", ", $x);
                
                $bottom = "<h4>Grupo GFeira</h4>
                            </div>";

                $mensagem = $head . $body . $bottom;
                            
                $email = $valueEnviar["emailUser"];
            
                $nomeCompleto = "";
            
                $mensagemAlt = "Mensagem em texto simples";
                $resultado = $emailSender->enviar(
                    $email,
                    $nomeCompleto, 
                    mb_convert_encoding($assunto, 'ISO-8859-1', 'UTF-8'),  
                    mb_convert_encoding($mensagem, 'ISO-8859-1', 'UTF-8'),
                    $mensagemAlt
                );
            }
        }
    }

?>