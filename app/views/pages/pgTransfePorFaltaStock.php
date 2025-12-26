<?php
// if($_SESSION["loginUser"] == false){
//     header('Location: login');
// } else {
//     if($_SESSION["loginUser"] != true or $_SESSION["classeAgente"] != "3"){
//         header('Location: login');
//     }
// }

?>
<div class="menuLateral">
    <?php include_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage">
    <div class="groupBody">

    falta de stock

    </div>
    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>

<script src="public/js/pgTransfePorFaltaStock.js"></script>