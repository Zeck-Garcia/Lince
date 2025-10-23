<?php

$exit = filter_input(INPUT_POST, "exit");

if(session_start()){
    session_unset();
    session_destroy();
    exit();
}




?>