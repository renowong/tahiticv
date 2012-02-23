<?php
include_once("includes/global_vars.php");
$id = $_COOKIE["user"];
check_existing_cv($id);


function check_existing_cv($id){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT * FROM `cv` WHERE `id_user` = $id";
        if ($result = $mysqli->query($query)) {
        $num_rows = $result->num_rows;
        $result->close();
        $mysqli->close();
        if ($num_rows==0) {
            //cv doesn't exist, create one
            create_empty_cv($id);
        }else{
            //cv exist, retrieve data
        }
    }
}

function create_empty_cv($id){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    $email = getemail($id);
    $query = "INSERT INTO `".DB."`.`cv` (`ID`, `id_user`, `date_expiration`, `open`, `image`, `nom`, `prenom`, `prenom2`, `date_naissance`, `adresse`, `telephone`, `mobile`, `fax`, `email`, `web`, `objectif`, `educations_ids`, `experiences_ids`, `certifications_ids`, `competences_ids`, `langues_ids`, `loisirs_ids`) VALUES (NULL, '$id', '1900-01-01', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$email', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
    $mysqli->query($query);
    $mysqli->close();
}

function getemail($id){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    $query = "SELECT `email` FROM `users` WHERE `ID` = $id";
    if ($result = $mysqli->query($query)) {
    $row = $result->fetch_assoc();
    $email = $row["email"];
    }
    $result->close();
    $mysqli->close();
    return $email;
}

?>