<?php
include_once("../../includes/global_vars.php");
include_once("../../includes/security.php");
include("../../includes/date_functions.php");
header('Content-Type: text/xml');

$id = $_COOKIE["user"];
$announce = tdecode($_GET["id"]);

    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $response = "<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='1' msg='Module Annonce Charg&eacute;'>";
    if($announce>0){
        $query = "SELECT * FROM `annonces` WHERE `ID` = $announce"; 
    }else{
        $query = "SELECT * FROM `annonces` WHERE `id_annonceur` = $id";
    }
    if ($result = $mysqli->query($query)) {

    while($row = $result->fetch_assoc()){
        $response .= "<announce><id>".tencode($row["ID"])."</id>";
        $response .= "<activation>".$row["activation"]."</activation>";
        $response .= "<title>".$row["titre"]."</title>";
        $response .= "<id_ile>".$row["id_ile"]."</id_ile>";
        $response .= "<id_categorie>".$row["id_categorie"]."</id_categorie>";
        $response .= "<ref_interne>".$row["ref_interne"]."</ref_interne>";
        $response .= "<desc_poste>".$row["desc_poste"]."</desc_poste>";
        $response .= "<desc_dip>".$row["desc_dip"]."</desc_dip>";
        $response .= "<desc_exp>".$row["desc_exp"]."</desc_exp>";
        $response .= "<desc_comp>".$row["desc_comp"]."</desc_comp>";
        $response .= "<type_contrat>".$row["type_contrat"]."</type_contrat>";
        $response .= "<expiration>".to_french_format($row["date_expiration"])."</expiration>";
        $response .= "<lat>".$row["lat"]."</lat>";
        $response .= "<lon>".$row["lon"]."</lon></announce>";
    }
    $result->free();
}
    
    $mysqli->close();
    $response .= "</response>";
    print $response;
?>