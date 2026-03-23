<?php

class OrdemCompra{
    private $db;
    private $app;
    private $dataHoje;
    private $fornecedor;

    public function __construct()
    {
        $this->db = new manipulacaoDeDados();
        $this->app = new Application();
        $this->dataHoje = date("Y-m-d");
        //$this->fornecedor = new Fornecedor();
    }

    public function searchOrderCompraById(int $id){
        $param = [];
        $select = "SELECT * 
                FROM tbOrderCompra
                WHERE codOrderCompra=?";
        $param[] = $id;

        $qry = $this->db->buscar($select, $param);
        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "idOrder" => $value["idOrderCompra"],
                    "destinoOrder" => $value["destinoOrderCompra"],
                    "codOrder" => $value["codOrderCompra"],
                    "numeroOrcamento" => $value["numeroOrcamentoOrderCompra"],
                    "dataCriacao" => $value["dataCriacaoOrderCompra"],
                    "Prioridade" => $value["prioridadeOrderCompra"],
                    "idSolicitante" => $value["idSolicitanteOrderCompra"],
                    "classeSolicitante" => $value["classeSolicitanteOrderCompra"],
                    "idFornecedor" => $value["idFornecedorOrderCompra"],
                    "valorNota" => $value["valorNotaOrderCompra"],
                    "descricaoItem" => $value["descricaoItemOrderCompra"],
                    "descricao" => $value["descricaoOrderOrderCompra"],
                    "emailEmail" => $value["enviarEmailOrderCompra"],
                    "emailAposAprovado" => $value["emailEnviadoAoFornecedorOrderCompra"],
                    "dataAprovacao" => $value["dataAprovacaoOrderCompra"],
                    "idProvador" => $value["idAprovadorOrderCompra"],
                    "textoAprovador" => $value["textoAprovadorOrderCompra"],
                    "aprovadoRejeitado" => $value["aprovadoRejeitadoOrderCompra"]
                ];
            }
        }
        return $list;
    }

    public function getLoadListOrdemCompra(array $dados){
        $jsonDados = json_decode($dados["dados"], true);
        
        $dadosT = $this->app->limparInputs($jsonDados);

        $paginaSet = ($dadosT["paginaSet"] == 0 ? 1 : $dadosT["paginaSet"]);
        $limite = 7;
        $inicio = ($paginaSet * $limite) - $limite;
        $param = [];

        $idrOrder = isset($dadosT["idOrder"]) ? $param[] =  $dadosT["idOrder"] : '';
    
        $where = '';
        if(isset($dadosT["idOrder"]) && $dadosT["idOrder"] != ''){
            $where = " AND oc.codOrderCompra = ? ";
        }

        $searchOrderCompra = isset($dadosT["searchOrderCompra"]) ? $dadosT["searchOrderCompra"] : '';
        $slcPedido = isset($dadosT["slcPedido"]) ? $dadosT["slcPedido"] : '';

        $dataInicio = $searchOrderCompra;
        $data = DateTime::createFromFormat("d/m/Y",$searchOrderCompra);

        if($data && $data->format("d/m/Y") == $searchOrderCompra){
            $dataInicio = $data->format("Y-m-d");
        }

        if($searchOrderCompra != ''){
            $where .= " AND (oc.dataCriacaoOrderCompra=? OR pr.nomePrioridade=? OR si.nomeUserDados LIKE ? OR oc.codOrderCompra=?) ";
            // $where .= " AND (oc.idOrderCompra=? OR oc.dataCriacaoOrderCompra=? OR pr.nomePrioridade=? OR si.nomeUserDados LIKE ? OR oc.codOrderCompra=?) ";
            // $param[] = $searchOrderCompra;
            $param[] = $dataInicio;
            $param[] = $searchOrderCompra;
            $param[] = "%".$searchOrderCompra."%";
            $param[] = $searchOrderCompra;
        }

        if($slcPedido != '' && $slcPedido == 1 || $slcPedido == 0 && $searchOrderCompra == ''){
            $where .= " AND oc.aprovadoRejeitadoOrderCompra=? ";
            $param[] = $slcPedido;
        }

        if($slcPedido != '' && $slcPedido == 3 && $searchOrderCompra == ''){
            $where .= " AND oc.aprovadoRejeitadoOrderCompra IS NULL ";
        }

        if($_SESSION["classeAgente"] != 1){
            $where .= " AND idSolicitanteOrderCompra=?";
            $param[] = $_SESSION["idAgente"];
        }

        $select = "WITH result AS (SELECT oc.*, si.nomeUserDados AS nomeSi, si.idUserDados as idSi, si.departamentoUserDados as dpSi, si.cargoUserDados AS cargoSi, si.classeUserDados AS classeSi, si.emailUserDados AS emailSi, siA.*, dp.*, ca.*, cl.*, fo.*, pr.*
                    FROM tbOrderCompra oc 
                    
                    LEFT JOIN tbUserSistema si
                    ON si.idUserDados = oc.idSolicitanteOrderCompra

                    LEFT JOIN tbDepartamento dp
                    ON dp.idDepartamento = si.departamentoUserDados

                    LEFT JOIN tbCargo ca
                    ON ca.idCargo = si.cargoUserDados

                    LEFT JOIN tbClasse cl
                    ON cl.idClasse = oc.classeSolicitanteOrderCompra 
                    
                    LEFT JOIN tbFornecedor fo
                    ON fo.idFornecedor = oc.idFornecedorOrderCompra

                    LEFT JOIN tbPrioridade pr
                    ON pr.codPrioridade = oc.prioridadeOrderCompra

                    LEFT JOIN tbUserSistema siA
                    ON siA.idUserDados = oc.idAprovadorOrderCompra AND siA.classeUserDados = oc.classeAprovadorOrderCompra

                    WHERE 1=1 ";

        $selectWhere = " ORDER BY oc.idOrderCompra DESC)
        SELECT *, (SELECT COUNT(*) FROM result ) AS totalRegistro FROM result ORDER BY idOrderCompra DESC LIMIT " . $inicio . "," . $limite;

        $selectCompleta = $select . $where . $selectWhere;

        $qry = $this->db->buscar($selectCompleta,$param);            

        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $numeroOrder = $value["codOrderCompra"];
                $list[] = [
                    "idOrder" => $value["idOrderCompra"],
                    "destinoOrder" => $value["destinoOrderCompra"],
                    "codOrder" => $value["codOrderCompra"],
                    "numeroOrcamentoOrder" => $value["numeroOrçamentoOrderCompra"],
                    "dataOrder" => $value["dataCriacaoOrderCompra"],
                    "prioriOrder" => $value["prioridadeOrderCompra"],
                    "nomePrioriOrder" => $value["nomePrioridade"],
                    "idSolicitanteOrder" => $value["idSolicitanteOrderCompra"],
                    "classeSolicitanteOrder" => $value["classeSolicitanteOrderCompra"],
                    "idFornecedorOrder" => $value["idFornecedorOrderCompra"],
                    "valorNotaOrder" => $value["valorNotaOrderCompra"],
                    "descricaoItemOrder" => $value["descricaoItemOrderCompra"],
                    "descricaoOrder" => $value["descricaoOrderOrderCompra"],
                    "enviarEmailOrder" => $value["enviarEmailOrderCompra"],
                    "enviarEmailFornecedoOrder" => $value["emailEnviadoAoFornecedorOrderCompra"],
                    "dataAprovacaoOrder" => $value["dataAprovacaoOrderCompra"],
                    "idAprovadorOrder" => $value["idAprovadorOrderCompra"], //pegar o nome
                    "textoAprovadorOrder" => $value["textoAprovadorOrderCompra"],
                    "aprovaRejeitaOrder" => $value["aprovadoRejeitadoOrderCompra"],
                    //colaborador
                    "idUser" => $value["si.idUserDados"],
                    //solicitante
                    // "codColaborador" => $value["codFuncionarioFuncionario"],
                    "nomeUser" => $value["nomeSi"],
                    "departamentoUser" => $value["dpSi"],
                    "cargoUser" => $value["cargoSi"],
                    "classeUser" => $value["classeSi"],
                    "emailUser" => $value["emailSi"],
                    //funcionario
                    "idCargoFuncionario" => $value["cargoFuncionario"],
                    "classeFuncionario" => $value["classeFuncionario"],
                    "ativoFuncionario" => $value["ativoUserDados"],
                    // "recberEmailFuncionario" => $value["receberEmailFuncionario"],
                    // "idLoginFuncionario" => $value["idLoginFuncionario"],
                    //departamento
                    "idDepartamento" => $value["idDepartamento"],
                    "nomeDepartamento" => $value["nomeDepartamento"],
                    "ativoDepartamento" => $value["ativoDepartamento"],
                    //cargo
                    "idCargo" => $value["idCargo"],
                    "departamentoCargo" => $value["departamentoCargo"],
                    "nomeCargo" => $value["nomeCargo"],
                    "AtivoCargo" => $value["ativoCargo"],
                    //classe
                    "idClasse" => $value["idClasse"],
                    "codClasse" => $value["codClasse"],
                    "nomeClasse" => $value["nomeClasse"],
                    //fornecedor
                    "nomeFornecedor" => $value["nomeFornecedor"],
                    "siteFornecedor" => $value["siteFornecedor"],
                    "emailFornecedor" => $value["emailFornecedor"],
                    //adm
                    "userSistema" => $value["nomeUserDados"],
                    //list arquivo
                    "arquivos" => $this->app->searchListArquivo($numeroOrder),
                    "limite" => $limite,
                    "totalRegistro" => $value["totalRegistro"],
                ];
            }
        }
        return $list;
    }

    public function crudOrderCompra(array $dados, array $files){
        $jsonDados = json_decode($dados["dados"], true);
        $dadosT = $this->app->limparInputs($jsonDados);
        $action = $dadosT["action"];

        $arquivosOrcamento = [];
        $arquivosInterno = [];

        $arquivosOrcamento = $this->reorganizarArrayFiles($files['arquivos'] ?? null);
        $arquivosInterno = $this->reorganizarArrayFiles($files['arquivosInterno'] ?? null);

        switch($action){
            case "aprovar/reprovar":
                $dadosSend = [
                    "idOrder" => $dadosT["idOrder"],
                    "fazer" => $dadosT["fazer"],
                    "textAprovacao" => $dadosT["textAprovacao"],
                ];

                $result = $this->aprovarReprovar($dadosSend);

                if($result["sucesso"]){
                    return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                } 
                break;

            case "salvar":
                $dadosSend = [
                    "destinoOrderCompra" => 1,
                    "numeroOrcamentoOrderCompra" => $dadosT["numeroOrcamento"],
                    "prioridadeOrderCompra" => $dadosT["pioridade"],
                    "idFornecedorOrderCompra" => $dadosT["idFornecedor"],
                    "valorNotaOrderCompra" => $dadosT["valorNota"],
                    "descricaoItemOrderCompra" => $dadosT["descricaoCurta"],
                    "descricaoOrderOrderCompra" => $dadosT["descricaoLonga"],
                    "emailEnviadoAoFornecedorOrderCompra" => $dadosT["enviarEmail"],
                    "arquivos" => $arquivosOrcamento,
                    "arquivosInterno" => $arquivosInterno,
                ];
                
                $result = $this->salvarOrderCompra($dadosSend);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;
                
            case "excluir":
                $result = $this->excluirOrderCompra($dadosT["idOrder"]);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;
        }
    }

    private function reorganizarArrayFiles($file_post) {
        if (!$file_post || !isset($file_post['name'])) return [];

        $file_ary = [];
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
    }

    private function excluirOrderCompra(int $id){
        $select = "DELETE FROM tbOrderCompra WHERE idOrderCompra=?";
        $qry = $this->db->executarSQL($select,[$id]);
        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Ordem de Compra excluida com sucesso, não iremos guardar esse registo"];
        }
        return ["sucesso" => false, "msg" => "Erro ao excluir a Ordem de Compra"];
    }

    private function salvearquivosDB($file, $numerOrder, $tipo){
        if($numerOrder == '') return ["sucesso" => false, "msg" => "O número da Ordem de Compra está vazia por algum motivo"];

        $totalFicheiros = count($file);
        $result = [];

        for ($i = 0; $i < $totalFicheiros; $i++) {
            print_r($file[$i]["name"]);
            $nomeOriginal = $file[$i]['name'];
            $caminhoTemp = $file[$i]['tmp_name'];
            $erro = $file[$i]['error'];

            if ($erro === UPLOAD_ERR_OK) {
                $ext = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
                $nomeHash =  md5(uniqid()) . "." . $ext;
                
                $diretorio = "public/assets/uploads/orders/";
                $destino = $diretorio . $nomeHash;

                if (!is_dir($diretorio)) {
                    mkdir($diretorio, 0775, true);
                }

                if(move_uploaded_file($caminhoTemp, $destino)){
                    chmod($destino, 0664);
                    $sqlInsert = "INSERT INTO tbArquivos 
                            (numeroOrdemArquivo, nomeOriginalArquivo, nomeHashArquivo, tipoArquivo) 
                            VALUES (?, ?, ?, ?)";
        
                    $result = $this->db->executarSQL($sqlInsert,[$numerOrder, $nomeOriginal, $nomeHash, $tipo]);
                    if($result){
                        $result = [
                            "sucesso" => true,
                            "msg" => "Imagem salva com sucesso",
                            "result" => $totalFicheiros,
                        ];
                    } else {
                        $result = [
                            "sucesso" => false,
                            "msg" => "Erro ao salvar imagem no banco de dados",
                        ];
                    }
                } else {
                    $result = [
                        "sucesso" => false,
                        "msg" => "Erro ao mover imagem para a pasta",
                    ];
                }
            } else {
                $result = [
                    "sucesso" => false,
                    "msg" => "Erro no recebimento da imagem",
                ];
            }
        }

        return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
    }

    private function salvearquivosInternoDB($file, $numerOrder, $tipo){
        if($numerOrder == '') return ["sucesso" => false, "msg" => "O número da Ordem de Compra está vazia por algum motivo"];

        $totalFicheiros = count($file);
        $result = [];

        for ($i = 0; $i < $totalFicheiros; $i++) {
            $nomeOriginal = $file[$i]['name'];
            $caminhoTemp = $file[$i]['tmp_name'];
            $erro = $file[$i]['error'];

            if ($erro === UPLOAD_ERR_OK) {
                $ext = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
                $nomeHash =  md5(uniqid()) . "." . $ext;
                
                $diretorio = "public/assets/uploads/arquivo_interno/";
                $destino = $diretorio . $nomeHash;

                if (!is_dir($diretorio)) {
                    mkdir($diretorio, 0775, true);
                }

                if(move_uploaded_file($caminhoTemp, $destino)){
                    chmod($destino, 0664);
                    $sqlInsert = "INSERT INTO tbArquivos 
                            (numeroOrdemArquivo, nomeOriginalArquivo, nomeHashArquivo, tipoArquivo) 
                            VALUES (?, ?, ?, ?)";
        
                    $result = $this->db->executarSQL($sqlInsert,[$numerOrder, $nomeOriginal, $nomeHash, $tipo]);
                    if($result){
                        $result = [
                            "sucesso" => true,
                            "msg" => "Imagem salva com sucesso",
                            "result" => $totalFicheiros,
                        ];
                    } else {
                        $result = [
                            "sucesso" => false,
                            "msg" => "Erro ao salvar imagem no banco de dados",
                        ];
                    }
                } else {
                    $result = [
                        "sucesso" => false,
                        "msg" => "Erro ao mover imagem para a pasta",
                    ];
                }
            } else {
                $result = [
                    "sucesso" => false,
                    "msg" => "Erro no recebimento da imagem",
                ];
            }
        }

        return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
    }

    private function searchUltimoNumberOrder(){
        $ano = date("y");
        $mes = date("m");
        $busca = $ano . $mes;
        $select = "SELECT codOrderCompra 
                    FROM tbOrderCompra
                    WHERE substr(codOrderCompra, 1, 4) = ? 
                    ORDER BY codOrderCompra DESC LIMIT 1";
        $number = $ano . $mes . "0001";
        $qry = $this->db->buscar($select, [$busca]);
        if(count($qry) > 0){
            return $number = (int)($qry[0]["codOrderCompra"]) + 1;
        }
        return $number;
    }

    private function salvarOrderCompra(array $dados){
        
        $numberSeguirOrder = $this->searchUltimoNumberOrder();

        $result = ["sucesso" => true];
        if(count($dados["arquivos"]) > 0){
            $result = $this->salvearquivosDB($dados["arquivos"], $numberSeguirOrder, 1);
    
            $result = ["sucesso" => $result["sucesso"], "msg" => $result["msg"], "result" => $dados["arquivos"]];
        }

        if(count($dados["arquivosInterno"]) > 0){
            $result = $this->salvearquivosInternoDB($dados["arquivosInterno"], $numberSeguirOrder, 2);
            $result = ["sucesso" => $result["sucesso"], "msg" => $result["msg"], "result" => $dados["arquivos"]];
        }

        if($result["sucesso"]){
            $destinoOrderCompra = $dados["destinoOrderCompra"];
            $codOrderCompra = $numberSeguirOrder;
            $numeroOrcamentoOrderCompra = $dados["numeroOrcamentoOrderCompra"];
            $dataCriacaoOrderCompra = date("Y-m-d");
            $prioridadeOrderCompra = $dados["prioridadeOrderCompra"];
            $idSolicitanteOrderCompra = $_SESSION["idAgente"];
            $classeSolicitanteOrderCompra = $_SESSION["classeAgente"];
            $idFornecedorOrderCompra = $dados["idFornecedorOrderCompra"];
            $valorNotaOrderCompra = $dados["valorNotaOrderCompra"];
            $descricaoItemOrderCompra = $dados["descricaoItemOrderCompra"];
            $descricaoOrderOrderCompra = $dados["descricaoOrderOrderCompra"];
            $emailEnviadoAoFornecedorOrderCompra = $dados["emailEnviadoAoFornecedorOrderCompra"];
            $select = "INSERT INTO tbOrderCompra
                                    (destinoOrderCompra,
                                    codOrderCompra,
                                    numeroOrcamentoOrderCompra,
                                    dataCriacaoOrderCompra,
                                    prioridadeOrderCompra,
                                    idSolicitanteOrderCompra,
                                    classeSolicitanteOrderCompra,
                                    idFornecedorOrderCompra,
                                    valorNotaOrderCompra,
                                    descricaoItemOrderCompra,
                                    descricaoOrderOrderCompra,
                                    enviarEmailOrderCompra) 
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $qry = $this->db->executarSQL($select, [
                $destinoOrderCompra,
                $codOrderCompra,
                $numeroOrcamentoOrderCompra == '' ? null : $numeroOrcamentoOrderCompra,
                $dataCriacaoOrderCompra,
                $prioridadeOrderCompra,
                $idSolicitanteOrderCompra,
                $classeSolicitanteOrderCompra,
                $idFornecedorOrderCompra,
                $valorNotaOrderCompra,
                $descricaoItemOrderCompra,
                $descricaoOrderOrderCompra,
                $emailEnviadoAoFornecedorOrderCompra
            ]);
    
            if($qry->rowCount() >= 0){
                return ["sucesso" => true, "msg" => "Ordem de Compra salva com sucesso", "result" => $numberSeguirOrder];
            }
            return ["sucesso" => false, "msg" => "Erro sao salvar Ordem de Compra"];
        } else {
            $result = $this->searchLimparImagemDB($numberSeguirOrder, 1);

            if(count($result) > 0){
                $result = $this->excluirArquivo($result, 1);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
            }  else {
                return ["sucesso" => false, "msg" => "Se tentou submenter um formulario e está vendo essa mensagem, houve um erro na sua execução e não pode ser finalizada a operação"];
            }
        }
    }

    private function searchLimparImagemDB(int $NOrder, int $tipo){
        $select = "SELECT * FROM tbArquivos WHERE numeroOrdemArquivo = ? AND tipoArquivo = ?";
        $qry = $this->db->buscar($select, [$NOrder, $tipo]);

        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                "nome" => $value["nomeHashArquivo"],
                ];
            }
        }
        return $list;
    }

    private function excluirArquivo(array $dados, int $tipo){
        if(count($dados) > 0) return ["sucesso" => false, "msg" => "Nenhuma imagem encontrada no banco de dados"];

        $subPasta = ($tipo == 1) ? "orders/" : "delivery/";

        $pastaImgEntrega = "public/assets/uploads/encomendas/$subPasta";
        $contagemRemovidos = 0;

        foreach($dados as $value){
            $arquivo = $pastaImgEntrega . $value["nome"];
            if(file_exists($arquivo)){
                unlink(($arquivo));
                $contagemRemovidos++;
            }
        }
        return [
            "sucesso" => true, 
            "msg" => "Limpeza concluída. $contagemRemovidos ficheiros removidos fisicamente.",
            "detalhes" => "Processo de imagem de " . ($tipo == 1 ? "Encomenda" : "Entrega")
        ];
    }

    private function aprovarReprovar(array $dados){
        $select = "UPDATE tbOrderCompra 
                    SET dataAprovacaoOrderCompra=?,
                    idAprovadorOrderCompra=?,
                    classeAprovadorOrderCompra=?,
                    textoAprovadorOrderCompra=?,
                    aprovadoRejeitadoOrderCompra=? 

                    WHERE codOrderCompra = ?";

        $foi = $dados["fazer"] == 1 ? 'aprovada' : 'rejeitada';

        $qry = $this->db->executarSQL($select,[
                $this->dataHoje,
                $_SESSION["idAgente"],
                $_SESSION["classeAgente"],
                $dados["textAprovacao"] == '' ? null : $dados["textAprovacao"],
                $dados["fazer"],
                $dados["idOrder"]
        ]);

        if($qry->rowCount() >= 0){
            return [
                "sucesso" => true,
                "msg" => "Ordem de compra {$foi} com sucesso",
            ];
        }
        return [
            "sucesso" => false,
            "msg" => "Houve um erro ao executar essa ação tente novamente",
        ];
    }
}