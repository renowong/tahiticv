<?php
include_once("includes/global_vars.php");

$mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

/* check connection */
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
    exit();
}

$code = $_GET['auth'];
    
$query = "SELECT `id_auth` FROM `authorisations` WHERE `code` = '$code'";

if ($result = $mysqli->query($query)) {

    $row = $result->fetch_row();
    $num_rows = $result->num_rows;
    $id = $row[0];
    $result->close();
    $mysqli->close();
    if ($num_rows==0 | $row[2]!=$password) {
	//$response .= "<response success='0' msg='Login ou mot de passe incorrect'></response>";
    }else{
        //$user = getdata($id);
	//$response .= "<response success='1' msg='Login en cours...'><login>$user["username"]</login><md5pass>$user["md5pass"]</md5pass></response>";
    }
}


print($query);

//functions

function getdata($id){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    $query = "SELECT `username`,`password` FROM `users` WHERE `ID` = '$id'";
    if ($result = $mysqli->query($query)) {
        $row = $result->fetch_row();
        $arr_user = array("username" => $row[0],"md5pass" => $row[1]);
        $result->close();
        $mysqli->close();
        return $arr_user;
    }
}
?>