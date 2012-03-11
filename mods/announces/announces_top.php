<?php
include_once("includes/global_vars.php");
$id = $_COOKIE["user"];
//check_existing_announces($id);
$categories = build_select('categories','categorie');
$iles = build_select('iles','ile');
$contrats = build_select('contrats','contrat');

function build_select($table,$col){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    $query = "SELECT * FROM `$table` ORDER BY `$col`";
    if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()){
            $output .= "<option value='".$row["ID"]."'>".$row["$col"]."</option>";
        }
    }
    $result->close();
    $mysqli->close();
    return $output;
}

?>