<?php
include_once("../../includes/global_vars.php");
include_once("../../includes/security.php");
$id_announce = tdecode($_POST["id"]);

    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $activation = $_POST["activation"];
    
    $query = "UPDATE  `".DB."`.`annonces` SET  `activation` =  '$activation' ".
    "WHERE `annonces`.`ID` ='$id_announce'";
    
    $mysqli->query($query);

    $mysqli->close();

    print $query;
?>