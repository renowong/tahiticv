<?php
include_once("../../includes/global_vars.php");
include_once("../../includes/security.php");
$tbl = $_GET["tbl"];
$id = tdecode($_GET["id"]);

$mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

/* check connection */
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
    exit();
}

    $query = "DELETE FROM `".DB."`.`$tbl` WHERE `$tbl`.`ID` = $id";
    $mysqli->query($query);
    $mysqli->close();
    
    print $query;
    
?>