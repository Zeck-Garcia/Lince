<?php
error_reporting(E_ALL);
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

$selecT = "ALTER TABLE `tbLojas` CHANGE `horaInicioLoja` `horaInicioLoja` TIME NULL; ";

$operation->setValorManipula($selecT);

$operation->manipula();

?>