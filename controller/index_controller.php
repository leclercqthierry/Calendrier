<?php

// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function index(){
    require __DIR__."/../view/form_view.php";
}
?>