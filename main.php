<?php
/* includes */
include_once("includes/global_vars.php");
include_once("menu.php"); /* this includes cookie check and custom menu */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=Windows-1252">
    <title><? print(SITENAME) ?></title>
    <!-- jquery -->
    <script type="application/x-javascript" src="js/jquery.js"></script>
    <script type="application/x-javascript" src="js/jquery.vticker.1.4.js"></script>
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
        
        $('#news-container').vTicker({ 
		speed: 1000,
		pause: 3000,
		animation: 'fade',
		mousePause: true,
		showItems: 3,
                height: 0 //default 0=off
	});
        
    });
    
    function message(string){
        var m = $("#divmessage");
        m.empty();
        m.text(string);
        m.slideDown().delay(3000).fadeOut("slow");
    }

    function redirect(url){
        window.location = url;
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
        <tr><td colspan="2" class="title"><h1>Annonces</h1></td></tr>
        <tr><td colspan="2" class="mainmenu"><? print($menu); ?></td></tr>
        <tr>
            <td colspan="2" class="intro">
                <p>Gestion de vos annonces.</p>
            </td>
        </tr>
        <tr>
            <td class="content">Ici vous allez pouvoir créer vos CV et ainsi pouvoir les publier pour que les entreprises
            locales puissent vous connaitre et, peut &ecirc;tre vous contacter.
            </td>
            
            <td style="width:250px;">
                <div class="vticker" id="news-container"> 
                    <ul> 
                        <li> 
                            <div> 
                                1) Lorem ipsum dolor sit amet, porta at, imperdiet id neque. more info
                            </div> 
                        </li> 
                        <li> 
                            <div> 
         
                                2) Lorem ipsum dolor sit amet, consectetur adipiscing elit. more info
                            </div> 
                        </li> 
                        <li> 
                            <div> 
                                3) Lorem ipsum dolor sit amet more info more info more info more info
                            </div> 
                        </li>   
                        <li> 
                            <div> 
                                4) jugbit.com jquery vticker more info more info more info more info more info
                            </div> 
                        </li> 
                    </ul> 
                </div> 
            </td>
        </tr>
        <?php print FOOTNOTE; ?>
    </table>
    
</body>
</html>
