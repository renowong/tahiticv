<?php
include_once("includes/global_vars.php");
include_once("includes/security.php");

$mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

/* check connection */
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
    exit();
}

$code = $_GET['auth'];
    
$query = "SELECT `cv`.`ID`, `authorisations`.`id_auth` FROM `authorisations` INNER JOIN `cv` ON `authorisations`.`id_user` = `cv`.`id_user` WHERE `authorisations`.`code` = '$code'";

if ($result = $mysqli->query($query)) {

    $row = $result->fetch_row();
    $num_rows = $result->num_rows;
    $id = $row[1];
    $cv = $row[0];
    $result->close();
    $mysqli->close();
    if ($num_rows==0 | $row[2]!=$password) {
	header("Location: index.php");
    }else{
	$token = rand();
        setcookie("user",$id);
	setcookie("token",$token);
	$scv = $token*23+$cv;
	header("Location: searchcv.php?cv=".$scv);
    }
}


print($query);

//functions

function getdata($id){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
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