<?php
class Teste{
    private $db;

    public function __construct()
    {
        $this->db = new manipulacaoDeDados();
    } 

    public function buscar(){
        // $select = "SELECT * FROM INFORMATION_SCHEMA.TABLES 
        //             WHERE TABLE_SCHEMA = 'dbLince';
        //             GO";

        $select = "
                USE privado_lince;
                GO
                
                CREATE TABLE `tbUserSistema` (
                `idUserDados` int(11) NOT NULL,
                `codColaboradorUserDados` int(11) DEFAULT NULL,
                `idLogin` int(11) NOT NULL,
                `nomeUserDados` varchar(150) NOT NULL,
                `departamentoUserDados` int(11) NOT NULL,
                `cargoUserDados` int(11) NOT NULL,
                `classeUserDados` int(11) NOT NULL,
                `emailUserDados` varchar(150) DEFAULT NULL,
                `dataCriadoUserDados` datetime NOT NULL DEFAULT current_timestamp(),
                `receberEmailUserDados` tinyint(4) NOT NULL DEFAULT 1,
                `ativoUserDados` int(11) NOT NULL DEFAULT 1,
                `aceitarOrderCompra` tinyint(4) NOT NULL DEFAULT 0,
                `contactoUserDados` varchar(20) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                ALTER TABLE `tbUserSistema`
                ADD PRIMARY KEY (`idUserDados`),
                ADD KEY `idx_idLogin` (`idLogin`),
                ADD KEY `idx_cargoUserDados` (`cargoUserDados`),
                ADD KEY `idx_departamentoUserDados` (`departamentoUserDados`),
                ADD KEY `idx_classeUserDados` (`classeUserDados`),
                ADD KEY `idx_aceitarOrderCompra` (`aceitarOrderCompra`);

                ALTER TABLE `tbUserSistema`
                MODIFY `idUserDados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

                COMMIT;";
        $qry = $this->db->buscar($select);
        $list = [];
        if(count($qry) > 0){
            $list[] = $qry;
            // foreach($qry as $value){
            //     $list[] = $value;
            // }
        }
        return $qry;
    }
}