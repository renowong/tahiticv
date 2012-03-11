<?php
include_once("../../includes/global_vars.php");
include_once("../../includes/security.php");

$tbl = $_GET["tbl"];
$id = tdecode($_GET["id"]);
$col = $_GET["col"];
$data = $_GET["data"];
$mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

/* check connection */
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
    exit();
}

    $query = "SELECT `".$col."_ids` FROM `".DB."`.`$tbl` WHERE `ID` = '$id'";
    echo $query;
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $existingdata = $row[0];
    $result->close();

    
    $newdata = str_replace($data,"",$existingdata);
    $newdata = str_replace("||","|",$newdata);
    
    $query = "UPDATE `".DB."`.`$tbl` SET `".$col."_ids` = '$newdata' WHERE `ID` = '$id'";
    echo $query;
    $mysqli->query($query);
    
    //finally delete row in corresponding table
    $query = "DELETE FROM `".DB."`.`$col` WHERE `$col`.`ID` = $data";
    echo $query;
    $mysqli->query($query);
    $mysqli->close();
    
?>