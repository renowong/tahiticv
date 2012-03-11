<?php
include_once("../../includes/global_vars.php");
$id = $_COOKIE["user"];

    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'>");
        exit();
    }
    $value = $_POST["value"];
    $col = $_POST["col"];
    $type = $_POST["type"];
    
    if($type=="md5"){$value=md5($value);}
    
    $query = "UPDATE `users` SET `$col`='$value' WHERE `ID` = '$id'";
    $mysqli->query($query);
    $mysqli->close();
    
    echo $query;

?>