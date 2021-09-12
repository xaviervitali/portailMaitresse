<?php

require_once("private/functions.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);
setlocale(LC_TIME, 'fra_fra');

session_start();
// Lecture d'une valeur du tableau de session
// var_dump($_SESSION['login']);
$level = intval($_SESSION['login']);
$level > 0 ? '' : header('Location: index.php');


$tabFinal = [];
function createApi($tabName)
{
    global $tabFinal;
    $rows =  readTable($tabName);
    $json = [];
    foreach ($rows as $row) {
        array_push(
            $json,
            $row
        );
    }

    $tabFinal[$tabName] = $json;
}

createApi('liens_utiles');
createApi('fiches');
createApi('notes');


// $tabFinal = ["liens" => $json];
echo (json_encode($tabFinal));
