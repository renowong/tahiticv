<?php
/* includes */
include_once("mods/searchannounce/searchannounce_top.php");
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
        $("#iles_prefs").hide();
        $("#cat_prefs").hide();
        $("#divvisu").hide();
        
        /* implement exit */
        $("#sortir").click(function(){
            message("Fermeture session");
            document.cookie = "user=;expires=Thu, 01-Jan-1970 00:00:01 GMT";
            setTimeout("redirect('index.php')",1000);
        });
        
        /*this makes message div stay on top*/ //bugs with divvisu
        $(window).scroll(function () {
            $("#divmessage").css("top",$(window).scrollTop()+"px");
            //$("#divvisu").css("top",$(window).scrollTop()+50+"px");
        });
        
        
        search();
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
    
    function toggle_showdiv(divchk,div){
        status = $("#"+divchk).attr("checked");
        if(status==true || status=='true'){ //pour compatibilité chrome et mozilla
            $("#"+div).slideDown("slow");
        }else{
            $("#"+div).slideUp("slow");
        }
        
    }
    
    function search(){
        var $inputs = $('#iles_prefs :input:checked');
        var iles="|";
        var cat="|";
        $inputs.each(function() {
        iles += $(this).val()+"|";
        });
        $inputs = $('#cat_prefs :input:checked');
        $inputs.each(function() {
        cat += $(this).val()+"|";
        });
            
        //message("Recherche en cours...");
        $.post("mods/searchannounce/searchannounces_query.php", {iles:iles,cat:cat},
        function(response) {
            results = readresponse(response);
            //alert(response);
        },'xml');
    }
    
    function readresponse(xml){
        var title;
        var id;
        var content="<table style='text-align:center;width:100%;'>";
        var counter=0;
        $("#results").html("Pas de R&eacute;sultats.");
        $(xml).find("response").each(function(){
            var success = $(this).attr("success");
            var msg = $(this).attr("msg");
            message(msg);
        });
        $(xml).find("announce").each(function(){    
            title = $(this).find("title").text();
            id = $(this).find("id").text();
            isfav = $(this).find("isfav").text();
            if(isfav==='0'){
                favlink = "<span id='fav_"+id+"'><a href='javascript:void(0)' onclick='fav(\""+id+"\",\"add\");'><img style='vertical-align: middle;' height='30px' src='images/favorite-add-icon.png'/></a></span>";
            }else{
                favlink = "<img style='vertical-align: middle;' height='30px' src='images/favorite-icon.png'/>";
            }
            counter++;
            if(counter%2!==0){content += "<tr>";}
            content += "<td>";
            content += "<div name='annonce_"+id+"' id='annonce_"+id+"'>"+title+" <a href='javascript:void(0)' onclick='show_visu(\""+id+"\");'><img style='vertical-align: middle;' height='30px' src='images/preview-icon.png'/></a> "+favlink+"</div>"; 
            content += "</td>";
            if(counter%2==0){content += "</tr>";}
        });
        content+="</tr></table>";
        $("#results").html(content);
    }
    
    function close_visu(){
        $("#divvisu").slideUp();
    }
    
    function show_visu(id){
        $('#divvisu').load('includes/visual_announce.php?id='+id+'&showwhat=announce', function() {
        message('Chargement complété.');
        initializemap($("#visu_lat").val(),$("#visu_lon").val(),8);
        });
        $("#divvisu").slideDown();
    }
    
    function check_all(check,prefdiv){
        var $inputs = $('#'+prefdiv+' :input');
        if(check){
            $inputs.attr("checked","checked");
        }else{
            $inputs.removeAttr("checked");
        }
    }
    
    function fav(id,action){
        message("Ajout\351 aux favoris");
        $.post("favoris_submit.php", {id:id,action:action},
        function(response) {
            //message(response);
        });
        $("#fav_"+id).html("Favori Ajouté!");
    }
    
    function sendmail(id){
        //alert("implementer l'envoi mail pour annonce #"+id);
        $.post("mods/mail/send_cv.php", {id:id},
        function(response) {
            message(response);
        });
        $("#email").html("CV envoy&eacute;!");
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
        <tr><td colspan="2" class="title"><h1>Recherche</h1></td></tr>
        <tr><td colspan="2" class="mainmenu"><? print($menu); ?></td></tr>
        <tr>
            <td colspan="2" class="intro">
                <p>Le module de recherche vous permettra de rechercher des annonces qui sont d'actualités.</p>
            </td>
        </tr>
        <tr>
            <td class="content">
            <div style="text-align:right;"><input type="button" onclick="search();" value="Rechercher" /></div>
            R&eacute;sultats des recherches suivants vos pr&eacute;f&eacute;rences : <br/>
            <input type="checkbox" id="chk_show_islands" onchange="toggle_showdiv(this.id,'iles_prefs');" />Afficher les &icirc;les dans lesquelles vous recherchez un emploi.<br/>
                <?php print $build_from_type_iles ?>
            <input type="checkbox" id="chk_show_cat" onchange="toggle_showdiv(this.id,'cat_prefs');" />Afficher les cat&eacute;gories dans lesquelles vous recherchez un emploi.<br/>
                <?php print $build_from_type_cat ?>
                <br/>
                <div name="results" id="results" class="coinArrondi results"></div>
            </td>
            
            <td style="width:250px;">
                WIDGETS....HERE
	    </td>
        </tr>
        <?php print FOOTNOTE; ?>
    </table>
    
</body>
</html>
