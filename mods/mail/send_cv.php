<?php
set_include_path('/home/renowong/php');
include_once("../../includes/global_vars.php");
include_once("../../includes/security.php");
require_once "Mail.php";
require_once('Mail/mime.php');


$announce_id = $_POST["id"];
$id = $_COOKIE["user"];

//       $token = md5(uniqid(rand(),1));
//       
//       auth($token,$id,$auth_id);
//       
//       $rs = getrs($id);
//       
       $from = "administrateur@tahiticv.com";
       $to = getmail($announce_id);
       $subject = "Soumission d'un CV : TahitiCV";
       $body = "Bonjour, ceci est un CV de la part de\n";
//       $body .= "Celle-ci souhaiterait accéder à vos informations personnelles sur votre Curriculum Vitae.\n";
//       $body .= "Si vous souhaitez donner cette autorisation à $rs, veuillez cliquer sur le lien ci-après :\n";
//       $body .= SITEADDR."auth.php?token=$token\n";
//       $body .= "Dans le cas contraire, veuillez ignorer cette demande.\n\n";
//       $body .= "L'administrateur TahitiCV.\n";
//

       //old gmail account
       $host = "ssl://smtp.gmail.com";
       $port = "465";
       $username = "tahiticv@gmail.com";
       $password = "johnnyte\$t";
       
       //$host = "mail.tahiticv.com";
       //$port = "2525";
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
              print("Succ\351s de l'envoi!");
       }


function getmail($id){
       $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `annonces`.`id_annonceur` FROM `annonces` WHERE `annonces`.`ID` = '$id'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $annonceurid = $row[0];
    
    $query = "SELECT `users`.`email` FROM `users` WHERE `users`.`ID` = '$annonceurid'";
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
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
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
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
        $query = "INSERT INTO `".DB."`.`authorisations` (`ID`, `code`, `id_user`, `id_auth`, `date`) VALUES (NULL, '$token', '$id', '$auth_id', '$date')";
        $mysqli->query($query);
        $mysqli->close();
    }

    ?>