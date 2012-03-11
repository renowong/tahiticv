<?php
include_once("includes/global_vars.php");
$id = $_COOKIE["user"];

   $build_from_type_dip = build_list('liste_diplomes','desc');
   $build_from_type_cat = build_list('categories','categorie');


/*functions*/

    
function build_list($table,$col){
   $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    switch($table){
      case 'liste_diplomes':
      $query = "SELECT `ID`,`desc` FROM `".DB."`.`liste_diplomes` ORDER BY `ordre`";
      break;
      
      case 'categories':
      $query = "SELECT `ID`,`categorie` FROM `".DB."`.`categories` ORDER BY `categorie`";
      break;
   
      default:
      break;
    }
    
    $result = $mysqli->query($query);
    while ($row = $result->fetch_row()){
        $output .="<option value='$row[0]'/>$row[1]</option>";
    }
    
    $result->close();
    $mysqli->close();
    return $output;

}

?>