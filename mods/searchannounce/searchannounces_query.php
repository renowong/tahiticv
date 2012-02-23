<?php
include_once("../../includes/global_vars.php");
include_once("../../includes/security.php");
$id = $_COOKIE["user"];
$iles = $_POST["iles"];
$cat = $_POST["cat"];
$ar_iles = extract_from_string($iles);
$ar_cat = extract_from_string($cat);
$iles = compose_query($ar_iles,"id_ile");
$cat = compose_query($ar_cat,"id_categorie");

    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $response = "<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='1' msg='Recherche Termin&eacute;e'>";
    
    $fav = getfav($id);
    
    $query = "SELECT * FROM `annonces` WHERE ($iles) AND ($cat) AND `activation`='1'"; 
    if ($result = $mysqli->query($query)) {

    while($row = $result->fetch_assoc()){
        if(stristr($fav,"|".$row["ID"]."|")){$isfav='1';}else{$isfav='0';};
        $response .= "<announce><id>".tencode($row["ID"])."</id>";
        $response .= "<title>".$row["titre"]."</title>";
        $response .= "<id_ile>".$row["id_ile"]."</id_ile>";
        $response .= "<id_categorie>".$row["id_categorie"]."</id_categorie>";
        $response .= "<ref_interne>".$row["ref_interne"]."</ref_interne>";
        $response .= "<desc_poste>".$row["desc_poste"]."</desc_poste>";
        $response .= "<desc_dip>".$row["desc_dip"]."</desc_dip>";
        $response .= "<desc_exp>".$row["desc_exp"]."</desc_exp>";
        $response .= "<desc_comp>".$row["desc_comp"]."</desc_comp>";
        $response .= "<type_contrat>".$row["type_contrat"]."</type_contrat>";
        $response .= "<expiration>".$row["date_expiration"]."</expiration>";
        $response .= "<isfav>$isfav</isfav></announce>";
    }
    $result->free();
    }
    
    $mysqli->close();
    $response .= "</response>";
    print $response;
    //print $query;
    
    function extract_from_string($str){
      $str = str_replace("||","|",$str);
      //clean up the beginning and the end with substring...
      $pipe = substr($str,0,1);
      if($pipe=="|"){$str=substr($str,1);}
      $pipe = substr($str,-1,1);
      if($pipe=="|"){$str=substr($str,0,-1);}
      
      $ar_str = explode("|",$str);
      return $ar_str;
    }
    
    function compose_query($ar,$col){
        foreach ($ar as $value) {
            $query .= "`$col` = '$value' OR ";
        }
        $query=substr($query,0,-4);
        return $query;
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