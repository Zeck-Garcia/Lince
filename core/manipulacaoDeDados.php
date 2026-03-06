    <?php
        class manipulacaoDeDados extends DBConnection {
            
            public function listar($stmt) {
                if ($stmt) {
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }
                return false;
            }

            public function buscar($sql, $params = []) {
                $stmt = $this->executarSQL($sql, $params);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            public function buscarUm($sql, $params = []) {
                $stmt = $this->executarSQL($sql, $params);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }

            public function inserir($tabela, $dados) {
                $campos = implode(", ", array_keys($dados));
                $params = implode(", ", array_fill(0, count($dados), "?"));
                $sql = "INSERT INTO $tabela ($campos) VALUES ($params)";
                return $this->executarSQL($sql, array_values($dados));
            }

            public function executarSQL($sql, $params = []) {
                return parent::executarSQL($sql, $params);
            }
        }
    ?>
