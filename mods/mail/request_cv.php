<?php
set_include_path('/home/renowong/php');
include_once("../../includes/global_vars.php");
include_once("../../includes/security.php");
require_once "Mail.php";

$auth_id = tdecode($_POST["id"]);
$id = $_COOKIE["user"];

       $token = md5(uniqid(rand(),1));
       
       auth($token,$id,$auth_id);
       
       $rs = getrs($id);
       
       $from = "administrateur@tahiticv.com";
       $to = getmail($auth_id);
       $subject = "Demande d'autorisation : TahitiCV";
       $body = "Bonjour, ceci est une demande émanant de la société $rs\n";
       $body .= "Celle-ci souhaiterait accéder à vos informations personnelles sur votre Curriculum Vitae.\n";
       $body .= "Si vous souhaitez donner cette autorisation à $rs, veuillez cliquer sur le lien ci-après :\n";
       $body .= SITEADDR."auth.php?token=$token\n";
       $body .= "Dans le cas contraire, veuillez ignorer cette demande.\n\n";
       $body .= "L'administrateur TahitiCV.\n";
       
       //old gmail account
       //$host = "ssl://smtp.gmail.com";
       //$port = "465";
       //$username = "tahiticv@gmail.com";
       //$password = "johnnyte\$t";
       
       $host = "mail.tahiticv.com";
       $port = "25";
       $username = "administrateur+tahiticv.com";
       $password = "jerome12";
       
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
       
       if (PEAR::isError($mail)) {
              echo("<p>" . $mail->getMessage() . "</p>");
       } else {
              print("Succes de l'envoi!");
       }


function getmail($id){
       $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `cv`.`email` FROM `cv` WHERE `cv`.`ID` = '$id'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $email = $row[0];
    $result->close();
    $mysqli->close();
    return $email;
}

function getrs($id){
       $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `users`.`rs` FROM `users` WHERE `users`.`ID` = '$id'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $rs = $row[0];
    $result->close();
    $mysqli->close();
    return $rs;
}

function auth($token,$id,$auth_id){
       $date = date("Y-m-d");
       $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
        $query = "INSERT INTO `".DB."`.`authorisations` (`ID`, `code`, `id_user`, `id_auth`, `date`) VALUES (NULL, '$token', '$id', '$auth_id', '$date')";
        $mysqli->query($query);
        $mysqli->close();
    }

    ?>