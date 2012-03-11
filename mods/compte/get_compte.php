<?php
include_once("../../includes/global_vars.php");
header('Content-Type: text/xml');

$id = $_COOKIE["user"];

    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $response = "<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='1' msg='Module Compte Charg&eacute;'>";
    $query = "SELECT  * FROM  `users` WHERE `ID` = $id";
    if ($result = $mysqli->query($query)) {

    $row = $result->fetch_assoc();
    $response .= "<username>".$row["username"]."</username>";
    $response .= "<type>".$row["type"]."</type>";
    $response .= "<email>".$row["email"]."</email>";
    $response .= "<rs>".$row["rs"]."</rs>";
    $response .= "<tel>".$row["tel"]."</tel>";
    $result->free();
}
    
    $mysqli->close();
    $response .= "</response>";
    print $response;
?>