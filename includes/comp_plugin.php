<?php
include_once("../includes/global_vars.php");
include_once("../includes/security.php");
$id = $_GET["id"];
$idcv = tdecode($_GET["idcv"]);
$compid = $_GET["compid"]+0; //get and convert to integer
$excomp = getcompex();

/*generate new id for competences*/
if($compid>0){ //else load existing
    $ar_results = getdivdata($compid);
    //print_r($ar_results);
    $competence_value = $ar_results["competence"];

    
} else { //if new diploma then load new
    $compid = newid($idcv,$id);
    update_cv($idcv,$compid);
}

$output =   "<div name='$id' id='$id'><table style='width:100%'><tr><td><label for='txt_competence_$id'>Comp&eacute;tence : </label><br/>".
            "Exemples : <select name='ex_comp_$id' id='ex_comp_$id' onchange='set_exemple(\"$id\");updatedata(\"competences\",\"competence\",this.value,\"value\",\"$compid\");'><option value=''>S&eacute;lectionnez un exemple</option>$excomp</select>".
            "<input type='text' name='txt_competence_$id' id='txt_competence_$id' size='50' maxlength='50' value='$competence_value' onblur='updatedata(\"competences\",\"competence\",this.value,\"value\",\"$compid\");' /></td>".
            "<td style='text-align:right;'><a href='javascript:void(0)' onclick='deletediv($id,\"competences\",$compid)'><img src='images/trash.png' width='48' heigth='48'/></a></td></tr></table>".
            "</div>";

print $output;


/*functions*/

function getcompex(){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    $query = "SELECT * FROM `liste_competences`";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)){
        $output .= "<option value='".$row['desc']."'>".$row['desc']."</option>";
    }
    return $output;
}


function getdivdata($compid) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT * FROM `competences` WHERE `ID` = '$compid' ORDER BY `ID`";
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
    
    $query = "INSERT INTO `".DB."`.`competences` (`ID`, `id_cv`, `competence`) VALUES (NULL, '$idcv', '')";
    $mysqli->query($query);
    $lastid = $mysqli->insert_id;
    $mysqli->close();
    return $lastid;
}

function update_cv($idcv,$compid){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `competences_ids` FROM `".DB."`.`cv` WHERE `ID` = '$idcv'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $existingdata = $row[0];
    $result->close();
    
    $compid = $existingdata."|".$compid."|";
    $compid = str_replace("||","|",$compid);
    
    $query = "UPDATE `".DB."`.`cv` SET `competences_ids` = '$compid' WHERE `ID` = '$idcv'";
    $mysqli->query($query);
    $mysqli->close();
}
?>