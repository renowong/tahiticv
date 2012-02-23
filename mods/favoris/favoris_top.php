<?php
include_once("includes/global_vars.php");
include_once("includes/security.php");
$id = $_COOKIE["user"];


$favorites = getdata($id);


function getdata($id){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY eacute '&#233;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    $query = "SELECT `users`.`fav_ids`,`users`.`type` FROM `users` WHERE `users`.`ID` = '$id'";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    $str = $row[0];
    $type = $row[1];
    $result->free();
    
    $str = substr($str,1);
    $str = substr($str,0,-1);
    $favids = explode("|",$str);

    $filter = " WHERE";
    $counter = 0;
    
    if($type=='1'){
        foreach ($favids as $v) {
            $filter .= " `cv` .`ID`='$v' OR";
        }
        $filter = substr($filter,0,-3);
        
        $query = "SELECT `cv`.`ID`,`cv`.`open`,`cv`.`auth_ids`, `cv`.`nom`, `cv`.`prenom` FROM `cv`".$filter;
        
        if ($result = $mysqli->query($query)) {
        $output ="<table style='text-align:center;width:100%;'><tr>";
        while($row = $result->fetch_assoc()){
            $counter+=1;
            if($counter%2!==0){$output .= "<tr>";}
            $auth = preg_match("/\|$id\|/",$row['auth_ids']);
            if($row["open"]=='1'||$auth=='1'){
                $output .= "<td><div name='fav_".tencode($row["ID"])."' id='fav_".tencode($row["ID"])."' style='padding:5px;width:100%;'>".
                "<b>CV ".$row["nom"]." ".$row["prenom"]."</b> ".
                "<a href='javascript:void(0)' onclick='show_visu(\"".tencode($row["ID"])."\",\"cv\");'><img style='vertical-align: middle;' height='30px' src='images/preview-icon.png'/></a>".
                "<a href='javascript:void(0)' onclick='delfav(\"".tencode($row["ID"])."\");'><img style='vertical-align: middle;' height='30px' src='images/favorite-remove-icon.png'/></a>".
                "</div></td>";
            } else {
                $output .= "<td><div name='fav_".tencode($row["ID"])."' id='fav_".tencode($row["ID"])."' style='padding:5px;width:100%;'>".
                "<b>CV num&eacute;ro ".tencode($row["ID"])."</b> ".
                "<a href='javascript:void(0)' onclick='show_visu(\"".tencode($row["ID"])."\",\"cv\");'><img style='vertical-align: middle;' height='30px' src='images/preview-icon.png'/></a>".
                "<a href='javascript:void(0)' onclick='delfav(\"".tencode($row["ID"])."\");'><img style='vertical-align: middle;' height='30px' src='images/favorite-remove-icon.png'/></a>".
                "</div></td>";
            }
            if($counter%2==0){$output .= "</tr>";}
         }
        $output .="</tr></table>";
        $result->free();
        }
    }else{
        foreach ($favids as $v) {
            $filter .= " `annonces` .`ID`='$v' OR";
        }
        $filter = substr($filter,0,-3);
        
        $query = "SELECT `annonces`.`ID`, `annonces`.`titre` FROM `annonces`".$filter;
        
        if ($result = $mysqli->query($query)) {
        $output ="<table style='text-align:center;width:100%;'><tr>";
        while($row = $result->fetch_assoc()){
            $counter+=1;
            if($counter%2!==0){$output .= "<tr>";}
                $output .= "<td><div name='fav_".tencode($row["ID"])."' id='fav_".tencode($row["ID"])."' style='padding:5px;width:100%;'>".
                "<b>".$row["titre"]."</b> ".
                "<a href='javascript:void(0)' onclick='show_visu(\"".tencode($row["ID"])."\",\"announce\");'><img style='vertical-align: middle;' height='30px' src='images/preview-icon.png'/></a>".
                "<a href='javascript:void(0)' onclick='delfav(\"".tencode($row["ID"])."\");'><img style='vertical-align: middle;' height='30px' src='images/favorite-remove-icon.png'/></a>".
                "</div></td>";
            if($counter%2==0){$output .= "</tr>";}
         }
        $output .="</tr></table>";
        $result->free();
        }
    }


    
    $mysqli->close();

    //print $counter;
    return $output;
}

?>