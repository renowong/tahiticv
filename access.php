<?php
include_once("includes/global_vars.php");

$mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

/* check connection */
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
    exit();
}
    
$username = addslashes($_POST['username']);
$password = md5($_POST['password']);
$response = "<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]>";

$query = "SELECT `ID`,`username`,`password` FROM `users` WHERE `username` = '$username'";

if ($result = $mysqli->query($query)) {

    $row = $result->fetch_row();
    $num_rows = $result->num_rows;
    $id = $row[0];
    $result->close();
    $mysqli->close();
    if ($num_rows==0 | $row[2]!=$password) {
	$response .= "<response success='0' msg='Login ou mot de passe incorrect'></response>";
    }else{
	$response .= "<response success='1' msg='Login en cours...'><id>$id</id></response>";
    }
}


print($response);
?>