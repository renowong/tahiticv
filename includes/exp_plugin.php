<?php
include_once("../includes/global_vars.php");
include_once("../includes/security.php");
$id = $_GET["id"];
$idcv = tdecode($_GET["idcv"]);
$expid = $_GET["expid"]+0; //get and convert to integer


/*generate new id for experience*/
if($expid>0){ //else load existing
    $ar_results = getdivdata($expid);
    //print_r($ar_results);
    $titre_value = $ar_results["titre_poste"];
    $ent_value = $ar_results["entreprise"];
    $sect_value = $ar_results["secteur_id"];
    $lieu_value = $ar_results["lieu"];
    $mois_debut_value = $ar_results["debut_mois"];
    $annee_debut_value = $ar_results["debut_annee"];
    $mois_fin_value = $ar_results["fin_mois"];
    $annee_fin_value = $ar_results["fin_annee"];
    $present_value = $ar_results["present"];
    $description_value = $ar_results["description"];
    $competences_value = $ar_results["competences_ids"];
    if($competences_value!=="" || $competences_value!=="|"){
        $competences_list = retrieve_competences($competences_value);
    }
    
} else { //if new experience then load new
    $expid = newid($idcv,$id);
    update_cv($idcv,$expid);
}
$liste_mois_debut = get_liste_mois($mois_debut_value);
$present_checkbox = get_present_status($present_value);
if($present_checkbox){$annee_fin_value="";$mois_fin_value="1";}
$liste_mois_fin = get_liste_mois($mois_fin_value);
$liste_secteurs = get_liste_secteurs($sect_value);
$options_begin_year = gen_years($annee_debut_value);
$options_end_year = gen_years($annee_fin_value);

$output =   "<div name='$id' id='$id'><table style='width:100%'><tr><td>".
            "<label for='txt_titre_poste_$id'>Titre du poste : </label><br/><input type='text' name='txt_titre_poste_$id' id='txt_titre_poste_$id' size='50' maxlength='50' value='$titre_value' onblur='updatedata(\"experiences\",\"titre_poste\",this.value,\"letters\",\"$expid\");' /><br/>".
            "<label for='txt_entreprise_$id'>Entreprise : </label><br/><input type='text' name='txt_entreprise_$id' id='txt_entreprise_$id' size='35' maxlength='25' value='$ent_value' onblur='updatedata(\"experiences\",\"entreprise\",this.value,\"value\",\"$expid\");' /><br/>".
            "<label for='select_secteur_$id'>Secteur d&apos;Activit&eacute; : </label><br/><select name='select_secteur_$id' id='select_secteur_$id' onchange='updatedata(\"experiences\",\"secteur_id\",this.value,\"value\",\"$expid\");'>$liste_secteurs</select><br/>".
            "<label for='txt_lieu_$id'>Lieu : </label><br/><input type='text' name='txt_lieu_$id' id='txt_lieu_$id' size='35' maxlength='25' value='$lieu_value' onblur='updatedata(\"experiences\",\"lieu\",this.value,\"value\",\"$expid\");' /><br/>".
            "<label for='select_mois_debut_$id'>Date de d&eacute;but : </label><br/><select name='select_mois_debut_$id' id='select_mois_debut_$id' onchange='updatedata(\"experiences\",\"debut_mois\",this.value,\"value\",\"$expid\");'>$liste_mois_debut</select> <select name='slt_annee_debut' id='slt_annee_debut' onchange='updatedata(\"experiences\",\"debut_annee\",this.value,\"value\",\"$expid\");'>$options_begin_year</select><br/>".
            "<label for='select_mois_fin_$id'>Date de fin : </label><br/><select name='select_mois_fin_$id' id='select_mois_fin_$id' onchange='updatedata(\"experiences\",\"fin_mois\",this.value,\"value\",\"$expid\");'>$liste_mois_fin</select> <select name='slt_annee_debut' id='slt_annee_debut' onchange='updatedata(\"experiences\",\"fin_annee\",this.value,\"value\",\"$expid\");'>$options_end_year</select><br/>".
            "<label for='chk_present_$id'><input type='checkbox' name='chk_present_$id' id='chk_present_$id' onchange='updatedata(\"experiences\",\"present\",this.value,\"checkbox\",\"$expid\");' $present_checkbox/> Jusqu&apos;&agrave; pr&eacute;sent (cocher cette option ignore la date de fin).</label><br/><br/>".
            "<label for='txt_description_poste_$id'>Description du poste : </label><br/><textarea name='txt_description_poste_$id' id='txt_description_poste_$id' cols='40' rows='3' wrap='SOFT' onblur='updatedata(\"experiences\",\"description\",this.value,\"value\",\"$expid\");'>$description_value</textarea><br/>".
            "<label for='txt_competence_poste_$id'>Comp&eacute;tences acquises/requises pour le poste : </label><a href='javascript:void(0)' onclick='addcomp_exp_plugin($id,$expid,$idcv);'><img style='vertical-align: middle;' height='20px' src='images/add.png'/></a><br/>".
            "<div name='comp_exp_$id' id='comp_exp_$id'>$competences_list</div>".
            "<input type='hidden' name='expid' id='expid' value='$expid'></td>".
            "<td style='text-align:right;vertical-align:top;'><a href='javascript:void(0)' onclick='deletediv($id,\"experiences\",$expid)'><img src='images/trash.png' width='48' heigth='48'/></a></td></tr></table>";
            "</div>";

print $output;


/*functions*/

function gen_years($select){
    $thisyear = date("Y");
    for($i=1950;$i<=$thisyear;$i++){
        if($select==$i){$selected=" selected";}else{$selected="";}
        $options .= "<option value='$i'$selected>$i</option>";
    }
    return $options;
}

function retrieve_competences($liste){
    $liste = str_replace("||","|",$liste);
    //clean up the beginning and the end with substring...
    $pipe = substr($liste,0,1);
    if($pipe=="|"){$liste=substr($liste,1);}
    $pipe = substr($liste,-1,1);
    if($pipe=="|"){$liste=substr($liste,0,-1);}
    
    $ar_liste = explode("|",$liste);

    //return $liste;
    //process the array
    foreach ($ar_liste as $id) {
        if($id!==""){
        $comp_data = competencesdata($id);
        $output .= "<div name='div_competence_poste_$id' id='div_competence_poste_$id' style='display:inline;'><input type='text' name='txt_competence_poste_$id' id='txt_competence_poste_$id' size='50' maxlength='50' value='".$comp_data['competence']."' onblur='updatedata(\"competences\",\"competence\",this.value,\"value\",\"$id\");'/><a href='javascript:void(0)' onclick='delete_comp_exp(\"div_competence_poste_$id\",\"$id\",\"".tencode($comp_data['expid'])."\")'><img style='vertical-align: middle;' height='20px' src='images/trash.png'/></a></div>";
        }
    }
    return $output;
}

function competencesdata($id){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `expid`, `competence` FROM `competences` WHERE `ID` = '$id' ORDER BY `ID`";
    $result = $mysqli->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $result->free();
    $mysqli->close();
    return $row;
}

function getdivdata($expid) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT * FROM `experiences` WHERE `ID` = '$expid'";
    $result = $mysqli->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $result->free();
    $mysqli->close();
    return $row;
}

function get_liste_secteurs($secteur) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT  `ID`, `desc` FROM `liste_secteurs`";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_row()){
        if($secteur==$row[0]){$selected = " selected";}else{$selected = "";};
        $output .= "<option value='".$row[0]."'$selected>".$row[1]."</option>";
    }
    $result->free();
    $mysqli->close();
    return $output;
}

function get_liste_mois($mois) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT  `ID`, `desc` FROM `liste_mois`";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_row()){
        if($mois==$row[0]){$selected = " selected";}else{$selected = "";};
        $output .= "<option value='".$row[0]."'$selected>".$row[1]."</option>";
    }
    $result->free();
    $mysqli->close();
    return $output;
}

function get_present_status($present_value){
    if($present_value=='1'){return "checked";};
}


function newid($idcv,$id) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "INSERT INTO  `".DB."`.`experiences` ( `ID` , `id_cv`, `lieu` , `entreprise` , `secteur_id` , `debut_mois` , `debut_annee` , `fin_mois` , `fin_annee` , `present` , `titre_poste` , `competences_ids` , `description` ) VALUES ( NULL,  '$idcv', NULL, NULL, '1', '1', '1950', '1', '1950', NULL, NULL, NULL, NULL )";
    $mysqli->query($query);
    $lastid = $mysqli->insert_id;
    $mysqli->close();
    return $lastid;
}

function update_cv($idcv,$expid){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `experiences_ids` FROM `".DB."`.`cv` WHERE `ID` = '$idcv'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $existingdata = $row[0];
    $result->close();
    
    $expid = $existingdata."|".$expid."|";
    $expid = str_replace("||","|",$expid);
    
    $query = "UPDATE `".DB."`.`cv` SET `experiences_ids` = '$expid' WHERE `ID` = '$idcv'";
    $mysqli->query($query);
    $mysqli->close();
}

?>