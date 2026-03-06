<?php
spl_autoload_register(function ($classe) {
    $diretorios = [
        BASE_PATH . "/core/",
        BASE_PATH . "/app/controllers/",
        BASE_PATH . "/app/controllers/class/"
    ];
    foreach ($diretorios as $dir) {
        $ficheiro = $dir . $classe . ".php";
        if (file_exists($ficheiro)) {
            require_once $ficheiro;
            return;
        }
    }
});
