<?php

class OrdemCompra{
    private $db;
    private $app;
    private $dataHoje;

    public function __construct()
    {
        $this->db = new manipulacaoDeDados();
        $this->app = new Application();
        $this->dataHoje = date("Y-m-d");
    }

    public function getLoadListOrdemCompra(array $dados){
        $jsonDados = json_decode($dados["dados"], true);
        
        $dadosT = $this->app->limparInputs($jsonDados);

        $paginaSet = ($dadosT["paginaSet"] == 0 ? 1 : $dadosT["paginaSet"]);
        $limite = 7;
        $inicio = ($paginaSet * $limite) - $limite;

        $where = '';
        if($dadosT["idOrder"] != ''){
            $where = " AND oc.idOrderCompra = ? ";
        }

        $select = "WITH result AS (SELECT * 
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

                    WHERE 1=1 ";

        $selectWhere = " ORDER BY oc.idOrderCompra DESC)
        SELECT *, (SELECT COUNT(*) FROM result ) AS totalRegistro FROM result ORDER BY idOrderCompra DESC LIMIT " . $inicio . "," . $limite;

        $selectCompleta = $select . $where . $selectWhere;

        if($where != ''){
            $qry = $this->db->buscar($selectCompleta,[$dadosT["idOrder"]]);            
        } else {
            $qry = $this->db->buscar($selectCompleta);
        }

        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "idOrder" => $value["idOrderCompra"],
                    "destinoOrder" => $value["destinoOrderCompra"],
                    "codOrder" => $value["codOrderCompra"],
                    "numeroOrcamentoOrder" => $value["numeroOrçamentoOrderCompra"],
                    "dataOrder" => $value["dataCriacaoOrderCompra"],
                    "prioriOrder" => $value["prioridadeOrderCompra"],
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
                    "idUser" => $value["udUserDados"],
                    // "codColaborador" => $value["codFuncionarioFuncionario"],
                    "nomeUser" => $value["nomeUserDados"],
                    "lojaUser" => $value["departamentoUserDados"],
                    "ativoUser" => $value["cargoUserDados"],
                    "emailUser" => $value["classeUserDados"],
                    "idDepartamentoFuncionario" => $value["emailUserDados"],
                    "idCargoFuncionario" => $value["cargoFuncionario"],
                    "classeFuncionario" => $value["classeFuncionario"],
                    "ativoFuncionario" => $value["ativoUserDados"],
                    // "recberEmailFuncionario" => $value["receberEmailFuncionario"],
                    // "idLoginFuncionario" => $value["idLoginFuncionario"],
                    //departamento
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
                ];
            }
        }
        return $list;
    }

    public function getdadosOrdemCompra(int $id){
        $select = "";
        $qry = $this->db->buscar($select, []);
        $list = [];
        if(count($qry) > 0){
            $list[] = [
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
                "" => $qry[0][""],
            ];
        }
    }

    public function crudOrderCompra(array $dados, array $file){
        $jsonDados = json_decode($dados["dados"], true);
        $dadosT = $this->app->limparInputs($jsonDados);
        $action = $dadosT["action"];
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
                    "arquivos" => $file,
                ];
                
                $result = $this->salvarOrderCompra($dadosSend);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"], "result" => $result["result"]];
                break;

        }

    }

    private function salvearquivosDB($file, $numerOrder, $tipo){
        if($numerOrder == '') return ["sucesso" => false, "msg" => "O número da Ordem de Compra está vazia por algum motivo"];

        $totalFicheiros = count($file["arquivos"]["name"]);
        // $totalFicheiros = count($_FILES['filePhotoOrder']['name']);

        for ($i = 0; $i < $totalFicheiros; $i++) {
            $nomeOriginal = $file["arquivos"]['name'][$i];
            $caminhoTemp = $file["arquivos"]['tmp_name'][$i];
            $erro = $file["arquivos"]['error'][$i];

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
                    $sqlInsert = "INSERT INTO tbArquivoOrdemCompra 
                            (numeroOrdemArquivoOrdemCompra, nomeOriginalArquivoOrdemCompra, nomeHashArquivoOrdemCompra, tipoArquivoOrdemCompra) 
                            VALUES (?, ?, ?, ?)";
        
                    $result = $this->db->executarSQL($sqlInsert,[$numerOrder, $nomeOriginal, $nomeHash, $tipo]);
                    if($result){
                        return [
                            "sucesso" => true,
                            "msg" => "Imagem salva com sucesso",
                            "result" => $file["arquivos"]["name"],
                        ];
                    } else {
                        return [
                            "sucesso" => false,
                            "msg" => "Erro ao salvar imagem no banco de dados",
                        ];
                    }
                } else {
                    return [
                        "sucesso" => false,
                        "msg" => "Erro ao mover imagem para a pasta",
                    ];
                }
            } else {
                return [
                    "sucesso" => false,
                    "msg" => "Erro ao mover imagem para a pasta",
                    "result" => count($file["arquivos"]["name"]),
                ];
            }
        }
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

        $result = $this->salvearquivosDB($dados["arquivos"], $numberSeguirOrder, 1);

        return ["sucesso" => $result["sucesso"], "msg" => $result["msg"], "result" => $result["result"]];
        // $destinoOrderCompra = $dados["destinoOrderCompra"];
        // $codOrderCompra = $numberSeguirOrder;
        // $numeroOrcamentoOrderCompra = $dados["numeroOrcamentoOrderCompra"];
        // $dataCriacaoOrderCompra = date("Y-m-d");
        // $prioridadeOrderCompra = $dados["prioridadeOrderCompra"];
        // $idSolicitanteOrderCompra = $_SESSION["idAgente"];
        // $classeSolicitanteOrderCompra = $_SESSION["classeAgente"];
        // $idFornecedorOrderCompra = $dados["idFornecedorOrderCompra"];
        // $valorNotaOrderCompra = $dados["valorNotaOrderCompra"];
        // $descricaoItemOrderCompra = $dados["descricaoItemOrderCompra"];
        // $descricaoOrderOrderCompra = $dados["descricaoOrderOrderCompra"];
        // $emailEnviadoAoFornecedorOrderCompra = $dados["emailEnviadoAoFornecedorOrderCompra"];
        // $select = "INSERT INTO tbOrderCompra
        //                         (destinoOrderCompra,
        //                         codOrderCompra,
        //                         numeroOrcamentoOrderCompra,
        //                         dataCriacaoOrderCompra,
        //                         prioridadeOrderCompra,
        //                         idSolicitanteOrderCompra,
        //                         classeSolicitanteOrderCompra,
        //                         idFornecedorOrderCompra,
        //                         valorNotaOrderCompra,
        //                         descricaoItemOrderCompra,
        //                         descricaoOrderOrderCompra,
        //                         enviarEmailOrderCompra) 
        //                         VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        // $qry = $this->db->executarSQL($select, [
        //     $destinoOrderCompra,
        //     $codOrderCompra,
        //     $numeroOrcamentoOrderCompra == '' ? null : $numeroOrcamentoOrderCompra,
        //     $dataCriacaoOrderCompra,
        //     $prioridadeOrderCompra,
        //     $idSolicitanteOrderCompra,
        //     $classeSolicitanteOrderCompra,
        //     $idFornecedorOrderCompra,
        //     $valorNotaOrderCompra,
        //     $descricaoItemOrderCompra,
        //     $descricaoOrderOrderCompra,
        //     $emailEnviadoAoFornecedorOrderCompra
        // ]);

        // if($qry->rowCount() >= 0){
        //     return ["sucesso" => true, "msg" => "Ordem de Compra salva com sucesso"];
        // }
        // return ["sucesso" => false, "msg" => "Erro sao salvar Ordem de Compra"];
    }

    private function aprovarReprovar(array $dados){
        $select = "UPDATE tbOrderCompra 
                    SET dataAprovacaoOrderCompra=?,
                    idAprovadorOrderCompra=?,
                    textoAprovadorOrderCompra=?,
                    aprovadoRejeitadoOrderCompra=? 

                    WHERE idOrderCompra = ?";

        $foi = $dados["fazer"] == 1 ? 'aprovada' : 'rejeitada';

        $qry = $this->db->executarSQL($select,[
                $this->dataHoje,
                $_SESSION["idAgente"],
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