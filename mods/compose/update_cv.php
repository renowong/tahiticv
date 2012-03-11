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
    $tbl = $_POST["tbl"];
    $col = $_POST["col"];
    $value = htmlentities ($_POST["value"],ENT_QUOTES,'UTF-8');
    $plugin_id = $_POST["plugin_id"];
    $plugin_id = $plugin_id +0;
    if($plugin_id > 0){$colname="ID";$id=$plugin_id;}else{$colname="id_user";}
    
    $query = "UPDATE `$tbl` SET `$col`='$value' WHERE `$colname` = '$id'";
    $mysqli->query($query);
    $mysqli->close();
    
    echo $query;

?>