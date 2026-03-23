<?php
    ob_start();
    ini_set("display_erros",1);
    ini_set("display_startup_erros",1);
    error_reporting(E_ALL);
    if(ob_get_length()) ob_clean();
    $result = new Application();
    $list = $result->loadListNivel();
    ob_end_clean();
    header("COntent-Type: application/json; charset=UTF-8");
    echo json_encode(["obj" => $list], JSON_UNESCAPED_UNICODE);
    exit;
