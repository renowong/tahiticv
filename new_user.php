<?php

include_once("includes/global_vars.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title><? print(SITENAME) ?></title>
        <style type="text/css">@import url("css/main.css");</style>
        <!-- jquery -->
        <script type="application/x-javascript" src="js/jquery.js"></script>
        <script type="application/x-javascript">
            $(document).ready(function () {
                $("#divmessage").hide();
                $("#rs").hide();
                $("#tel").hide();
                
                //submit form process
                $("#frm_new_user").submit(function(event){
                    // stop form from submitting normally
                    event.preventDefault();
                    var $form = $( this ),
                    new_username = $form.find( 'input[name="new_username"]' ).val(),
                    new_password = $form.find( 'input[name="new_password"]' ).val(),
                    new_password2 = $form.find( 'input[name="new_password2"]' ).val(),
                    type_account = $form.find( 'input[name="type_account"]:checked' ).val(),
                    email = $form.find( 'input[name="email"]' ).val(),
                    company = $form.find( 'input[name="company"]' ).val(),
                    tel = $form.find( 'input[name="tel"]' ).val(),
                    url = $form.attr( 'action' );
                    
                    
                    if(new_username=='' || new_password==''){
                        msg="Nom d'utilisateur ou mot de passe vide";
                        message(msg);
                        return false;
                    };
                    
                    if(email==''){
                        msg="Email vide";
                        message(msg);
                        return false; 
                    };
                    
                    if(type_account=='true' && (company=='' || tel=='')){
                        msg="Veuillez compl\351ter l'ensemble des informations annonceur";
                        message(msg);
                        return false;
                    };
                    
                    // Send the data using post and put the results in a div
                    $.post( url, {
                        username: new_username,
                        password: new_password,
                        password2: new_password2,
                        type: type_account,
                        email: email,
                        company: company,
                        tel: tel
                    } ,function(response) {
                        readresponse(response);
                    },"xml");    
                    return false; 
                });
            });
            
                function readresponse(xml){
                    $(xml).find("response").each(function(){
                        var success = $(this).attr("success");
                        //alert(success);
                        var msg = $(this).attr("msg");
                        message(msg);
                        if(success==1){
                            var lastid = $(this).find("lastid").text();
                            document.cookie = "user="+lastid;
                            setTimeout("redirect('gestion.php')",5000);
                        } else {
                            $("#new_password").val("");
                            $("#new_password2").val("");
                            $("#new_password").focus();
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
                
                function is_announcer(state){
                    if(state){
                        $("#rs").show();
                        $("#tel").show();  
                    } else {
                        $("#rs").hide();
                        $("#tel").hide();
                    }
                }
        </script>

    </head>
    <body>
    <img src="images/nomdusite.jpg">
        <div class="center"><div id="divmessage" class="msg">Chargement</div></div> 
        <form name="frm_new_user" id="frm_new_user" action="mods/compte/new_user_submit.php" method="POST">
            <table name="new_user" id="new_user" class="table">
                <tr>
                    <th colspan="2">Nouvel utilisateur</th>
                </tr>
                <tr>
                    <td>Nom Utilisateur : </td><td><input type="text" size="20" maxlength="10" name="new_username" id="new_username" /></td>
                </tr>
                <tr>
                    <td>Mot de Passe : </td><td><input type="password" size="20" maxlength="10" name="new_password" id="new_password" /></td>
                </tr>
                <tr>
                    <td>Confirmation Mot de Passe : </td><td><input type="password" size="20" maxlength="10" name="new_password2" id="new_password2" /></td>
                </tr>
                <tr>
                    <td>Vous êtes un </td><td><input type="radio" name="type_account" value="false" onclick="is_announcer(false);" checked/>Demandeur d'emploi | <input type="radio" name="type_account" value="true" onclick="is_announcer(true);" />Employeur</td>
                </tr>
                <tr>
                    <td>Email : </td><td><input type="text" size="45" maxlength="25" name="email" id="email" /></td>
                </tr>
                <tr name="rs" id="rs">
                    <td>Raison Sociale : </td><td><input type="text" size="45" maxlength="25" name="company" id="company" /></td>               </td>
                </tr>
                <tr name="tel" id="tel">
                    <td>Contact Téléphonique : </td><td><input type="text" size="15" maxlength="6" name="tel" id="tel" /></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">
                    <input type="button" name="cancel" id="cancel" value="Annuler" onClick="redirect('index.php');" /> <input type="submit" name="submit" id="submit" value="S'enregistrer" />
                    </td>
                </tr>
            </table>
        </form>
    </body>