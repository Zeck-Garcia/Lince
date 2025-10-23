<?php 
session_start();
include_once "app/controller/function/funcVersion.php";
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lince</title>
    <link rel="icon" type="image/x-icon" href="public/assets/favicon.png">
    <link rel="stylesheet" href="public/css/reset.css?v=<?= $versao;?>">
    <link rel="stylesheet" href="public/css/index.css?v=<?= $versao;?>">
    <link rel="stylesheet" href="public/css/msgBox.css?v=<?= $versao;?>">
    <link rel="stylesheet" href="public/css/filter.css?v=<?= $versao;?>">
    <!-- <link rel="stylesheet" href="public/css/spinner.css"> -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body>

    <div id="containerContent">
        <?php include_once "app/router/router.php";?>
    </div>

    <div id="divBoxMsgBox">
    </div>

    <!-- <div id="preloader">
        <div class="spinner"></div>
    </div> -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.2/papaparse.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script src="public/js/global.js?v=<?= $versao;?>"></script>
</body>
</html>