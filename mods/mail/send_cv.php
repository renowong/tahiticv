<?php
set_include_path('/home/renowong/php');
set_include_path('/usr/share/php');

include_once("../../includes/global_vars.php");
include_once("../../includes/security.php");
require_once "Mail.php";


$announce_id = $_POST["id"];
$id = $_COOKIE["user"];

       $token = md5(uniqid(rand(),1));
       $ar_annonceur = getdata($announce_id);
       auth($token,$id,$ar_annonceur[0]);
       addtoauth($ar_annonceur[0],$id);
      
       $name = getname($id);
       $title = gettitle($announce_id);
       
     
       $from = "administrateur@tahiticv.com";
       $to = $ar_annonceur[1];
       $subject = "Soumission d'un CV : TahitiCV";
       $body = "Bonjour, ceci est un envoi de CV de la part de $name. pour votre annonce intitulée \"$title\"\n";
       $body .= "Si vous souhaitez accéder au CV, veuillez cliquer sur le lien ci-après :\n";
       $body .= SITEADDR."index.php?auth=$token\n";
       $body .= "Dans le cas contraire, veuillez ignorer cette demande.\n\n";
       $body .= "L'administrateur TahitiCV.\n";


       //old gmail account
       $host = "ssl://smtp.gmail.com";
       $port = "465";
       $username = "tahiticv@gmail.com";
       $password = "johnnyte\$t";
       
       //$host = "mail.tahiticv.com";
       //$port = "25";
       //$username = "administrateur+tahiticv.com";
       //$password = "jerome12";
       
       $headers = array ('From' => $from,
         'To' => $to,
	  'Subject' => $subject);
       $smtp = Mail::factory('smtp',
	  array ('host' => $host,
	    'port' => $port,
	    'auth' => true,
	    'username' => $username,
	    'password' => $password));
       
       $mail = $smtp->send($to, $headers, $body);
       //print("sending for announce to ".getmail($announce_id));
       if (PEAR::isError($mail)) {
              echo("<p>" . $mail->getMessage() . "</p>");
       } else {
              print("Succes de l'envoi!");
       }


function getdata($id){
       $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `annonces`.`id_annonceur` FROM `annonces` WHERE `annonces`.`ID` = '$id'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $annonceurid = $row[0];
    $array = array($annonceurid);
    
    $query = "SELECT `users`.`email` FROM `users` WHERE `users`.`ID` = '$annonceurid'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $email = $row[0];
    $result->close();
    $mysqli->close();
    array_push($array,$email);
    return $array;
}

function getname($id){
       $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `cv`.`nom`,`cv`.`prenom` FROM `cv` WHERE `cv`.`id_user` = '$id'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $n = $row[0]." ".$row[1];
    $result->close();
    $mysqli->close();
    return $n;
}

function gettitle($id){
       $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `annonces`.`titre` FROM `annonces` WHERE `annonces`.`ID` = '$id'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $n = $row[0];
    $result->close();
    $mysqli->close();
    return $n;
}

function auth($token,$id,$auth_id){
       $date = date("Y-m-d");
       $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
        $query = "INSERT INTO `".DB."`.`authorisations` (`ID`, `code`, `id_user`, `id_auth`, `date`) VALUES (NULL, '$token', '$id', '$auth_id', '$date')";
        $mysqli->query($query);
        $mysqli->close();
}

function addtoauth($id,$cvid){
       $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
           /* check connection */
       if (mysqli_connect_errno()) {
	   //printf("Connect failed: %s\n", mysqli_connect_error());
	   print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
	   exit();
       }
       $query = "SELECT `cv`.`auth_ids` FROM `cv` WHERE `id_user` = '$cvid'";
        $result = $mysqli->query($query);
        $row = $result->fetch_row();
        $auth_ids = $row[0];
        $result->close();
	
	
        if(strpos($auth_ids, "|".$id."|") === false){
	      if(substr($auth_ids, -1)!=="|"){$auth_ids .= "|";}
	       $auth_ids .= $id."|";
	       $query = "UPDATE `cv` SET `auth_ids` = '$auth_ids' WHERE `id_user` = '$cvid'";
	       $mysqli->query($query);
       
	       $mysqli->close();
	}

}

?>