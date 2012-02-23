<?php
include_once("../../includes/global_vars.php");
include_once("../../includes/security.php");
$id = $_COOKIE["user"];
$cat = $_POST["cat"];
$dip = $_POST["dip"];

getdata($cat,$dip,$id);


function getdata($cat,$dip,$id){
$query = "SELECT DISTINCT `cv`.`ID`, `cv`.`open`, `cv`.`auth_ids`, `cv`.`nom`, `cv`.`prenom` FROM ((`cv` JOIN `users` ON `users`.`ID` = `cv`.`id_user`) LEFT JOIN `educations` ON `cv`.`ID` = `educations`.`id_cv`)";
if(!$cat==""){
    $query .= " WHERE `users`.`categories_ids` LIKE '%|$cat|%'";
    $qfilter = " AND";
} else {
    $qfilter = " WHERE";
}

if(!$dip==""){
    $query .= "$qfilter `educations`.`type_diplome` = '$dip'";
}

if($cat=="" && $dip==""){
    $query .= " WHERE `date_expiration` >= '" . date("Y-m-d") . "'";
    } else {
    $query .= " AND `date_expiration` >= '" . date("Y-m-d") . "'";
}

    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $response = "<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='1' msg='Recherche Termin&eacute;e'>";
    $fav = getfav($id);
    
    if ($result = $mysqli->query($query)) {

    while($row = $result->fetch_assoc()){
        //if(stristr($fav,"|".$row["ID"]."|")){$isfav='1';}else{$isfav='0';};
        if(preg_match("/\|".$row["ID"]."\|/",$fav)){$isfav='1';}else{$isfav='0';};
        $auth = preg_match("/\|$id\|/",$row['auth_ids']);
        if($row["open"]=='1' || $auth=='1'){$open=1;}else{$open=0;}
        $response .= "<cv>";
        $response .= "<id>".tencode($row["ID"])."</id>";
        //$response .= "<open>".$row["open"]."</open>";
        $response .= "<open>$open</open>";
        $response .= "<nom>".$row["nom"]."</nom>";
        $response .= "<prenom>".$row["prenom"]."</prenom>";
        $response .= "<isfav>$isfav</isfav>";
        $response .= "</cv>";
    }
    $result->free();
    }
    
    $mysqli->close();
    $response .= "</response>";
    print $response;
}

function getfav($iduser){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `users`.`fav_ids` FROM `users` WHERE `users`.`ID`='$iduser'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $fav = $row[0];
    $result->close();
    $mysqli->close();
    return $fav;
    
}
?>