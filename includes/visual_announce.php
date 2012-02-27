<?php
include_once("global_vars.php");
include_once("security.php");
$search_id = tdecode($_GET["id"]);
$showwhat = $_GET["showwhat"];
$id = $_COOKIE["user"];

    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
switch($showwhat){
    case "announce":
    $query = "SELECT `annonces`.`titre`,`iles`.`ile`,`categories`.`categorie`,`annonces`.`ref_interne`,".
            "`annonces`.`desc_poste`,`annonces`.`desc_dip`,`annonces`.`desc_exp`,`annonces`.`desc_comp`,".
            "`contrats`.`contrat`,`annonces`.`date_expiration`,`annonces`.`lat`,`annonces`.`lon`".
            " FROM (((`annonces` JOIN `iles` ON `annonces`.`id_ile`=`iles`.`ID`) ".
            "JOIN `categories` ON `annonces`.`id_categorie`=`categories`.`ID`) ".
            "JOIN `contrats` ON `annonces`.`type_contrat`=`contrats`.`ID`) WHERE `annonces`.`ID` = $search_id";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
        $title = $row["titre"];
        $ile = $row["ile"];
        $categorie = $row["categorie"];
        $ref_interne = $row["ref_interne"];
        $desc_poste = $row["desc_poste"];
        $desc_dip = $row["desc_dip"];
        $desc_exp = $row["desc_exp"];
        $desc_comp = $row["desc_comp"];
        $type_contrat = $row["contrat"];
        $expiration = $row["date_expiration"];
        $lat = $row["lat"];
        $lon = $row["lon"];

    $result->free();   
    $mysqli->close();
    
    $output = "<table style='width:100%;'><tr><td style='text-align:right;'>".
            "<span id='email'><a href='javascript:sendmail(".$search_id.");'>Envoyer votre CV pour cette annonce</a></span> | <a href='javascript:void(0)' onclick='close_visu()'><img style='vertical-align: middle;' height='30px' src='images/close.png'/></a></td></tr></table><br/>";
    $output .= "<table style='width:100%;'><tr><th colspan='2'>$title</th></tr>".
            "<tr><td><b>Cat&eacute;gorie de l'emloi : </b></td><td>$categorie</td></tr>".
            "<tr><td><b>Localisation de l'emploi : </b></td><td>$ile</td></tr>".
            "<tr><td><b>R&eacute;f&eacute;rence interne : </b></td><td>$ref_interne</td></tr>".
            "<tr><td><b>Type de contrat propos&eacute; : </b></td><td>$type_contrat</td></tr>".
            "<tr><td><b>Description du poste : </b></td><td>$desc_poste</td></tr>".
            "<tr><td><b>Description des comp&eacute;tences requises : </b></td><td>$desc_comp</td></tr>".
            "<tr><td><b>Description des exp&eacute;riences requises : </b></td><td>$desc_exp</td></tr>".
            "<tr><td><b>Dipl&ocirc;me(s) requis : </b></td><td>$desc_dip</td></tr>".
            "<tr><td colspan='2'><input type='hidden' id='visu_lat' value='$lat'/><input type='hidden' id='visu_lon' value='$lon'/><div id='map_canvas_visual'>map</div></td></tr>".
            "</table>";
    break;

    case "cv":
        $query = "SELECT `cv`.`open`, `cv`.`auth_ids`, `cv`.`objectif`, `cv`.`experiences_ids`, `cv`.`educations_ids`, `cv`.`certifications_ids`, `cv`.`competences_ids`, `cv`.`langues_ids` FROM `cv` WHERE `cv`.`ID` = $search_id";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
        $auth = preg_match("/\|$id\|/",$row['auth_ids']);
        if($row["open"]=='1' || $auth=='1'){
            $usr = getusr($search_id);
            $pdf = "<a href='javascript:downloadpdf(".$_GET["id"].");'><img style='vertical-align: middle;' height='30px' src='images/pdf_icon.png'/></a> | ";
        }else{
            $usr = "<tr><th colspan='2'>CV num&eacute;ro ".$_GET["id"]."</th></tr>";
            $pdf = "<span id='email'><a href='javascript:sendmail(".$_GET["id"].");'>Envoyer une demande pour CV complet</a></span> | ";
        }
        if(strlen($row["experiences_ids"])>1){$exp = getpipedexp($row["experiences_ids"]);}
        if(strlen($row["educations_ids"])>1){$dip = getpipeddip($row["educations_ids"]);}
        if(strlen($row["certifications_ids"])>1){$cert = getpipedcert($row["certifications_ids"]);}
        if(strlen($row["competences_ids"])>1){$comp = getpipedcomp($row["competences_ids"]);}
        if(strlen($row["langues_ids"])>1){$lang = getpipedlang($row["langues_ids"]);}
        $objectif = $row["objectif"];
        

        $output = "<table style='width:100%;'><tr><td style='text-align:right;'>$pdf<a href='javascript:void(0)' onclick='close_visu()'><img style='vertical-align: middle;' height='30px' src='images/close.png'/></a></td></tr></table><br/>";
        $output .= "<table style='width:100%;'>$usr";
        $output .= "<tr><td style='width:120px;'><b>Objectif : </b></td><td>$objectif</td></tr>";
        $output .= $exp;
        $output .= $dip;
        $output .= $cert;
        $output .= $comp;
        $output .= $lang;
        $output .= "</table>";       
    break;

}

function birthday($birthday){
    list($year,$month,$day) = explode("-",$birthday);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0)
      $year_diff--;
    return $year_diff;
  }

function getusr($search_id){
       $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `cv`.`nom`, `cv`.`prenom`, `cv`.`prenom2`, `cv`.`date_naissance`, `cv`.`adresse`, `cv`.`telephone`, `cv`.`mobile`, `cv`.`fax`, `cv`.`email`, `cv`.`web` FROM `cv` WHERE `cv`.`ID` = $search_id";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $nom = $row["nom"];
    $prenom = $row["prenom"];
    $prenom2 = $row["prenom2"];
    $dn = $row["date_naissance"];
    $adresse = $row["adresse"];
    $tel = $row["telephone"];
    $vini = $row["mobile"];
    $fax = $row["fax"];
    $email = $row["email"];
    $web = $row["web"];
    
    $output = "<tr><th colspan='2'>$nom $prenom $prenom2</th></tr>";
    $output .= "<tr><td><b>Age :</b> </td><td>".birthday($dn)." ans</td></tr>";
    if($adresse!==""){$output .= "<tr><td><b>Adresse :</b> </td><td>$adresse</td></tr>";}
    if($tel!==""){$output .= "<tr><td><b>T&eacute;l&eacute;phone :</b> </td><td>$tel</td></tr>";}
    if($vini!==""){$output .= "<tr><td><b>Vini :</b> </td><td>$vini</td></tr>";}
    if($fax!==""){$output .= "<tr><td><b>Fax :</b> </td><td>$fax</td></tr>";}
    if($web!==""){$output .= "<tr><td><b>Site Web :</b> </td><td>$web</td></tr>";}
    $output .= "</td></tr>";
    
    return $output;
}

function getpipedcomp($str){
    $str = substr($str,1);
    $str = substr($str,0,-1);
    $ar = explode("|",$str);
    
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $filter = " WHERE";
    
    foreach ($ar as $v) {
        $filter .= " `competences` .`ID`='$v' OR";
    }
    $filter = substr($filter,0,-3);

    $query = "SELECT `competences`.`competence` FROM `competences`".$filter;
    $output = "<tr><td colspan='2'><b>Comp&eacute;tences : </b></td></tr><tr><td colspan='2'><table style='border:solid 1px;width:100%;'>";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){
        $output .= "<tr><td style='border:solid 1px;'><b>Competence :</b> ".$row["competence"];
        $output .= "</td></tr>";
    }
    
    $output .= "</table></td></tr>";
    
//print $query;    
    return $output;
}


function getpipedlang($str){
    $str = substr($str,1);
    $str = substr($str,0,-1);
    $ar = explode("|",$str);
    
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $filter = " WHERE";
    
    foreach ($ar as $v) {
        $filter .= " `langues` .`ID`='$v' OR";
    }
    $filter = substr($filter,0,-3);

    $query = "SELECT `langues`.`langue`,`langues`.`obs` FROM `langues`".$filter;
    $output = "<tr><td colspan='2'><b>Langues : </b></td></tr><tr><td colspan='2'><table style='border:solid 1px;width:100%;'>";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){
        $output .= "<tr><td style='border:solid 1px;'><b>Langue :</b> ".$row["langue"]." <i>[".$row["obs"]."]</i>";
        $output .= "</td></tr>";
    }
    
    $output .= "</table></td></tr>";
    
//print $query;    
    return $output;
}

function getpipedcert($str){
    $str = substr($str,1);
    $str = substr($str,0,-1);
    $ar = explode("|",$str);
    
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $filter = " WHERE";
    
    foreach ($ar as $v) {
        $filter .= " `certifications` .`ID`='$v' OR";
    }
    $filter = substr($filter,0,-3);

    $query = "SELECT `certifications`.`certificat`,`certifications`.`ecole`,`certifications`.`localisation_ecole`,`certifications`.`desc_certificat`,`certifications`.`mention`,`certifications`.`annee` FROM `certifications`".$filter;
    $output = "<tr><td colspan='2'><b>Certifications : </b></td></tr><tr><td colspan='2'><table style='border:solid 1px;width:100%;'>";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){
        $output .= "<tr><td style='border:solid 1px;'><b>Certificat :</b> ".$row["certificat"]." <i>[".$row["annee"]."]</i>";
        $output .= "<br/><b>Ecole :</b> ".$row["ecole"]." <i>[".$row["localisation_ecole"]."]</i>";
        $output .= "<br/><b>Description du certificat :</b> ".$row["desc_certificat"];
        if(!$row["mention"]==''){$output .= "<br/><b>Mention :</b> ".$row["mention"];}
        $output .= "</td></tr>";
    }
    
    $output .= "</table></td></tr>";
    
//print $query;    
    return $output;
}

function getpipeddip($str){
    $str = substr($str,1);
    $str = substr($str,0,-1);
    $ar = explode("|",$str);
    
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $filter = " WHERE";
    
    foreach ($ar as $v) {
        $filter .= " `educations` .`ID`='$v' OR";
    }
    $filter = substr($filter,0,-3);

    $query = "SELECT `educations`.`ecole`,`educations`.`localisation_ecole`,`educations`.`desc_diplome`,`educations`.`mention`,`educations`.`annee`,`liste_diplomes`.`desc` AS `diplome` FROM `educations` JOIN `liste_diplomes` ON `educations`.`type_diplome`=`liste_diplomes`.`ID`".$filter;
    $output = "<tr><td colspan='2'><b>Dipl&ocirc;mes : </b></td></tr><tr><td colspan='2'><table style='border:solid 1px;width:100%;'>";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){
        $output .= "<tr><td style='border:solid 1px;'><b>Dipl&ocirc;me :</b> ".$row["diplome"]." <i>[".$row["annee"]."]</i>";
        $output .= "<br/><b>Ecole :</b> ".$row["ecole"]." <i>[".$row["localisation_ecole"]."]</i>";
        $output .= "<br/><b>Description du dipl&ocirc;me :</b> ".$row["desc_diplome"];
        if(!$row["mention"]==''){$output .= "<br/><b>Mention :</b> ".$row["mention"];}
        $output .= "</td></tr>";
    }
    
    $output .= "</table></td></tr>";
    
//print $query;    
    return $output;
}


function getpipedexp($str){
    $str = substr($str,1);
    $str = substr($str,0,-1);
    $ar = explode("|",$str);
    
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $filter = " WHERE";
    
    foreach ($ar as $v) {
        $filter .= " `experiences`.`ID`='$v' OR";
    }
    $filter = substr($filter,0,-3);

    $query = "SELECT `experiences`.`entreprise`,`experiences`.`description`,`experiences`.`competences_ids`,`experiences`.`titre_poste`,`experiences`.`present`,`d_mois`.`desc` AS `debutmois`,`experiences`.`debut_annee`,`f_mois`.`desc` AS `finmois`,`experiences`.`fin_annee`,`liste_secteurs`.`desc` AS `secteur` FROM (((`experiences` JOIN `liste_secteurs` ON `experiences`.`secteur_id`=`liste_secteurs`.`ID`) JOIN `liste_mois` AS `d_mois` ON `experiences`.`debut_mois`=`d_mois`.`ID`) JOIN `liste_mois` AS `f_mois` ON `experiences`.`fin_mois`=`f_mois`.`ID`)".$filter;
    $output = "<tr><td colspan='2'><b>Exp&eacute;rience(s) Professionnelles : </b></td></tr><tr><td colspan='2'><table style='border:solid 1px;width:100%;'>";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){
        if($row["present"]=='1'){$finexp="Pr&eacute;sent";}else{$finexp=$row["finmois"]."-".$row["fin_annee"];}
        $competences = buildcompexp($row["competences_ids"]);
        $output .= "<tr><td style='border:solid 1px;'><b>Entreprise :</b> ".$row["entreprise"]." <i>[".$row["debutmois"]."-".$row["debut_annee"]."&rarr;$finexp]</i>".
                    "<br/><b>Secteur :</b> ".$row["secteur"].
                    "<br/><b>Titre :</b> ".$row["titre_poste"].
                    "<br/><b>Description :</b> ".$row["description"].$competences.
                    "</td></tr>";
    }
    
    $output .= "</table></td></tr>";
    
//print $query;    
    return $output;
}

function buildcompexp($str){
    $str = substr($str,1);
    $str = substr($str,0,-1);
    $ar = explode("|",$str);
    
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $filter = " WHERE";
    
    foreach ($ar as $v) {
        $filter .= " `competences`.`ID`='$v' OR";
    }
    $filter = substr($filter,0,-3);
    
    $query = "SELECT `competences`.`competence` FROM `competences`".$filter;
    
    $result = $mysqli->query($query);
    $row_cnt = $result->num_rows;
    if($row_cnt>0){$output="<br/><b>Comp&eacute;tences :</b>";}
    while($row = $result->fetch_assoc()){
        $output .= " - ".$row["competence"];
    }
    return $output;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
</head>
<body>
    <?php print $output; ?>
</body>
</html>
