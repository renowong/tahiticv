<?php
/* includes */
//include_once("includes/global_vars.php");
include_once("mods/compte/gestion_top.php");
include_once("menu.php"); /* this includes cookie check and custom menu */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=Windows-1252">
    <title><? print(SITENAME) ?></title>
    <!-- jquery -->
    <script type="application/x-javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/inputcontrols.js"></script>
    <script type="application/x-javascript">
    $(document).ready(function () {
        $("#divmessage").hide();
        
        /* implement exit */
        $("#sortir").click(function(){
            message("Fermeture session");
            document.cookie = "user=;expires=Thu, 01-Jan-1970 00:00:01 GMT";
            setTimeout("redirect('index.php')",1000);
        });
	
	/*this makes message div stay on top*/
        $(window).scroll(function () {
            $("#divmessage").css("top",$(window).scrollTop()+"px");
        });
	
	loaddata();
    });

    
    function loaddata() {
        $.get("mods/compte/get_compte.php", {},
        function(response) {
            readresponse(response);
            //alert(response);
        },'xml');
    }

    function readresponse(xml){
        $(xml).find("response").each(function(){
            var success = $(this).attr("success");
            var msg = $(this).attr("msg");
            message(msg);
            $("#username").text($(this).find("username").text());
            $("#email").val($(this).find("email").text());
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
    
    function updatedata(col,value,type){
        switch (type){
            case 'email':
                if(value!==""){
                    var valide = validate_email(value);
                    if(!valide){return false;}    
                }
            break;
	    
	    case 'num':
                if(value!==""){
                    var valide = validate_numbers(value);
                    if(!valide){return false;}    
                }
            break;
        
            default:
                //value = addslashes(value);
                //alert(value);
        }
	
        $.post("mods/compte/update_gestion.php", { col: col, value: value, type: type },
        function(data) {
            //alert("Data Loaded: " + data);
        });
    }
    
    function update_filters(){
	var id;
	var iles="|";
	var cat="|";
	$(':input:checked').each(function(i) {
	    id = (this.id).split("_");
	    switch(id[0]){
		case "ile":
		    //alert("iles");
		    iles += this.value+"|";
		break;
		case "categorie":
		    //alert("cat");
		    cat += this.value+"|";
		break;
		default:
		alert("erreur");
	    }
	    
	});
	if(iles=="|"){message("Vous devez au moins choisir une île pour que votre CV soit disponible dans la recherche.");}
	updatedata("iles_ids",iles);
	if(cat=="|"){message("Vous devez au moins choisir une catégorie pour que votre CV soit disponible dans la recherche.");}
	updatedata("categories_ids",cat);
    }
    
//    function update_categories(){
//	var checked="|";
//	$('#categories').children(':input:checked').each(function(i) {
//	    checked += this.value+"|";
//	});
//	if(checked=="|"){message("Vous devez au moins choisir une catégorie pour que votre CV soit disponible dans la recherche.");}
//	updatedata("categories_ids",checked);
//    }
    
    function update_password(passcheck){
	if($("#password").val()!==passcheck){
	    message("Vos mots de passes ne correspondent pas.");$("#password2").val("");
	}else{
	    updatedata("password",passcheck,"md5");
	}
    }

    
    </script>
    
    
    <!-- Stylesheets -->
    <style type="text/css">@import url("css/main.css");</style>
    <style type="text/css">@import url("css/menu.css");</style>
</head>
<body>
    <div class="center"><div id="divmessage" class="msg">Chargement</div></div>
    <table name="main_table" id="main_table" class="coinArrondi shadow">
        <?php print TOPMENU; ?>
        <tr><td colspan="2" class="title"><h1>Gestion de votre compte</h1></td></tr>
        <tr><td colspan="2" class="mainmenu"><? print($menu); ?></td></tr>
        <tr>
            <td colspan="2" class="intro">
                <p>La gestion de votre compte vous permet de modifier vos informations personnelles (mot de passe, adresse email, ...)</p>
            </td>
        </tr>
        <tr>
            <td class="content">
		<table name="user" id="user" class="coinArrondi form" style="width:600px;">
                <tr>
                    <td>Nom Utilisateur : </td><td><span name="username" id="username" style="font-weight:bold;"></span></td>
                </tr>
                <tr>
                    <td>Mot de Passe : </td><td><input type="password" size="20" maxlength="10" name="password" id="password" /><span style="font-style: italic;">Laissez vide pour garder votre mot de passe actuel.</span></td>
                </tr>
                <tr>
                    <td>Confirmation Mot de Passe : </td><td><input type="password" size="20" maxlength="10" name="password2" id="password2" onblur="update_password(this.value);"/></td>
                </tr>
                    <tr>
                    <td>Email : </td><td><input type="text" size="35" maxlength="25" name="email" id="email" onblur="updatedata('email',this.value,'email');"/></td>
                </tr>
		    <?php print $build_from_type_iles ?>
		    <?php print $build_from_type_cat ?>
		    <?php print $build_from_type_rs ?>
		    <?php print $build_from_type_tel ?>
		</table>
            </td>
            
            <td style="width:250px;">

    WIDGETS....
	    </td>
        </tr>
	<?php print FOOTNOTE; ?>
    </table>
    
</body>
</html>
