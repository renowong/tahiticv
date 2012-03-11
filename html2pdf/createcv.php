<?php

require_once ('html2pdf.class.php');
require_once ('../includes/global_vars.php');
include_once("../includes/security.php");
$search_id = tdecode($_GET["id"]);
//print $search_id;


    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }

        $query = "SELECT `cv`.`open`, REPLACE(`cv`.`objectif`, '\n', '<br/>') AS `objectif` , `cv`.`experiences_ids`, `cv`.`educations_ids`, `cv`.`certifications_ids`, `cv`.`competences_ids`, `cv`.`langues_ids`, `cv`.`centre_interets_ids` FROM `cv` WHERE `cv`.`ID` = $search_id";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
        //if($row["open"]=='1'){$usr = getusr($search_id);}else{$usr = "<tr><th colspan='2'>CV num&eacute;ro $search_id</th></tr>";}
        $usr = getusr($search_id);
	if(strlen($row["experiences_ids"])>1){$exp = getpipedexp($row["experiences_ids"]);}
        if(strlen($row["educations_ids"])>1){$dip = getpipeddip($row["educations_ids"]);}
        if(strlen($row["certifications_ids"])>1){$cert = getpipedcert($row["certifications_ids"]);}
        if(strlen($row["competences_ids"])>1){$comp = getpipedcomp($row["competences_ids"]);}
        if(strlen($row["langues_ids"])>1){$lang = getpipedlang($row["langues_ids"]);}
	if(strlen($row["centre_interets_ids"])>1){$cint = getpipedcint($row["centre_interets_ids"]);}
        $objectif = $row["objectif"];
        
	$output = "<page backtop='10mm' backbottom='10mm' backleft='10mm' backright='10mm'>$usr";
        $output .= "<tr><td style='vertical-align:top;'><b>Objectif : </b></td><td>$objectif<br/><br/></td></tr>";
        $output .= $exp;
        $output .= $dip;
        $output .= $cert;
        $output .= $comp;
        $output .= $lang;
	$output .= $cint;
        $output .= "</table></page>";   

//print $query;

genpdf($output,$search_id);
//print $output;

function birthday($birthday){
    list($year,$month,$day) = explode("-",$birthday);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0)
      $year_diff--;
    return $year_diff;
  }


function genpdf($content,$search_id){
    $html2pdf = new HTML2PDF('P','A4','fr', true);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('cv.pdf');
    header("Content-type: application/pdf"); 
    header("Content-Disposition: attachment; filename=cv_$search_id.pdf"); 
    readFile("cv.pdf");
}


function getusr($search_id){
       $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `cv`.`nom`, `cv`.`prenom`, `cv`.`prenom2`, `cv`.`image`, `cv`.`date_naissance`, `cv`.`adresse`, `cv`.`telephone`, `cv`.`mobile`, `cv`.`fax`, `cv`.`email`, `cv`.`web` FROM `cv` WHERE `cv`.`ID` = $search_id";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $nom = $row["nom"];
    $prenom = $row["prenom"];
    $prenom2 = $row["prenom2"];
    $avatar = $row["image"];
    $dn = $row["date_naissance"];
    $adresse = $row["adresse"];
    $tel = $row["telephone"];
    $vini = $row["mobile"];
    $fax = $row["fax"];
    $email = $row["email"];
    $web = $row["web"];
    
    $output .= "<page_footer>";
    $output .= "<table style='width: 100%; border: solid 1px black;'>";
    $output .= "<tr>";
    $output .= "<td style='text-align: left;    width: 50%'>Curriculum Vitae : $nom $prenom $prenom2</td>";
    $output .= "<td style='text-align: right;    width: 50%'>page [[page_cu]]/[[page_nb]]</td>";
    $output .= "</tr>";
    $output .= "</table>";
    $output .= "</page_footer>";
    $output .= "<table style='width:100%;border:solid 1px black;'>";
    $output .= "<tr>";
    $output .= "<td style='text-align:center;width:100%;padding-left:20px;font-size:18px;font-weight:bold;'>$nom $prenom $prenom2</td>";
    $output .= "</tr>";
    $output .= "</table><br/>";
    $output .= "<div style='position:absolute;top:50px;left:500px;z-index:20;'><img src='../cropscript/assets/images/uploads/crops/$avatar'/></div>";
    $output .= "<table style='width:100%;'><tr><td style='width:10%;vertical-align:top;'><b>Age :</b> </td><td style='width:90%;'>".birthday($dn)." ans</td></tr>";
    if($adresse!==""){$output .= "<tr><td style='vertical-align:top;'><b>Adresse :</b> </td><td>$adresse</td></tr>";}
    if($tel!==""){$output .= "<tr><td style='vertical-align:top;'><b>T&eacute;l&eacute;phone :</b> </td><td>$tel</td></tr>";}
    if($vini!==""){$output .= "<tr><td style='vertical-align:top;'><b>Vini :</b> </td><td>$vini</td></tr>";}
    if($fax!==""){$output .= "<tr><td style='vertical-align:top;'><b>Fax :</b> </td><td>$fax</td></tr>";}
    if($web!==""){$output .= "<tr><td style='vertical-align:top;'><b>Site Web :</b> </td><td>$web<br/><br/></td></tr>";}
    //$output .= "</td></tr>";
    
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
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $filter = " WHERE";
    
    foreach ($ar as $v) {
        $filter .= " `competences` .`ID`='$v' OR";
    }
    $filter = substr($filter,0,-3);

    $query = "SELECT `competences`.`competence` FROM `competences`".$filter;
    $output = "<tr><td colspan='2'><br/><b>Comp&eacute;tences : </b></td></tr><tr><td colspan='2' style='padding-left:20px;'><table style='width:100%;'>";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){
        $output .= "<tr><td style='width:100%;'>- ".$row["competence"];
        $output .= "<br/></td></tr>";
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
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $filter = " WHERE";
    
    foreach ($ar as $v) {
        $filter .= " `langues` .`ID`='$v' OR";
    }
    $filter = substr($filter,0,-3);

    $query = "SELECT `langues`.`langue`,`langues`.`obs` FROM `langues`".$filter;
    $output = "<tr><td colspan='2'><br/><b>Langues : </b></td></tr><tr><td colspan='2' style='padding-left:20px;'><table style='width:100%;'>";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){
        $output .= "<tr><td style='width:100%;'>- ".$row["langue"]." <i>[".$row["obs"]."]</i>";
        $output .= "<br/></td></tr>";
    }
    
    $output .= "</table></td></tr>";
    
//print $query;    
    return $output;
}

function getpipedcint($str){
    $str = substr($str,1);
    $str = substr($str,0,-1);
    $ar = explode("|",$str);
    
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $filter = " WHERE";
    
    foreach ($ar as $v) {
        $filter .= " `centre_interets` .`ID`='$v' OR";
    }
    $filter = substr($filter,0,-3);

    $query = "SELECT `centre_interets`.`centre_interet` FROM `centre_interets`".$filter;
    $output = "<tr><td colspan='2'><br/><b>Centre d'int&eacute;r&ecirc;ts : </b></td></tr><tr><td colspan='2' style='padding-left:20px;'><table style='width:100%;'>";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){
        $output .= "<tr><td style='width:100%;'>- ".$row["centre_interet"];
        $output .= "<br/></td></tr>";
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
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $filter = " WHERE";
    
    foreach ($ar as $v) {
        $filter .= " `certifications` .`ID`='$v' OR";
    }
    $filter = substr($filter,0,-3);

    $query = "SELECT `certifications`.`certificat`,`certifications`.`ecole`,`certifications`.`localisation_ecole`,`certifications`.`desc_certificat`,`certifications`.`mention`,`certifications`.`annee` FROM `certifications`".$filter;
    $output = "<tr><td colspan='2'><b>Certifications : </b></td></tr><tr><td colspan='2' style='padding-left:20px;'><table style='width:100%;'>";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){
        $output .= "<tr><td style='width:100%;'><b>Certificat :</b> ".$row["certificat"]." <i>[".$row["annee"]."]</i>";
        $output .= "<br/><b>Ecole :</b> ".$row["ecole"]." <i>[".$row["localisation_ecole"]."]</i>";
        $output .= "<br/><b>Description du certificat :</b> ".$row["desc_certificat"];
        if(!$row["mention"]==''){$output .= "<br/><b>Mention :</b> ".$row["mention"];}
        $output .= "<br/><br/></td></tr>";
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
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $filter = " WHERE";
    
    foreach ($ar as $v) {
        $filter .= " `educations` .`ID`='$v' OR";
    }
    $filter = substr($filter,0,-3);

    $query = "SELECT `educations`.`ecole`,`educations`.`localisation_ecole`,`educations`.`desc_diplome`,`educations`.`mention`,`educations`.`annee`,`liste_diplomes`.`desc` AS `diplome` FROM `educations` JOIN `liste_diplomes` ON `educations`.`type_diplome`=`liste_diplomes`.`ID`".$filter;
    $output = "<tr><td colspan='2'><b>Dipl&ocirc;mes : </b></td></tr><tr><td colspan='2' style='padding-left:20px;'><table style='width:100%;'>";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){
        $output .= "<tr><td style='width:100%;'><b>Dipl&ocirc;me :</b> ".$row["diplome"]." <i>[".$row["annee"]."]</i>";
        $output .= "<br/><b>Ecole :</b> ".$row["ecole"]." <i>[".$row["localisation_ecole"]."]</i>";
        $output .= "<br/><b>Description du dipl&ocirc;me :</b> ".$row["desc_diplome"];
        if(!$row["mention"]==''){$output .= "<br/><b>Mention :</b> ".$row["mention"];}
        $output .= "<br/><br/></td></tr>";
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
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $filter = " WHERE";
    
    foreach ($ar as $v) {
        $filter .= " `experiences`.`ID`='$v' OR";
    }
    $filter = substr($filter,0,-3);

    $query = "SELECT `experiences`.`entreprise`,`experiences`.`description`,`experiences`.`competences_ids`,`experiences`.`titre_poste`,`experiences`.`present`,`d_mois`.`desc` AS `debutmois`,`experiences`.`debut_annee`,`f_mois`.`desc` AS `finmois`,`experiences`.`fin_annee`,`liste_secteurs`.`desc` AS `secteur` FROM (((`experiences` JOIN `liste_secteurs` ON `experiences`.`secteur_id`=`liste_secteurs`.`ID`) JOIN `liste_mois` AS `d_mois` ON `experiences`.`debut_mois`=`d_mois`.`ID`) JOIN `liste_mois` AS `f_mois` ON `experiences`.`fin_mois`=`f_mois`.`ID`)".$filter;
    $output = "<tr><td colspan='2'><b>Exp&eacute;rience(s) Professionnelles : </b></td></tr><tr><td colspan='2' style='padding-left:20px;'><table style='width:100%;'>";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){
        if($row["present"]=='1'){$finexp="Pr&eacute;sent";}else{$finexp=$row["finmois"]."-".$row["fin_annee"];}
        $competences = buildcompexp($row["competences_ids"]);
        $output .= "<tr><td style='width:100%;'><b>Entreprise :</b> ".$row["entreprise"]." <i>[".$row["debutmois"]."-".$row["debut_annee"]." &agrave; $finexp]</i>".
                    "<br/><b>Secteur :</b> ".$row["secteur"].
                    "<br/><b>Titre :</b> ".$row["titre_poste"].
                    "<br/><b>Description :</b> ".$row["description"].$competences.
                    "<br/><br/></td></tr>";
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
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
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