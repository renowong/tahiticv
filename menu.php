<?php
/* check if there is cookie, otherwise, send back to index.php  */
$id = $_COOKIE["user"];
if($id=="") header("location:index.php");
//print_r($_COOKIE);

$type = get_type_user($id); /* Type=0 is Particulier / Type=1 is Annonceur */

$menu = "<ul class='menu'>";
$menu .= "<li><a href='main.php' class='active' target='_self'><span>Accueil</span></a></li>";
if(!$type){$menu .= "<li><a href='compose.php' target='_self'><span>Composition CV</span></a></li>";};
if($type){$menu .= "<li><a href='announces.php' target='_self'><span>Gestions Annonces</span></a></li>";};
if(!$type){$menu .= "<li><a href='searchannounce.php' target='_self'><span>Rechercher Annonce</span></a></li>";}; 
if($type){$menu .= "<li><a href='searchcv.php' target='_self'><span>Rechercher CV</span></a></li>";}; 
$menu .= "<li><a href='favoris.php' target='_self'><span>Favoris</span></a></li>";
$menu .= "<li><a href='services.php' target='_self'><span>Services</span></a></li>";
$menu .= "<li><a href='/contact'><span>Contact</span></a></li>";
$menu .= "<li><a href='about.php' target='_self'><span>A propos</span></a></li>";
$menu .= "<li><a href='about.php' target='_self'><span>Moteur de recherche</span></a></li>";
$menu .= "</ul>";

/*
 * function get_type_user
 * @param $id=int user id to customize menu
 */

function get_type_user($id) {
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    
    $query = "SELECT `type` FROM `users` WHERE `ID`='$id'";
    $result = $mysqli->query($query);
    
    $row = $result->fetch_row();
    $type = $row[0];
    
    $result->close();
    $mysqli->close();
    return $type;
}
?>