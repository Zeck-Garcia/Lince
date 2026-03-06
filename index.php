<?php
ob_start();
require_once "config.php";
require_once "core/Autoload.php";

$urlAtual = $_GET['url'] ?? 'home';
$urlParts = explode('/', $urlAtual);

if ($urlParts[0] === 'api') {
    if(isset($urlParts[1])) $_GET['param'] = $urlParts[1];
    include_once "app/router/router.php";
    exit;
}

include_once "app/functions/expira.php";
verificarSessaoFixa(28800);
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <base href="<?= URL_SITE ?>">
    <meta charset="UTF-8">
    <title>Lince</title>
    <link rel="icon" type="image/x-icon" href="public/assets/img/favicon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="public/assets/css/style.css?v=<?= VERSION ?>">
    <link rel="stylesheet" href="public/assets/css/spinner.css?v=<?= VERSION ?>">
    <link rel="stylesheet" href="public/assets/css/msgBox.css?v=<?= VERSION ?>">
</head>
<body>
    <div id="divBoxMsgBox"></div>
    <div id="modal-container"></div>
    <div id="modalSub-container"></div>

    <div class="loader-overlay active" id="loaderSpinner">
        <div class="loader-spinner"></div>
        <div class="loader-text">A processar o seu pedido...</div>
        <div class="loader-subtext">Aguarde estamos fazendo o nosso melhor.</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="public/assets/js/global.js?v=<?= VERSION ?>"></script>
    <script src="public/assets/js/helpers.js?v=<?= VERSION ?>"></script>
    <div id='containerContent'>
        <div id="main-body">
            <?php include_once "app/router/router.php"; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
