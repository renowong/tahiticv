<?php
include_once("../../includes/global_vars.php");
$id = $_COOKIE["user"];
$avatar_img = $_POST["avatar"];

    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }

    $query = "UPDATE  `".DB."`.`cv` SET  `image` =  '$avatar_img' WHERE  `cv`.`id_user` ='$id'";
    
    $mysqli->query($query);
    $mysqli->close();
    
    print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='1' msg='Avatar mis &agrave; jour'>".
          "</response>");       
 

?>