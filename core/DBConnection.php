    <?php
        class DBConnection {
            private $host = "localhost";
            private $db   = "dbLince";//"privado_lince"; //"dbLince";
            private $user = "root";//"privado_lince_user"; //"root";
            private $pass = "";//"a1TKE01vKz9O"; //"";
            protected $connect;

            public function __construct() {
                try {
                    $this->connect = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->user, $this->pass);
                    $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Erro de ligação: " . $e->getMessage());
                }
            }

            public function executarSQL($sql, $params = []) {
                $stmt = $this->connect->prepare($sql);
                $stmt->execute($params);
                return $stmt;
            }
        }
    ?>
