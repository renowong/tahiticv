<?php
include_once("../includes/global_vars.php");
include_once("../includes/security.php");
$id = $_GET["id"];
$idcv = tdecode($_GET["idcv"]);
$cintid = $_GET["cintid"]+0; //get and convert to integer

/*generate new id for centre_interets*/
if($cintid>0){ //else load existing
    $ar_results = getdivdata($cintid);
    //print_r($ar_results);
    $centre_interet_value = $ar_results["centre_interet"];

    
} else { //if new diploma then load new
    $cintid = newid($idcv,$id);
    update_cv($idcv,$cintid);
}

$output =   "<div name='$id' id='$id'><table style='width:100%'><tr><td><label for='txt_centre_interet_$id'>centre d'int&eacute;r&ecirc;t : </label><br/>".
            "<input type='text' name='txt_centre_interet_$id' id='txt_centre_interet_$id' size='50' maxlength='100' value='$centre_interet_value' onblur='updatedata(\"centre_interets\",\"centre_interet\",this.value,\"value\",\"$cintid\");' /></td>".
            "<td style='text-align:right;'><a href='javascript:void(0)' onclick='deletediv($id,\"centre_interets\",$cintid)'><img src='images/trash.png' width='48' heigth='48'/></a></td></tr></table>".
            "</div>";

print $output;


/*functions*/

function getdivdata($cintid) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT * FROM `centre_interets` WHERE `ID` = '$cintid' ORDER BY `ID`";
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
        printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "INSERT INTO `".DB."`.`centre_interets` (`ID`, `id_cv`, `centre_interet`) VALUES (NULL, '$idcv', '')";
    $mysqli->query($query);
    $lastid = $mysqli->insert_id;
    $mysqli->close();
    return $lastid;
}

function update_cv($idcv,$cintid){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `centre_interets_ids` FROM `".DB."`.`cv` WHERE `ID` = '$idcv'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $existingdata = $row[0];
    $result->close();
    
    $cintid = $existingdata."|".$cintid."|";
    $cintid = str_replace("||","|",$cintid);
    
    $query = "UPDATE `".DB."`.`cv` SET `centre_interets_ids` = '$cintid' WHERE `ID` = '$idcv'";
    $mysqli->query($query);
    $mysqli->close();
}
?>