<?php
include_once("../../includes/global_vars.php");
include_once("../../includes/security.php");

$action = $_POST["action"]; #add ou del
//$type = $_GET["type"]; #cv ou ann
$idfav = tdecode($_POST["id"]);
$iduser = $_COOKIE["user"];

fav($idfav,$iduser,$action);


function fav($idfav,$iduser,$action){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `users`.`fav_ids` FROM `users` WHERE `users`.`ID`='$iduser'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $existing = $row[0];
    $result->close();
    
    switch($action){
        case "add":
            $update = $existing.$idfav."|";
        break;
        case "del":
            $update = str_replace("|".$idfav."|","|",$existing);
        break;
    }
    $query = "UPDATE `users` SET `users`.`fav_ids`='$update' WHERE `users`.`ID`='$iduser'";
    $mysqli->query($query);
    $mysqli->close();
}
    
?>