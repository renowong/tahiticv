<?php
include_once("../includes/global_vars.php");
include_once("../includes/security.php");
$id = $_GET["id"];
$idcv = tdecode($_GET["idcv"]);
$langid = $_GET["langid"]+0; //get and convert to integer

/*generate new id for languages*/
if($langid>0){ //else load existing
    $ar_results = getdivdata($langid);
    //print_r($ar_results);
    $langue_value = $ar_results["langue"];
    $obs_value = $ar_results["obs"];
    
} else { //if new language then load new
    $langid = newid($idcv,$id);
    update_cv($idcv,$langid);
}

$output =   "<div name='$id' id='$id'><table style='width:100%'><tr><td><label for='txt_langue_$id'>Langue : </label><br/>".
            "<input type='text' name='txt_langue_$id' id='txt_langue_$id' size='30' maxlength='20' value='$langue_value' onblur='updatedata(\"langues\",\"langue\",this.value,\"letters\",\"$langid\");' /><br/>".
            "<label for='txt_langue_obs_$id'>Observation : </label><br/><input type='text' name='txt_langue_obs_$id' id='txt_langue_obs_$id' size='30' maxlength='15' value='$obs_value' onblur='updatedata(\"langues\",\"obs\",this.value,\"letters\",\"$langid\");' /></td>".
            "<td style='text-align:right;vertical-align:top;'><a href='javascript:void(0)' onclick='deletediv($id,\"langues\",$langid)'><img src='images/trash.png' width='48' heigth='48'/></a></td></tr></table>";
            "</div>";

print $output;

/*functions*/

function getdivdata($langid) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT * FROM `langues` WHERE `ID` = '$langid' ORDER BY `ID`";
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
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "INSERT INTO `".DB."`.`langues` (`ID`, `id_cv`, `langue`) VALUES (NULL, '$idcv', '')";
    $mysqli->query($query);
    $lastid = $mysqli->insert_id;
    $mysqli->close();
    return $lastid;
}

function update_cv($idcv,$langid){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `langues_ids` FROM `".DB."`.`cv` WHERE `ID` = '$idcv'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $existingdata = $row[0];
    $result->close();
    
    $langid = $existingdata."|".$langid."|";
    $langid = str_replace("||","|",$langid);
    
    $query = "UPDATE `".DB."`.`cv` SET `langues_ids` = '$langid' WHERE `ID` = '$idcv'";
    $mysqli->query($query);
    $mysqli->close();
}
?>