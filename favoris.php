<?php
/* includes */
include_once("mods/favoris/favoris_top.php");
include_once("menu.php"); /* this includes cookie check and custom menu */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=Windows-1252">
    <title><? print(SITENAME) ?></title>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>    
    <!-- jquery -->
    <script type="application/x-javascript" src="js/jquery.js"></script>
    <script type="application/x-javascript">
    $(document).ready(function () {
        $("#divmessage").hide();
        $("#divvisu").hide();
        
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
        
    });
    
    /*map*/
    function initializemap(lat,lon,z) {
    var latlng = new google.maps.LatLng(lat,lon);
    var myOptions = {
      zoom:z,
      maxZoom:15,
      minZoom:6,
      scrollwheel:false,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas_visual"),
        myOptions);
    
    var marker = new google.maps.Marker({
      position: latlng,
      map: map, 
      title:"Localisation approximative!"
    });
    
    marker.setMap(map);  
    }

    /*endmap*/
    
    function message(string){
        var m = $("#divmessage");
        m.empty();
        m.text(string);
        m.slideDown().delay(3000).fadeOut("slow");
    }

    function redirect(url){
        window.location = url;
    }
    
    function show_visu(id,type){
        //alert(type);
        $('#divvisu').load('includes/visual_announce.php?id='+id+'&showwhat='+type, function() {
        message('Chargement complété.');
        if(type=='announce'){initializemap($("#visu_lat").val(),$("#visu_lon").val(),8);}
        });
        $("#divvisu").slideDown();
    }

    function close_visu(){
        $("#divvisu").slideUp();
    }
    
    function delfav(id) {
        $.post("mods/favoris/favoris_submit.php", { action:'del', id: id },
        function(data) {
            //alert("Data Loaded: " + data);
        });
        //alert(id);
        $("#fav_"+id).remove();
    }
    
    function downloadpdf(id){
        window.open("html2pdf/createcv.php?id="+id,"cv");
    }
    
    function sendmail(id){
        $.post("mods/mail/request_cv.php", {id:id},
        function(response) {
            message(response);
        });
        $("#email").html("Demande envoy&eacute;e!");
    }
    
    </script>
    
        
    
    <!-- Stylesheets -->
    <style type="text/css">@import url("css/main.css");</style>
    <style type="text/css">@import url("css/menu.css");</style>
    <style type="text/css">@import url("css/map.css");</style>
</head>
<body>
    <div class="center"><div id="divmessage" class="msg">Chargement</div></div>
    <div class="center"><div id="divvisu" class="visu"></div></div>
    <table name="main_table" id="main_table" class="coinArrondi shadow">
        <?php print TOPMENU; ?>
        <tr><td colspan="2" class="title"><img src="images/drapeaupolynesie2.jpg" align="left" width=130 height=80></img><h1>Page de vos favoris</h1></td></tr>
        <tr><td colspan="2" class="mainmenu"><? print($menu); ?></td></tr>
        <tr>
            <td colspan="2" class="intro">
                <p>Cette page vous permet de retrouver vos précédentes annonces que vous avez ajouter à vos favoris. Ce qui évite de relancer une nouvelle recherche.</p>
            </td>
        </tr>
        <tr>
            <td class="content">Vos favoris sont les suivants :
            <div name="results" id="results" class="coinArrondi results"><?php print $favorites; ?></div>
            </td>
        
            
            <td style="width:250px;">WIDGETS....</td>
        </tr>
        <?php print FOOTNOTE; ?>
    </table>
    
</body>
</html>
