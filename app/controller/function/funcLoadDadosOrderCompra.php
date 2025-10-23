<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

$numberOrderCompraSet = filter_input(INPUT_POST, "numberOrderCompraSet");

$selectDadosOrder = "SELECT nomeUser, nomeFornecedor, siteFornecedor, ativoFornecedor, emailFornecedor, codOrderCompra, dataCriacaoOrderCompra, prioridadeOrderCompra, idSolicitanteOrderCompra, idFornecedorOrderCompra, valorNotaOrderCompra, descricaoItemOrderCompra, descricaoOrderOrderCompra, enviarEmailOrderCompra, dataAprovacaoOrderCompra, idAprovadorOrderCompra, textoAprovadorOrderCompra, aprovadoRejeitadoOrderCompra, numeroOrcamentoOrderCompra
                    FROM tbOrderCompra
                    LEFT JOIN tbFornecedor ON tbFornecedor.idFornecedor = tbOrderCompra.idFornecedorOrderCompra
                    LEFT JOIN tbUser ON tbUser.idUser = tbOrderCompra.idSolicitanteOrderCompra
                    WHERE codOrderCompra = ? LIMIT 1";

try {

    $param = [];

    $type = "s";
    $param[] = $numberOrderCompraSet;
    $qryDadosOrder = $operation->executarSQL($selectDadosOrder, $type, $param);
    $dadosOrder = $operation->listar($qryDadosOrder);

    if($dadosOrder[0]['aprovadoRejeitadoOrderCompra'] == ""){

    } elseif($dadosOrder[0]['aprovadoRejeitadoOrderCompra'] == 1){
        echo "<div class='quadroAleatorioNoTitle groupBtn mb-3'>";
        echo "<span class='w-100 actionFinal' style='background-color: #198754;'>Aprovado</span>";
        echo "</div>";
    } else {
        echo "<div class='quadroAleatorioNoTitle groupBtn mb-3'>";
        echo "<span class='w-100 actionFinal' style='background-color: #dc3545;'>Rejeitado</span>";
        echo "</div>";
    }

    if ($dadosOrder) {
           echo "<div class='quadroAleatorio'>
                <div class='quadroAleatorioTitle'>
                    <i class='bi bi-person'></i>
                    <p>Dados do solicitante</p>
                    <span></span>
                </div>

                <div class='quadroAleatorioCorpo'>
                    <div class='borderDash mt-3'>
                        <span>Nome</span>
                        <h3>" . $dadosOrder[0]['nomeUser'] . "</h3>
                    </div>
                    
                    <div class='row1'>
                        <div class='borderDash mt-3 w-100'>
                            <span>Data</span>
                            <h3>" .(new dateTime( $dadosOrder[0]['dataCriacaoOrderCompra']))->format("d/m/Y") . "</h3>
                        </div>
                        
                        <div class='borderDash mt-3'>
                            <span>Prioridade</span>
                            <h3>";
                                switch($dadosOrder[0]['prioridadeOrderCompra']){
                                    case 1:
                                        echo "Baixa";
                                    break;

                                    case 2:
                                        echo "Média";
                                    break;

                                    case 3:
                                        echo "Alta";
                                    break;
                                } 
                            echo "</h3>
                        </div>
                    </div>
                </div>
            </div>";

            echo "<div class='quadroAleatorio'>
                <div class='quadroAleatorioTitle'>
                    <i class='bi bi-building'></i>
                    <p>Dados da empresa</p>
                    <span></span>
                </div>
    
                <div class='quadroAleatorioCorpo'>
                    <div class='row1'>
                        <div class='borderDash mt-3'>
                            <span>Nº</span>
                            <h3 id='numberOrderCompra'>{$dadosOrder[0]['codOrderCompra']}</h3>
                        </div>
                        
                        <div class='borderDash mt-3 w-100'>
                            <span>Nome</span>
                            <h3>" . $dadosOrder[0]['nomeFornecedor'] . "</h3>
                        </div>
                    </div>";

                    if(!str_starts_with($dadosOrder[0]['siteFornecedor'], "http://") && !str_starts_with($dadosOrder[0]['siteFornecedor'], "https://")){
                        $urlFinal = "https://" . $dadosOrder[0]['siteFornecedor'];
                    } else{
                        $urlFinal = $dadosOrder[0]['siteFornecedor'];
                    }
                    
                    echo "<div class='borderDash mt-3'>
                        <span>Site</span>
                        <h3><a href='{$urlFinal}' target='_blank'>{$urlFinal}</a></h3>
                    </div>
                </div>
            </div>";
    
            echo "<div class='quadroAleatorio'>";
                echo "<div class='quadroAleatorioTitle'>
                    <i class='bi bi-journal-check'></i>
                    <p>Dados da nota</p>
                    <span></span>
                </div>";
    
                echo "<div class='quadroAleatorioCorpo'>";
                    echo "<div class='row1'>
                        <div class='borderDash mt-3'>
                            <span>Valor da nota</span>
                            <h3>" . $dadosOrder[0]['valorNotaOrderCompra'] . "</h3>
                        </div>";

                        echo "<div class='borderDash mt-3'>
                            <span>Número do orçamento</span>
                            <h3>" . $dadosOrder[0]['numeroOrcamentoOrderCompra'] . "</h3>
                        </div>";

                        $pastaAnexoOrcamento = "../../views/pages/anexoOrderCompraEmail/";
                        
                        if(is_dir($pastaAnexoOrcamento)){
                            $files = scandir($pastaAnexoOrcamento);
                            $files = array_diff($files, array(".",".."));
                            
                            foreach($files as $key => $value){
                                if (preg_match("/^" . preg_quote($dadosOrder[0]['codOrderCompra'], '/') . "(\.|_|-|\s|$)/", $value)) {
                                    $nomeAruivo = $value;
                                }
                            }
                        }

                        if($nomeAruivo != ""){
                            echo "<div id='flOrcamento' class='borderDash mt-3'>
                                <span>Arquivo do orçamento</span>
                                <h3 id='divArquivo'><i class='bi bi-paperclip'></i><span>{$nomeAruivo}</span></h3>
                            </div>";
                        }
                    echo "</div>
                    
                    <div class='borderDash mt-3'>
                        <span>Detalhe do item</span>
                        <h3>" . $dadosOrder[0]['descricaoItemOrderCompra'] . "</h3>
                    </div>";
                    
                    $textoInicial = $dadosOrder[0]['descricaoOrderOrderCompra'];

                    $pattern = '/\b(?:https?:\/\/|www\.)?[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,6}(?:\/[^\s]*)?\b/i';

                    $textoFinal = preg_replace_callback($pattern, function($matches) {
                        $urlEncontrada = $matches[0];

                        $urlFeita = $urlEncontrada;
                        if (!str_starts_with($urlEncontrada, "http://") && !str_starts_with($urlEncontrada, "https://")) {
                            $urlFeita = "https://" . $urlEncontrada;
                        }

                        return '<a href="' . htmlspecialchars($urlFeita) . '" target="_blank">' . htmlspecialchars($urlEncontrada) . '</a>';
                    }, $textoInicial);

                    echo "<div class='borderDash mt-3'>
                        <span>Descrição da compra</span>
                        <h3>" . $textoFinal . "</h3>
                    </div>
                </div>
            </div>";
    
            echo "<div class='quadroAleatorio'>
                <div class='quadroAleatorioTitle'>
                    <i class='bi bi-file-earmark-zip'></i>
                    <p>Anexo complementares</p>
                    <span></span>
                </div>";

                echo "<div class='quadroAleatorioCorpo'>
                    <div class='borderDash d-flex gap-3'>";
                        $pastaImgEntrega = "../../views/pages/anexoOrderCompra/";
                        
                        if(is_dir($pastaImgEntrega)){
                            $files = scandir($pastaImgEntrega);
                            $files = array_diff($files, array(".",".."));
                            
                            foreach($files as $key => $value){
                                // $ext = pathinfo($value, PATHINFO_EXTENSION);

                                if (preg_match("/^" . preg_quote($dadosOrder[0]['codOrderCompra'], '/') . "(\.|_|-|\s|$)/", $value)) {
                                    echo "<div class='anexoGroup'>
                                        <span><i class='bi bi-file-word'></i></span>
                                        <h5 class='titleFile'>{$value}</h5>
                                    </div>";
                                }
                            }
                        }
                    echo "</div>
                </div>";

            echo "</div>";

            if($dadosOrder[0]['dataAprovacaoOrderCompra'] != ""){
                echo "<div class='quadroAleatorio'>
                    <div class='quadroAleatorioTitle'>
                        <i class='bi bi-journal-check'></i>
                        <p>Dados da autorização</p>
                        <span></span>
                    </div>
        
                    <div class='quadroAleatorioCorpo'>
                        <div class='row1'>
                            <div class='borderDash mt-3 w-100'>
                                <span>" . ($dadosOrder[0]['aprovadoRejeitadoOrderCompra'] == 1 ? "Aprovado em" : "Rejeitado em") . "</span>
                                <h3>" . ((new dateTime($dadosOrder[0]['dataAprovacaoOrderCompra'])))->format("d/m/Y") . "</h3>
                            </div>
                            
                            <div class='borderDash mt-3 w-100'>
                                <span>Por:</span>
                                <h3>" . ucfirst($dadosOrder[0]['nomeUser']) . "</h3>
                            </div>
                        </div>
                        
                        <div class='borderDash mt-3'>
                            <span>Observação</span>
                            <h3>{$dadosOrder[0]['textoAprovadorOrderCompra']}</h3>
                        </div>
                    </div>
                </div>";
            }
    
            if(in_array($_SESSION["classeAgente"], [1])){
                if($dadosOrder[0]['aprovadoRejeitadoOrderCompra'] == ""){
                    echo "<div class='quadroAleatorioNoTitle groupBtn '>";
                    echo "<input type='button' id='btnRejeitar' class='btn btn-outline-danger w-100' value='Rejeitar'>";
                    echo "<input type='button' id='btnAprovar' class='btn btn-success w-100' value='Aprovar'>";
                    echo "</div>";
                }
            }
    } else {
        echo "Nenhum resultado encontrado.";
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}

?>