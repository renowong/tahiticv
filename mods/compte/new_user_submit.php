<?php
include_once("../../includes/global_vars.php");

function process_registration($login,$password,$type,$email,$company,$tel){
    $password=md5($password); //encrypt password
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    
    /* check if user already exist */
    $query = "SELECT `username` FROM `users` WHERE `username`='$login'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    if($num_rows>0){
        /* user exist, do not create and send back to index with warning */
        $mysqli->close();
        $fresponse = "<response success ='0' msg='Cet utilisateur existe d&eacute;j&agrave;'></response>";
        return $fresponse;
        
    } else {
        /* ok user does not exist, create it and send back to index, or implement direct login later */
        //$islandslist = get_list('iles');
        //$categorieslist = get_list('categories');
        $islandslist = "|"; //suggestion de Clarita, ne pas cocher par défaut les sélections
        $categorieslist = "|";
        
        
        $query = "INSERT INTO `users` ( `ID` , `username` , `password`, `type` ,`email` ,`rs` ,`tel`, `iles_ids`, `categories_ids` ) VALUES ( NULL , '$login', '$password', $type, '$email', '$company', '$tel', '$islandslist', '$categorieslist' )";
        $mysqli->query($query);
        $lastid = $mysqli->insert_id;
        $mysqli->close();
        $fresponse = "<response success='1' msg='Utilisateur ajout&eacute; -- vous allez etre redirig&eacute;'><lastid>$lastid</lastid></response>";
        return $fresponse;
    }
}

function get_list($table){
    $mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        //printf("Connect failed: %s\n", mysqli_connect_error());
        print("<response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
        exit();
    }
    $query = "SELECT `ID` FROM `$table` ";
    $result = $mysqli->query($query);
    $output = "|";
    while ($row = $result->fetch_row()){
        $output .= $row[0]."|";
    }
    $result->close();
    $mysqli->close();
    return $output;
}

/* Procedure */
$login = $_POST["username"];
$password = $_POST["password"];
$password2 = $_POST["password2"];
$type = $_POST["type"];
$email = $_POST["email"];
$company = $_POST["company"];
$tel = $_POST["tel"];
$response = "<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [".XMLENTITY."]>";

if($password !== $password2){
    /* passwords do not match, alert user */
    $response .= "<response success='0' msg='Les mots de passes ne correspondent pas'></response>";
} else {
    $response .= process_registration($login,$password,$type,$email,$company,$tel);        
}

print($response);





?>