<?php
include_once("includes/global_vars.php");

$ver = '26';

$alert = checkdb($ver);
$vticker = getvticker();

//autologon
if(isset($_GET['auth'])){header("Location: autologon.php?auth=".$_GET['auth']);}

function getvticker(){
    $output = "<ul>";
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `annonces`.`titre` FROM `".DB."`.`annonces` ORDER BY `ID` DESC LIMIT 10";
    $result = $mysqli->query($query);
    while($row = $result->fetch_row()){
        $output .= "<li><div>".$row[0]."</div><br /></li>";
    }
    $result->close();
    $mysqli->query($query);
    $mysqli->close();
    $output .= "</ul>";
    return $output;    
}

function checkdb($ver){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `version` FROM `".DB."`.`db_ver`";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $db_ver = $row[0];
    $result->close();
    
    if($ver!==$db_ver){
        $alert="<h1>Attention, la base de données n'est pas à jour! <a href='db/updatedb.php'>Mettre à jour</a></h1>";
    };
    //$alert = $db_ver;
      
    $mysqli->query($query);
    $mysqli->close();
    return $alert;
}
?>