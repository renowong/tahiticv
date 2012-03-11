<?php
include_once("../includes/global_vars.php");
include_once("../includes/security.php");
$id = $_GET["id"];
$idcv = tdecode($_GET["idcv"]);
$certid = $_GET["certid"]+0; //get and convert to integer

/*generate new id for certifications*/
if($certid>0){ //else load existing
    $ar_results = getdivdata($certid);
    //print_r($ar_results);
    $certificat_value = $ar_results["certificat"];
    $annee_value = $ar_results["annee"];
    $mention_value = $ar_results["mention"];
    $desc_cert_value = $ar_results["desc_certificat"];
    $ecole_value = $ar_results["ecole"];
    $loc_ecole_value = $ar_results["localisation_ecole"];

} else { //if new diploma then load new
    $certid = newid($idcv,$id);
    update_cv($idcv,$certid);
}
    $options_year = gen_years($annee_value);

$output =   "<div name='$id' id='$id'><table style='width:100%'><tr><td><label for='txt_certificat_$id'>Nom du certificat : </label>".
            "<input type='text' name='txt_certificat_$id' id='txt_certificat_$id' size='50' maxlength='50' value='$certificat_value' onblur='updatedata(\"certifications\",\"certificat\",this.value,\"value\",\"$certid\");' /><br/>".
            "<label for='txt_annee_$id'>Ann&eacute;e : </label><br/><select name='slt_annee_debut' id='slt_annee_debut' onchange='updatedata(\"certifications\",\"annee\",this.value,\"value\",\"$certid\");'>$options_year</select><br/>".
            "<label for='txt_mention_$id'>Mention (si applicable) : </label><br/><input type='text' name='txt_mention_$id' id='txt_mention_$id' size='15' maxlength='10' value='$mention_value' onblur='updatedata(\"certifications\",\"mention\",this.value,\"value\",\"$certid\");' /><br/>".
            "<label for='txt_description_certification_$id'>Description de la certification : </label><br/><textarea name='txt_description_certification_$id' id='txt_description_certification_$id' cols='40' rows='3' wrap='SOFT' onblur='updatedata(\"certifications\",\"desc_certificat\",this.value,\"value\",\"$certid\");' >$desc_cert_value</textarea><br/>".
            "<label for='txt_ecole_cert_$id'>Ecole/Organisme : </label><br/><input type='text' name='txt_ecole_cert_$id' id='txt_ecole_cert_$id' size='50' maxlength='50' value='$ecole_value' onblur='updatedata(\"certifications\",\"ecole\",this.value,\"value\",\"$certid\");' /><br/>".
            "<label for='txt_lieu_ecole_cert_$id'>Localisation Ecole/Organisme: </label><br/><input type='text' name='txt_lieu_ecole_cert_$id' id='txt_lieu_ecole_cert_$id' size='50' maxlength='50' value='$loc_ecole_value' onblur='updatedata(\"certifications\",\"localisation_ecole\",this.value,\"value\",\"$certid\");' /></td>".
            "<td style='text-align:right;vertical-align:top;'><a href='javascript:void(0)' onclick='deletediv($id,\"certifications\",$certid)'><img src='images/trash.png' width='48' heigth='48'/></a></td></tr></table>".
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

function getdivdata($certid) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT * FROM `certifications` WHERE `ID` = '$certid' ORDER BY `ID`";
    $result = $mysqli->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $result->free();
    $mysqli->close();
    return $row;
}


function newid($idcv,$id) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "INSERT INTO `".DB."`.`certifications` (`ID`, `id_cv`, `certificat`, `ecole`, `localisation_ecole`, `desc_certificat`, `mention`, `annee`) VALUES (NULL, '$idcv', '', '', '', '', '', '1950')";
    $mysqli->query($query);
    $lastid = $mysqli->insert_id;
    $mysqli->close();
    return $lastid;
}

function update_cv($idcv,$certid){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `certifications_ids` FROM `".DB."`.`cv` WHERE `ID` = '$idcv'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $existingdata = $row[0];
    $result->close();
    
    $certid = $existingdata."|".$certid."|";
    $certid = str_replace("||","|",$certid);
    
    $query = "UPDATE `".DB."`.`cv` SET `certifications_ids` = '$certid' WHERE `ID` = '$idcv'";
    $mysqli->query($query);
    $mysqli->close();
}
?>