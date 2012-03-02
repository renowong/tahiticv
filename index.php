<?php

include_once("includes/global_vars.php");
include_once("index_top.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
	<meta http-equiv="Content-Type" content="text/html;charset=Windows-1252">
        <title><? print(SITENAME) ?></title>
        <style type="text/css">@import url("css/main.css");</style>
        <!-- jquery -->
        <script type="application/x-javascript" src="js/jquery.js"></script>
        <script type="application/x-javascript" src="js/jquery.vticker.1.4.js"></script>
        <script type="application/x-javascript">
            $(document).ready(function () {
                $("#divmessage").hide();
                $('#slider').load('mods/ads/slidebox.html');
		
                $.urlParam = function(name){
		    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
		    return results[1] || 0;
		}
		
		//WIP
		var auth = $.urlParam('auth');
		if(auth!==""){
		    $.post("autologon.php", {auth:auth},
		    function(response) {
			//readresponse(response);
			alert(response);
		    });
		}

		
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
                
                $('#news-container').vTicker({ 
		speed: 1000,
		pause: 3000,
		animation: 'fade',
		mousePause: true,
		showItems: 3,
                height: 0 //default 0=off
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
            <tr>
                <td colspan="3">
                    <form name="login_form" id="login_form" action="access.php" method="post">
                        <?php print $alert; ?>
                        <table name="login_table" id="login_table" class="table">
                            <tr>
                                <th colspan="2">Acc&egrave;s</th>
                            </tr>
                            <tr>
                                <td>Nom Utilisateur : </td><td><input type="text" size="15" maxlength="10" name="txt_username" id="txt_username" /></td>
                            </tr>
                            <tr>
                                <td>Mot de Passe : </td><td><input type="password" size="15" maxlength="10" name="txt_password" id="txt_password" /></td>
                            </tr>
                            <tr>
                                <td><input type="button" name="btn_cancel" id="btn_cancel" onclick="cancel();" value="Annuler" /> <input type="submit" name="btn_submit" id="btn_submit" value="Se logger" />
                            </tr>
                        </table>
                    </form>
                    <br/>
                    <input type="button" value="S'INSCRIRE" onclick="document.location.href='new_user.php';" />
                </td>
            </tr>
            <tr class="login_content">
                <td colspan="3">Bienvenue sur TahitiCV.<br>Des milliers de recruteurs cherchent des profils sur la Polynésie chaque jour.<br>
                Vous êtes un particulier ? TahitiCV vous permettra d'envoyer vos CV directement de la maison, sans vous déplacer.<br>
                Vous êtes une entreprise ? Vous pourrez rechercher la personne qu'il vous faut directement de votre bureau, sans vous déplacer, ou
                encore poster des annonces d'offre d'emploi ou autre. Inscrivez-vous gratuitement et laissez-vous guider.
                </td>
            </tr>
            <tr>
                <td>
                    <div class="vticker" id="news-container"> 
                        <?php print $vticker; ?>
                    </div> 
                    <div id="slider"></div>
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