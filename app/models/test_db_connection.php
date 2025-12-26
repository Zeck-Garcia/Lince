<?php

require_once 'DBConnection.php'; // Ou o caminho correto para o seu arquivo DBConnection.php

try {
    $db = new DBConnection(); // Cria uma instância da classe DBConnection
    $conn = $db->getConnection(); // Obtém a conexão PDO

    if ($conn) {
        echo "Conexão com o banco de dados bem-sucedida!";
    } else {
        echo "Falha ao conectar com o banco de dados.";
    }

    $conn = null; // Fecha a conexão
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}

?>