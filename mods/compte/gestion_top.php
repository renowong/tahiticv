<?php
include_once("includes/global_vars.php");
$id = $_COOKIE["user"];
$ar_islands = get_table($id,'iles');
$ar_categories = get_table($id,'categories');
$ar_user = gettypeuser($id);
if($ar_user["type"]=='0'){ //particulier
   $build_from_type_iles = build_list($ar_islands,'iles','ile');
   $build_from_type_cat = build_list($ar_categories,'categories','categorie');
}else{ //annonceur
   $build_from_type_rs ="<tr><td>Raison Sociale : </td><td><input type='text' size='35' maxlength='25' name='company' id='company' value='".$ar_user["rs"]."' onblur=\"updatedata('rs',this.value);\" /></td></tr>";
   $build_from_type_tel .="<tr><td>T&eacute;l&eacute;phone : </td><td><input type='text' size='15' maxlength='6' name='tel' id='tel' value='".$ar_user["tel"]."' onblur=\"updatedata('tel',this.value,'num');\" /></td></tr>";
}


/*functions*/

function gettypeuser($id){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

/* check connection */
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
    exit();
}
    $query = "SELECT * FROM  `users` WHERE `ID`=$id";
    if ($result = $mysqli->query($query)) {
    $row = $result->fetch_assoc();
    }
    $result->free();
    $mysqli->close();
    return $row;
}


function get_table($id,$table){
   $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

/* check connection */
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
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
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    switch($table){
      case 'iles':
      $query = "SELECT `ID`,`ile` FROM `".DB."`.`iles` ORDER BY `ile`";
      $output = "<tr><td colspan='2'>Cocher les &icirc;les dans lesquelles vous recherchez un emploi :<br /><table name='islands' id='islands' style='border:solid 2px;width:600px;'>";
      $modulus = 5;
      break;
      
      case 'categories':
      $query = "SELECT `ID`,`categorie` FROM `".DB."`.`categories` ORDER BY `categorie`";
      $output = "<tr><td colspan='2'>Cocher les cat&eacute;gories dans lesquelles vous recherchez un emploi :<br /><table name='categories' id='categories' style='border:solid 2px;width:600px;'>";
      $modulus = 2;
      break;
   
      default:
      break;
    }
    
   $result = $mysqli->query($query);
   $i=1;
   $output .="<tr>";
   while ($row = $result->fetch_row()){
         
         if(in_array($row[0],$ar)){$check=" checked";}else{$check="";}
         $output .="<td><input type='checkbox' name='".$col."_$row[0]' id='".$col."_$row[0]' value='$row[0]' onclick='update_filters();'$check/><label for='".$col."_$row[0]'>$row[1]</label></td>";
         if($i%$modulus==0){$output .="</tr><tr>";}
         $lastmodulus = ($i%$modulus);
         $i++;
   }
   $output .="</tr><tr>";
   if($lastmodulus=='0'){$output = substr($output,0,-13);}else{$output = substr($output,0,-4);}
   //echo htmlentities($output);
   
   $output .= "</table></td></tr>";

   $result->close();
   $mysqli->close();
   return $output;

}



?>