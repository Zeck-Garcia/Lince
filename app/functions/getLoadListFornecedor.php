<?php
    ob_start();
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
    error_reporting(E_ALL);
    ob_end_clean();
    $result = new Fornecedor();
    $list = $result->getLoadListFornecedor($_POST);
    header("Content-Type: application/json; charset=UTF-8;");
    echo json_encode(["obj" => $list], JSON_UNESCAPED_UNICODE);
    exit;