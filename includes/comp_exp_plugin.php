<?php
include_once("../includes/global_vars.php");
include_once("../includes/security.php");
$expid = $_GET['expid'];
$divid = $_GET['divid'];
$cvid = $_GET['cvid'];
$compid = $_GET['compid']+0;

if($compid>0){
    $ar_results = getdivdata($compid);
    $expid = $ar_results["expid"];
    $comp_value = $ar_results["competence"];
    $comp_exp_id = $compid;

} else {
    $comp_exp_id = newid($expid);
    update_exp($expid,$comp_exp_id);
}

$output = "<div name='div_competence_poste_$comp_exp_id' id='div_competence_poste_$comp_exp_id'><input type='text' name='txt_competence_poste_$comp_exp_id' id='txt_competence_poste_$comp_exp_id' size='50' maxlength='50' value='$comp_value' onblur='updatedata(\"competences\",\"competence\",this.value,\"value\",\"$comp_exp_id\");'/><a href='javascript:void(0)' onclick='delete_comp_exp(\"div_competence_poste_$comp_exp_id\",\"$comp_exp_id\",\"".tencode($expid)."\")'><img style='vertical-align: middle;' height='20px' src='images/trash.png'/></a></div>";

print $output;

/*functions*/

function getdivdata($compid) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT * FROM `competences` WHERE `ID` = '$compid' ORDER BY `ID`";
    $result = $mysqli->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $result->free();
    $mysqli->close();
    return $row;
}

function newid($expid) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "INSERT INTO `".DB."`.`competences` (`ID`, `id_cv`, `expid`, `competence`) VALUES (NULL, '0', '$expid', '')";
    $mysqli->query($query);
    $lastid = $mysqli->insert_id;
    $mysqli->close();
    return $lastid;
}

function update_exp($expid,$compid){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `competences_ids` FROM `".DB."`.`experiences` WHERE `ID` = '$expid'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $existingdata = $row[0];
    $result->close();
    
    $compid = $existingdata."|".$compid."|";
    $compid = str_replace("||","|",$compid);
    
    $query = "UPDATE `".DB."`.`experiences` SET `competences_ids` = '$compid' WHERE `ID` = '$expid'";
    $mysqli->query($query);
    $mysqli->close();
}
?>