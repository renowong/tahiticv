<?php
include_once("includes/global_vars.php");
$id = $_COOKIE["user"];
$ar_islands = get_table($id,'iles');
$ar_categories = get_table($id,'categories');

   $build_from_type_iles = build_list($ar_islands,'iles','ile');
   $build_from_type_cat = build_list($ar_categories,'categories','categorie');


/*functions*/


function get_table($id,$table){
   $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

/* check connection */
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
    exit();
}
   switch($table){
      case 'iles':
      $query = "SELECT `iles_ids` FROM `".DB."`.`users` WHERE `ID`=$id";
      break;
   
      case 'categories':
      $query = "SELECT `categories_ids` FROM `".DB."`.`users` WHERE `ID`=$id";
      break;
   
      default:
      break;   
   }
      $result = $mysqli->query($query);
      $row = $result->fetch_row();
      $liste = $row[0];
      $result->close();
      
      $liste = str_replace("||","|",$liste);
      //clean up the beginning and the end with substring...
      $pipe = substr($liste,0,1);
      if($pipe=="|"){$liste=substr($liste,1);}
      $pipe = substr($liste,-1,1);
      if($pipe=="|"){$liste=substr($liste,0,-1);}
      
      $ar_liste = explode("|",$liste);
      return $ar_liste;
}
    
function build_list($ar,$table,$col){
   $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    switch($table){
      case 'iles':
      $query = "SELECT `ID`,`ile` FROM `".DB."`.`iles` ORDER BY `ile`";
      $output = "<div name='iles_prefs' id='iles_prefs' class='prefs coinArrondi'>Cocher les &icirc;les dans lesquelles vous recherchez un emploi :".
      "<br /><div name='islands' id='islands'><div style='text-align:right;'>".
      "<input type='button' onclick='check_all(false,\"iles_prefs\")' value='Tout d&eacute;cocher'/>".
      "<input type='button' onclick='check_all(true,\"iles_prefs\")' value='Tout cocher'/></div>";
      break;
      
      case 'categories':
      $query = "SELECT `ID`,`categorie` FROM `".DB."`.`categories` ORDER BY `categorie`";
      $output = "<div name='cat_prefs' id='cat_prefs' class='prefs coinArrondi'>Cocher les cat&eacute;gories dans lesquelles vous recherchez un emploi :".
      "<br /><div name='categories' id='categories'><div style='text-align:right;'>".
      "<input type='button' onclick='check_all(false,\"cat_prefs\")' value='Tout d&eacute;cocher'/>".
      "<input type='button' onclick='check_all(true,\"cat_prefs\")' value='Tout cocher'/></div>";
      break;
   
      default:
      break;
    }
    
    $result = $mysqli->query($query);
    $i=1;

    while ($row = $result->fetch_row()){
        if(in_array($row[0],$ar)){$check=" checked";}else{$check="";}
        $output .="<input type='checkbox' name='".$col."_$row[0]' id='".$col."_$row[0]' value='$row[0]'$check/><label for='".$col."_$row[0]'>$row[1]</label>&nbsp;&nbsp;&nbsp;";
        if($i%3==0){$output .="<br/>";}
        $i++;
    }
    
    $output .= "</div><br/></div>";

    $result->close();
    $mysqli->close();
    return $output;

}



?>