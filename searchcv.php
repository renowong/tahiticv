<?php
/* includes */
include_once("mods/searchcv/searchcv_top.php");
include_once("menu.php"); /* this includes cookie check and custom menu */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=Windows-1252">
    <title><? print(SITENAME) ?></title>
    <!-- jquery -->
    <script type="application/x-javascript" src="js/jquery.js"></script>
    <script type="application/x-javascript">
    $(document).ready(function () {
        $("#divmessage").hide();
        $("#divvisu").hide();
        
        toggle_filter('off','slt_cat','lbl_cat');
        toggle_filter('off','slt_dip','lbl_dip');
        /* implement exit */
        $("#sortir").click(function(){
            message("Fermeture session");
            document.cookie = "user=;expires=Thu, 01-Jan-1970 00:00:01 GMT";
            setTimeout("redirect('index.php')",1000);
        });
        
        /*this makes message div stay on top*/
        $(window).scroll(function () {
            $("#divmessage").css("top",$(window).scrollTop()+"px");
            $("#divvisu").css("top",$(window).scrollTop()+50+"px");
        });
        var cv = getUrlVars()["cv"];
        //alert(cv);
        if(typeof cv!="undefined"){
            show_visu(cv);
        }else{
            search();
        }
        
    });
    
    function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
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
    
    function toggle_filter(chk,filter,label){
        if(chk=="on"){
            $("#"+filter).css("text-decoration","none");
            $("#"+filter).attr('disabled', '');
            $("#"+label).css("text-decoration","none");
            
        } else {
            $("#"+filter).css("text-decoration","line-through");
            $("#"+filter).attr("disabled","disabled");
            $("#"+label).css("text-decoration","line-through");
        }
    }
    
    function search(){
        var cat;
        var dip;
        var chk_cat = $("#chk_cat").attr("checked");
        var chk_dip = $("#chk_dip").attr("checked");
        if(chk_cat=='true' || chk_cat==true){cat = $("#slt_cat").val();}else{cat = "";}
        if(chk_dip=='true' || chk_dip==true){dip = $("#slt_dip").val();}else{dip = "";}

        //message("Recherche en cours...");
        $.post("mods/searchcv/searchcv_query.php", {cat:cat,dip:dip},
        function(response) {
            results = readresponse(response);
            //alert(response);
        },'xml');
        //});
    }
    
    function readresponse(xml){
        var userid;
        var id;
        var content="<table style='text-align:center;width:100%;'>";
        var favlink="";
        var counter=0;
        $("#results").html("Pas de R&eacute;sultats.");
        $(xml).find("response").each(function(){
            var success = $(this).attr("success");
            var msg = $(this).attr("msg");
            message(msg);
        });
        $(xml).find("cv").each(function(){    
            id = $(this).find("id").text();
            cvopen = $(this).find("open").text();
            nom = $(this).find("nom").text();
            prenom = $(this).find("prenom").text();
            isfav = $(this).find("isfav").text();
            if(isfav==='0'){
                favlink = "<span id='fav_"+id+"'><a href='javascript:void(0)' onclick='fav(\""+id+"\",\"add\");'><img style='vertical-align: middle;' height='30px' src='images/favorite-add-icon.png'/></a></span>";
            }else{
                favlink = "<img style='vertical-align: middle;' height='30px' src='images/favorite-icon.png'/>";
            }
            counter++;
            if(counter%2!==0){content += "<tr>";}
            content += "<td>";
            if(cvopen=='1'){
                content += "<div name='cv_"+id+"' id='cv_"+id+"' style='padding:5px;width:100%;'><b>CV "+nom+" "+prenom+"</b> <a href='javascript:void(0)' onclick='show_visu(\""+id+"\");'><img style='vertical-align: middle;' height='30px' src='images/preview-icon.png'/></a> "+favlink+"</div>";  
            }else{
                content += "<div name='cv_"+id+"' id='cv_"+id+"' style='padding:5px;width:100%;'>CV num&eacute;ro "+id+" <a href='javascript:void(0)' onclick='show_visu(\""+id+"\");'><img style='vertical-align: middle;' height='30px' src='images/preview-icon.png'/></a> "+favlink+"</div>";  
            }
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
        $('#divvisu').load('includes/visual_announce.php?id='+id+'&showwhat=cv', function() {
        message('Chargement complété.');
        });
        $("#divvisu").slideDown();
    }
    
    function hide_chat(){
        $("#chat-bubble").hide();
    }
    
    function downloadpdf(id){
        window.open("html2pdf/createcv.php?id="+id,"cv");
    }
    
    function fav(id,action){
        message("Ajout\351 aux favoris");
        $.post("mods/favoris/favoris_submit.php", {id:id,action:action},
        function(response) {
            //message(response);
        });
        $("#fav_"+id).html("Favori Ajouté!");
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
    <style type="text/css">@import url("css/bubbles.css");</style>
    <style type="text/css">@import url("css/menu.css");</style>
</head>
<body>
    <div class="center"><div id="divmessage" class="msg">Chargement</div></div>
    <div class="center"><div id="divvisu" class="visu"></div></div>
    <table name="main_table" id="main_table" class="coinArrondi shadow">
        <?php print TOPMENU; ?>
        <tr><td colspan="2" class="title"><img src="images/drapeaupolynesie2.jpg" align="left" width=130 height=80></img><h1>Rechercher un CV</h1></td></tr>
        <tr><td colspan="2" class="mainmenu"><? print($menu); ?></td></tr>
        <tr>
            <td colspan="2" class="intro">
                <p>Le Module de Recherche des CV vous permet de ....</p>
            </td>
        </tr>
        <tr>
            <td class="content">
                <div class="chat-bubble" id="chat-bubble" onmouseover="hide_chat();">
                Pour filtrer vos recherches, cochez :
                <div class="chat-bubble-arrow-border"></div>
                <div class="chat-bubble-arrow"></div>
</div>
                <br />
                <input type="checkbox" name="chk_cat" id="chk_cat" onchange="toggle_filter(this.value,'slt_cat','lbl_cat');search();"/><label for="slt_cat" id="lbl_cat">S&eacute;lectionnez une cat&eacute;gorie : </label>
                    <select name="slt_cat" id="slt_cat" onchange="search();">
                        <?php print $build_from_type_cat ?>
                    </select>
                <br />
                <input type="checkbox" name="chk_dip" id="chk_dip" onchange="toggle_filter(this.value,'slt_dip','lbl_dip');search();"/><label for="slt_dip" id="lbl_dip">S&eacute;lectionnez un diplôme requis : </label>
                    <select name="slt_dip" id="slt_dip" onchange="search();">
                        <?php print $build_from_type_dip ?>
                    </select>
                    <div name="results" id="results" class="coinArrondi results"></div>
            </td>
            
            <td style="width:250px;">WIDGETS....</td>
        </tr>
        <?php print FOOTNOTE; ?>
    </table>
    
</body>
</html>
