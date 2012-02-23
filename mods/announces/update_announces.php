<?php
include_once("../../includes/global_vars.php");
include_once("../../includes/security.php");
include("../../includes/date_functions.php");

$id = $_COOKIE["user"];
$id_announce = tdecode($_POST["id_annonce"]);

    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    $titre = htmlentities ($_POST["titre"],ENT_QUOTES,'UTF-8');
    $categorie = $_POST["categorie"];
    $localisation = $_POST["localisation"];
    $ref = htmlentities ($_POST["ref"],ENT_QUOTES,'UTF-8');
    $type_contrat = $_POST["type_contrat"];
    $desc_poste = htmlentities ($_POST["desc_poste"],ENT_QUOTES,'UTF-8');
    $desc_comp = htmlentities ($_POST["desc_comp"],ENT_QUOTES,'UTF-8');
    $desc_exp = htmlentities ($_POST["desc_exp"],ENT_QUOTES,'UTF-8');
    $desc_dip = htmlentities ($_POST["desc_dip"],ENT_QUOTES,'UTF-8');
    $lat = $_POST["lat"];
    $lon = $_POST["lon"];
    $expires = to_mysql_format($_POST["expires"]);
    //$date = date("Y-m-d");
    //$expires = strtotime(" +1 month", strtotime($date));
    //$expires = date("Y-m-d",$expires);
    
    if($id_announce>0){
    $query = "UPDATE  `".DB."`.`annonces` SET  `id_ile` =  '$localisation',".
    "`id_categorie` =  '$categorie',".
    "`titre` =  '$titre',".
    "`ref_interne` =  '$ref',".
    "`desc_poste` =  '$desc_poste',".
    "`desc_dip` =  '$desc_dip',".
    "`desc_exp` =  '$desc_exp',".
    "`desc_comp` =  '$desc_comp',".
    "`type_contrat` =  '$type_contrat',".
    "`date_expiration` =  '$expires',".
    "`lat` =  '$lat',".
    "`lon` =  '$lon' WHERE  `annonces`.`ID` ='$id_announce'";
    
    $mysqli->query($query);
    $lastid = $mysqli->insert_id;
    $mysqli->close();
    print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='1' msg='Annonce mise &agrave; jour'>".
          "<announce update='1'><id>".tencode($id_announce)."</id>".
          "<title>$titre</title>".
          "<expiration>$expires</expiration>".
          "<debug>$lat</debug>".
          "</announce></response>");       
    }else{
    $query = "INSERT INTO `".DB."`.`annonces` (`ID`, `id_annonceur`, `id_ile`, `id_categorie`,".
            "`image`, `titre`, `ref_interne`, `desc_poste`, `desc_dip`, `desc_exp`, `desc_comp`,".
            "`type_contrat`, `date_expiration`, `lat`, `lon`) VALUES ".
            "(NULL, '$id', '$localisation', '$categorie', NULL, '$titre', '$ref', '$desc_poste', '$desc_dip', '$desc_exp', '$desc_comp', '$type_contrat', '$expires', '$lat', '$lon')";
    $mysqli->query($query);
    $lastid = $mysqli->insert_id;
    $mysqli->close();
    print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='1' msg='Nouvelle annonce cr&eacute;&eacute;e.'>".
          "<announce update='0'><id>".tencode($lastid)."</id>".
          "<title>$titre</title>".
          "<expiration>$expires</expiration>".
          "<debug>$lat</debug>".
          "</announce></response>");
    }
    
    
    
    

?>