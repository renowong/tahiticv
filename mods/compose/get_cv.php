<?php
include_once("../../includes/global_vars.php");
include_once("../../includes/security.php");
$id = $_COOKIE["user"];

    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $response = "<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='1' msg='Module CV Charg&eacute;'>";
    $query = "SELECT  * FROM  `cv` WHERE `id_user` = $id";
    if ($result = $mysqli->query($query)) {

    $row = $result->fetch_assoc();
    $response .= "<idcv>".tencode($row["ID"])."</idcv>";
    $response .= "<nom>".html_entity_decode($row["nom"], ENT_QUOTES, 'UTF-8')."</nom>";
    $response .= "<prenom>".html_entity_decode($row["prenom"], ENT_QUOTES, 'UTF-8')."</prenom>";
    $response .= "<prenom2>".html_entity_decode($row["prenom2"], ENT_QUOTES, 'UTF-8')."</prenom2>";
    $response .= "<dn>".$row["date_naissance"]."</dn>";
    $response .= "<open>".$row["open"]."</open>";
    $response .= "<avatar>".$row["image"]."</avatar>";
    $response .= "<adresse>".html_entity_decode($row["adresse"], ENT_QUOTES, 'UTF-8')."</adresse>";
    $response .= "<telephone>".$row["telephone"]."</telephone>";
    $response .= "<mobile>".$row["mobile"]."</mobile>";
    $response .= "<fax>".$row["fax"]."</fax>";
    $response .= "<email>".$row["email"]."</email>";    
    $response .= "<web>".$row["web"]."</web>";
    $response .= "<objectif>".html_entity_decode($row["objectif"], ENT_QUOTES, 'UTF-8')."</objectif>";
    $response .= "<experiences_ids>".$row["experiences_ids"]."</experiences_ids>";
    $response .= "<educations_ids>".$row["educations_ids"]."</educations_ids>";
    $response .= "<certifications_ids>".$row["certifications_ids"]."</certifications_ids>";
    $response .= "<competences_ids>".$row["competences_ids"]."</competences_ids>";
    $response .= "<langues_ids>".$row["langues_ids"]."</langues_ids>";
    $response .= "<centre_interets_ids>".$row["centre_interets_ids"]."</centre_interets_ids>";
    $response .= "<expire>".$row["date_expiration"]."</expire>";
    $result->free();
}
    
    $mysqli->close();
    $response .= "</response>";
    print $response;
?>