<?php
include_once("../includes/global_vars.php");
include_once("../includes/security.php");
$id = $_GET["id"];
$idcv = tdecode($_GET["idcv"]);
$dipid = $_GET["dipid"] +0; //get and convert to integer

/*generate new id for education*/
if($dipid>0){ //else load existing
    $ar_results = getdivdata($dipid);
    //print_r($ar_results);
    $type_dip_value = $ar_results["type_diplome"];
    $annee_value = $ar_results["annee"];
    $mention_value = $ar_results["mention"];
    $desc_dip_value = $ar_results["desc_diplome"];
    $ecole_value = $ar_results["ecole"];
    $loc_ecole_value = $ar_results["localisation_ecole"];
    
} else { //if new diploma then load new
    $dipid = newid($idcv,$id);
    update_cv($idcv,$dipid);
}

$liste_diplomes = get_liste_diplomes($type_dip_value);
$options_year = gen_years($annee_value);

$output =   "<div name='$id' id='$id'><table style='width:100%'><tr><td><label for='select_diplome_$id'>Niveau d'&eacute;tudes : </label><br/>".
            "<select name='select_diplome_$id' id='select_diplome_$id' onchange='updatedata(\"educations\",\"type_diplome\",this.value,\"value\",\"$dipid\");'>$liste_diplomes</select><br/>".
            "<label for='txt_annee_$id'>Ann&eacute;e : </label><br/><select name='slt_annee_debut' id='slt_annee_debut' onchange='updatedata(\"educations\",\"annee\",this.value,\"value\",\"$dipid\");'>$options_year</select><br/>".
            "<label for='txt_mention_$id'>Mention (si applicable) : </label><br/><input type='text' name='txt_mention_$id' id='txt_mention_$id' size='15' maxlength='10' value='$mention_value' onblur='updatedata(\"educations\",\"mention\",this.value,\"value\",\"$dipid\");' /><br/>".
            "<label for='txt_description_diplome_$id'>Description du dipl&ocirc;me : </label><br/><textarea name='txt_description_diplome_$id' id='txt_description_diplome_$id' cols='40' rows='3' wrap='SOFT' onblur='updatedata(\"educations\",\"desc_diplome\",this.value,\"value\",\"$dipid\");' >$desc_dip_value</textarea><br/>".
            "<label for='txt_ecole_$id'>Ecole/Organisme : </label><br/><input type='text' name='txt_ecole_$id' id='txt_ecole_$id' size='50' maxlength='50' value='$ecole_value' onblur='updatedata(\"educations\",\"ecole\",this.value,\"value\",\"$dipid\");' /><br/>".
            "<label for='txt_lieu_ecole_$id'>Localisation Ecole/Organisme: </label><br/><input type='text' name='txt_lieu_ecole_$id' id='txt_lieu_ecole_$id' size='50' maxlength='50' value='$loc_ecole_value' onblur='updatedata(\"educations\",\"localisation_ecole\",this.value,\"value\",\"$dipid\");' /></td>".
            "<td style='text-align:right;'><a href='javascript:void(0)' onclick='deletediv($id,\"educations\",$dipid)'><img src='images/trash.png' width='48' heigth='48'/></a></td></tr></table>".
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

function getdivdata($dipid) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT * FROM `educations` WHERE `ID` = '$dipid' ORDER BY `ID`";
    $result = $mysqli->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $result->free();
    $mysqli->close();
    return $row;
}

function get_liste_diplomes($type) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT  `ID`, `desc` FROM `liste_diplomes`";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_row()){
        if($type==$row[0]){$selected = " selected";}else{$selected = "";};
        $output .= "<option value='".$row[0]."'$selected>".$row[1]."</option>";
    }
    $result->free();
    $mysqli->close();
    return $output;
}

function newid($idcv,$id) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "INSERT INTO `".DB."`.`educations` (`ID`, `id_cv` , `ecole`, `localisation_ecole`, `type_diplome`, `desc_diplome`, `mention`, `annee`) VALUES (NULL, '$idcv', '', '', '1', '', '', '1950')";
    $mysqli->query($query);
    $lastid = $mysqli->insert_id;
    $mysqli->close();
    return $lastid;
}

function update_cv($idcv,$dipid){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `educations_ids` FROM `".DB."`.`cv` WHERE `ID` = '$idcv'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $existingdata = $row[0];
    $result->close();
    
    $dipid = $existingdata."|".$dipid."|";
    $dipid = str_replace("||","|",$dipid);
    
    $query = "UPDATE `".DB."`.`cv` SET `educations_ids` = '$dipid' WHERE `ID` = '$idcv'";
    $mysqli->query($query);
    $mysqli->close();
}
?>