<?php

include_once("includes/global_vars.php");
$mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);

/* check connection */
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    print("<?xml version='1.0' encoding='utf-8' ?><!DOCTYPE response SYSTEM 'response.dtd' [<!ENTITY ccedil '&#231;'><!ENTITY egrave '&#232;'><!ENTITY eacute '&#233;'><!ENTITY ecirc '&#234;'><!ENTITY icirc '&#238;'><!ENTITY ocirc '&#244;'><!ENTITY ucirc '&#251;'><!ENTITY agrave '&#224;'>]><response success='0' msg='Erreur de connexion &agrave; la base de donn&eacute;es'></response>");
    exit();
}
    
$token = $_GET['token'];

$query = "SELECT `authorisations`.`id_user`,`authorisations`.`id_auth` FROM `authorisations` WHERE `code` = '$token'";

if ($result = $mysqli->query($query)) {
    $rowcount = $mysqli->affected_rows;
    if($rowcount>0){
        $row = $result->fetch_assoc();
        $user = $row['id_user'];
        $cvid = $row['id_auth'];
        $result->close();
        
        $query = "SELECT `cv`.`auth_ids` FROM `cv` WHERE `ID` = '$cvid'";
        $result = $mysqli->query($query);
        $row = $result->fetch_row();
        $auth_ids = $row[0];
        $result->close();
        
        if(substr($auth_ids, -1)!=="|"){$auth_ids .= "|";}
        $auth_ids .= $user."|";
        $query = "UPDATE `cv` SET `auth_ids` = '$auth_ids' WHERE `ID` = '$cvid'";
        $mysqli->query($query);
        
        $query = "DELETE FROM `authorisations` WHERE `code` = '$token'";
        $mysqli->query($query);
        $mysqli->close();
        
        $response = "Votre autorisation est accord&eacute;e.";
    } else {
    //there is no result, or token already used
    $response = "Token inexistant ou d&eacute;j&agrave; utilis&eacute;.";
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=Windows-1252">
        <title><? print(SITENAME) ?></title>
        <style type="text/css">@import url("css/main.css");</style>
        <!-- jquery -->
        <script type="application/x-javascript" src="js/jquery.js"></script>
        <script type="application/x-javascript">
            $(document).ready(function () {
                $("#divmessage").hide();
                
                /* submit form process */
                $("#login_form").submit(function(event){
                    /* stop form from submitting normally */
                    event.preventDefault();
                    var $form = $( this ),
                    username = $form.find( 'input[name="txt_username"]' ).val(),
                    password = $form.find( 'input[name="txt_password"]' ).val(),
                    url = $form.attr( 'action' );
                    
                    if(username=='' || password==''){
                        msg="Nom d'utilisateur ou mot de passe vide";
                        message(msg);
                        return false;
                    }
                    
                    /* Send the data using post and put the results in a div */
                    $.post( url, {
                        username: username,
                        password: password
                    } ,function(response) {
                        readresponse(response);
                    },"xml");    
                    return false; 
                });
            });

            function readresponse(xml){
                $(xml).find("response").each(function(){
                    var success = $(this).attr("success");
                    var msg = $(this).attr("msg");
                    var id = $(this).find("id").text();
                    message(msg);
                    if(success==1){
                        var token = Math.floor(Math.random()*100001);
                        document.cookie = "user="+id;
                        document.cookie = "token="+token;
                        setTimeout("redirect('main.php')",1000);
                    } else { /* login or password wrong */
                        $("#txt_username").val("");
                        $("#txt_password").val("");
                        $("#txt_username").focus();
                    }
                });
            }
            
            function message(string){
                var m = $("#divmessage");
                m.empty();
                m.text(string);
                m.slideDown().delay(3000).fadeOut("slow");
            }
            
            function redirect(url){
                     window.location = url;
            }
            
            function cancel() {
                $("#txt_username").val("");
                $("#txt_password").val("");
            }
        </script>
    </head>
    <body>
        <div class="center"><div id="divmessage" class="msg">Chargement</div></div>
        <img src="images/nomdusite.jpg" align="center"/>
        <table name="main_table" id="main_table" class="coinArrondi shadow">          
            <tr class="login_content">
                <td colspan="3"><?php print $response; ?>
                </td>
            </tr>
            <tr>

                <td>
                    <center>Vous aimez Tahiti CV ? Partager le avec vos amis
                        <div id="bookmarker_34578"><noscript>Javascript est desactiv&eacute; - <a href="http://www.supportduweb.com/">Support du web</a> - <a href="http://www.supportduweb.com/generateur-boutons-partage-share-button-bookmarker-web20-facebook-twitter-delicious-digg-bookmarks.html">Boutons partage bookmark</a></noscript></div><script type="text/javascript" src="http://services.supportduweb.com/bookmarker/2-34578.js"></script>
                    </center>
                </td>

            </tr>
            <?php print FOOTNOTE; ?>
        </table>
    </body>
</html>