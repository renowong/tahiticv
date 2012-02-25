<?php
/* includes */
//include_once("includes/global_vars.php");
include_once("mods/announces/announces_top.php");
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
            $("#divvisu").css("top",$(window).scrollTop()+50+"px");
        });
        
        $("#form_announce").submit(function(event) {
            /* stop form from submitting normally */
            event.preventDefault();
            var $form = $( this ),
            url = $form.attr( 'action' );
            /*check mandatory fields*/
            var id = $("input#id");
            var titre = $("input#txt_titre");
            var categorie = $("select#categorie");
            var localisation = $("select#localisation");
            var ref = $("input#txt_ref");
            var type_contrat = $("select#type_contrat");
            var desc_poste = $("textarea#txt_desc_poste");
            var desc_comp = $("textarea#txt_desc_comp");
            var desc_exp = $("textarea#txt_desc_exp");
            var desc_dip = $("input#txt_desc_dip");
            var lat = $("#lat").html();
            var lon = $("#lon").html();
            var expires = $("input#txt_expires");
            
            if (titre.val() == "") {
              message("Veuillez entrer un titre.");
              titre.addClass("incorrect");
              titre.focus();
              return false;
            }
            if (desc_poste.val() == "") {
              message("Veuillez entrer une description de poste.");
              desc_poste.addClass("incorrect");            
              desc_poste.focus();
              return false;
            }
            if (desc_comp.val() == "") {
              message("Veuillez entrer au minimum une comp\351tence requise.");
              desc_comp.addClass("incorrect");            
              desc_comp.focus();
              return false;
            }
            
            if (expires.val() == "") {
              message("Veuillez entrer une date d'expiration.");
              expires.addClass("incorrect");            
              expires.focus();
              return false;
            }
            
            /* Send the data using post and put the results in a div */
            $.post( url, {
                id_annonce: id.val(),
                titre: titre.val(),
                categorie : categorie.val(),
                localisation : localisation.val(),
                ref : ref.val(),
                type_contrat : type_contrat.val(),
                desc_poste : desc_poste.val(),
                desc_comp : desc_comp.val(),
                desc_exp : desc_exp.val(),
                desc_dip : desc_dip.val(),
                lat : lat,
                lon : lon,
                expires : expires.val()
            } ,function(response) {
                readresponse(response);
                //alert(response);
                load_existing();
                scroll(0,0);
            },"xml");
            //});
            return false; 
        });
        
        load_existing();
        initializemap('-17.629299','-149.454575',8);
        
        //calendar epoch
        var dp_cal;
        dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('txt_expires'));
    });
    
    /*map*/
    function initializemap(lat,lon,z,mapname) {
    if(mapname==null){mapname="map_canvas";};
    var latlng = new google.maps.LatLng(lat,lon);
    var myOptions = {
      zoom:z,
      maxZoom:15,
      minZoom:6,
      scrollwheel:false,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById(mapname),
        myOptions);
    
    if(mapname==="map_canvas_visual"){
        var marker = new google.maps.Marker({
          position: latlng,
          map: map, 
          title:"Localisation approximative!"
        });
    }
    
    
    google.maps.event.addListener(map, 'dragend', function() {
    var center = map.getCenter();
        updateLatLonFields(center.lat(), center.lng());
    });
    }
  
    function updateLatLonFields(lat, lon) {
        $("#lat").html(lat);
        $("#lon").html(lon);
    }
    /*endmap*/
    
    function readresponse(xml){
        var list="";
        var title="";
        var expires="";
        var id="";
        var success="";
        var msg="";
        $(xml).find("response").each(function(){
            success = $(this).attr("success");
            msg = $(this).attr("msg");
            message(msg);
            $("#reset").trigger('click');
        });
        $(xml).find("announce").each(function(){
            update = $(this).attr("update")+0;
            activation = $(this).find("activation").text();
            title = $(this).find("title").text();
            expires = $(this).find("expiration").text();
            id = $(this).find("id").text();
            list+=build_list(id,title,activation,expires);
            //alert(list);
        });
        
        $("#liste_annonces").html(list);
       //if(!update){$("#liste_annonces").append(list);}
    }
    
    function load_existing(){
        $.get("mods/announces/get_announces.php", {},
        function(response) {
            readresponse(response);
            //alert(response);
        //},'xml');
        });
    }
    
    function del_announce(tbl,id){
        $.get("mods/announces/del_row.php", {tbl:tbl,id:id},
        function(response) {
            //readresponse(response);
            //alert(response);
        });
        $("#annonce_"+id).remove();
    }
    
    function edit_announce(id){
        if($("#id").val()!==""){
            msg = "Veuillez terminer d'\351diter l'annonce pr\351c\351dente avant de continuer.";
            message(msg);
            return false;
        };
        $.get("mods/announces/get_announces.php", {id:id},
        function(response) {
            load_announce(response);
            //alert(response);
        });
        $("#annonce_"+id).remove();
    }
    
    function activate_announce(id){
        var activation = $("#activation_val").val();
        var expires = $("#expires_"+id).val();
        var date_valid = CompareDates(expires);
        if(!date_valid){activation='0';}
        $.post("mods/announces/activation.php", {id:id,activation:activation},
        function(response) {
            //alert(response);
        });
        if(!date_valid){alert("Annonce expir\351e!");}
        if(activation==1&&date_valid){
            $("#annonce_table_"+id).css("background-color","#66FF33");
            $("#activation_val").val("0");
        }else{
            $("#annonce_table_"+id).css("background-color","red");
            $("#activation_val").val("1");
        }
        
    }    
    
    function load_announce(xml){
        $(xml).find("announce").each(function(){
            id = $(this).find("id").text();
            title = $(this).find("title").text();
            id_ile = $(this).find("id_ile").text();
            id_categorie = $(this).find("id_categorie").text();
            ref_interne = $(this).find("ref_interne").text();
            desc_poste = $(this).find("desc_poste").text();
            desc_dip = $(this).find("desc_dip").text();
            desc_exp = $(this).find("desc_exp").text();
            desc_comp = $(this).find("desc_comp").text();
            type_contrat = $(this).find("type_contrat").text();
            expiration = $(this).find("expiration").text();
            lat = $(this).find("lat").text();
            lon = $(this).find("lon").text();
            
            $("#id").val(id);
            $("#txt_titre").val(title);
            $("#txt_ref").val(ref_interne);
            $("#txt_desc_poste").val(desc_poste);
            $("#txt_desc_comp").val(desc_comp);
            $("#txt_desc_exp").val(desc_exp);
            $("#txt_desc_dip").val(desc_dip);
            $("#categorie").val(id_categorie).attr('selected',true);
            $("#localisation").val(id_ile).attr('selected',true);
            $("#type_contrat").val(type_contrat).attr('selected',true);
            $("#txt_expires").val(expiration);
            
            //var job_loc = new google.maps.LatLng(lat, lon);
            //map.setCenter(job_loc);
            initializemap(lat,lon,15);
        });
    }

    
    function build_list(id,title,activation,expires){
        var date_valid = CompareDates(expires);
        if(activation==1&&date_valid){
            activation="background-color:#66FF33';";
            activation_val=0;
        }else{
            activation='';
            activation_val=1;
        }
        var div_content = "<div name='annonce_"+id+"' id='annonce_"+id+"'><table class='existing_announce' style='width:300px;"+activation+"' name='annonce_table_"+id+"' id='annonce_table_"+id+"'><tr><td style='font-size:medium;'><b>"+title+"</b><br/><i>expire le "+expires+"</i><input type='hidden' id='expires_"+id+"' value='"+expires+"'/></td></tr><tr><td><a href='javascript:void(0)' onclick='show_visu(\""+id+"\");' title='Visualiser Annonce'><img style='vertical-align: middle;' height='30px' src='images/preview-icon.png'/></a> <a href='javascript:void(0)' onclick='edit_announce(\""+id+"\");' title='Editer Annonce'><img style='vertical-align: middle;' height='30px' src='images/edit.png'/></a> <a href='javascript:void(0)' onclick='del_announce(\"annonces\",\""+id+"\");' title='Supprimer Annonce'><img style='vertical-align: middle;' height='30px' src='images/trash.png'/></a> <a href='javascript:void(0)' onclick='del_announce(\"annonces\",\""+id+"\");' title='Supprimer Annonce'> <input type='hidden' id='activation_val' value='"+activation_val+"' /><a href='javascript:void(0)' onclick='activate_announce(\""+id+"\");' title='Activer - Désactiver Annonce'><img style='vertical-align: middle;' height='30px' src='images/power.png'/></a></td></tr></table></div>";
        return div_content;
    }
    
    function CompareDates(str1){
        var dt1  = parseInt(str1.substring(0,2),10);
        var mon1 = parseInt(str1.substring(3,5),10);
        var yr1  = parseInt(str1.substring(6,10),10);
        var date1 = new Date(yr1, mon1-1, dt1);
        var date2 = new Date();
        if(date2 > date1)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    function removeclass(input){
        $(input).removeClass("incorrect");
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
    
    function close_visu(){
        $("#divvisu").slideUp();
    }
    
    function show_visu(id){
        $('#divvisu').load('includes/visual_announce.php?id='+id+'&showwhat=announce', function() {
        message('Chargement complété.');
        initializemap($("#visu_lat").val(),$("#visu_lon").val(),8,"map_canvas_visual");
        });
        $("#divvisu").slideDown();
    }
    
    function resetid(){
        $("#id").val('');
        initializemap('-17.629299','-149.454575',8);
        //alert($("#id").val());
    }
    </script>
    
    <script type="text/javascript" src="js/epoch_classes.js"></script>
    
    <!-- Stylesheets -->
    <style type="text/css">@import url("css/main.css");</style>
    <style type="text/css">@import url("css/menu.css");</style>
    <style type="text/css">@import url("css/map.css");</style>
    <style type="text/css">@import url("css/epoch_styles.css");</style>
        
</head>
<body>
    <div class="center"><div id="divmessage" class="msg">Chargement</div></div>
    <div class="center"><div id="divvisu" class="visu"></div></div>
    <table name="main_table" id="main_table" class="coinArrondi shadow">
        <?php print TOPMENU; ?>
        <tr><td colspan="2" class="title"><img src="images/drapeaupolynesie2.jpg" align="left" width=130 height=80></img><h1>Gestion des annonces</h1></td></tr>
        <tr><td colspan="2" class="mainmenu"><? print($menu); ?></td></tr>
        <tr>
            <td colspan="2" class="intro">
                <p>Le module de gestion des annonces vous permet de ....</p>
            </td>
        </tr>
        <tr>
            <td class="content">
                <form action="mods/announces/update_announces.php" name="form_announce" id="form_announce" method="post">
                    <table name="announce" id="announce" class="coinArrondi">
                        <tr>
                            <td class="coinArrondi form">
                                <input type="hidden" name="id" id="id"/>
                                <label for="txt_titre">Titre de votre annonce <span class="important">*</span> : </label><br/><input type="text" name="txt_titre" id="txt_titre" size="40" maxlength="75" onkeydown="removeclass(this);" /><br/><br/>
                                <label for="categorie">Cat&eacute;gorie de l'emploi : </label><br/><select name="categorie" id="categorie"><?php print($categories); ?></select><br/><br/>
                                <label for="localisation">Localisation de l'emploi : </label><br/><select name="localisation" id="localisation"><?php print($iles); ?></select><br/><br/>
                                <label for="txt_ref">Votre r&eacute;f&eacute;rence interne : </label><br/><input type="text" name="txt_ref" id="txt_ref" size="20" maxlength="15" /><br/><br/>
                                <label for="type_contrat">Type de contrat propos&eacute; : </label><br/><select name="type_contrat" id="type_contrat"><?php print($contrats); ?></select><br/><br/>
                                <label for="txt_desc_poste">Description du poste <span class="important">*</span> : </label><br/><textarea name="txt_desc_poste" id="txt_desc_poste" cols="40" rows="3" wrap="SOFT" onkeydown="removeclass(this);"></textarea><br/><br/>
                                <label for="txt_desc_comp">Description des comp&eacute;tences requises <span class="important">*</span> : </label><br/><textarea name="txt_desc_comp" id="txt_desc_comp" cols="40" rows="3" wrap="SOFT" onkeydown="removeclass(this);"></textarea><br/><br/>
                                <label for="txt_desc_exp">Description des exp&eacute;riences requises : </label><br/><textarea name="txt_desc_exp" id="txt_desc_exp" cols="40" rows="3" wrap="SOFT"></textarea><br/><br/>
                                <label for="txt_desc_dip">Dipl&ocirc;me(s) requis : </label><br/><input type="text" name="txt_desc_dip" id="txt_desc_dip" size="40" maxlength="75"/><br/><br/>
                                <label for="txt_expires">Expiration de l'annonce : </label><br/><form id="placeholder" method="get" action="#">
                                        <input id="txt_expires" type="text" READONLY/>
                                    </form><br/><br/>
                                <span class="important">* Champs obligatoires</span>
                            </td>
                            <td style="width:100%;padding:15px;">
                                <span style="font-weight:bold;">Liste de vos annonces existantes :</span>
                                <div name="liste_annonces" id="liste_annonces"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Localisation g&eacute;ographique de l'emploi:
                                <div id="crosshair"></div>
                                <div id="map_canvas"></div>
                                <div id="ft"> 
                                    <p><strong>Latitude:</strong> <span id="lat">-17.629299</span><br />
                                    <strong>Longitude:</strong> <span id="lon">-149.454575</span></p>
                                </div> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" onclick="initializemap('-17.629299','-149.454575',8);">Carte RAZ</button><button type="reset" name="reset" id="reset" onclick="resetid();">Remise à z&eacute;ro</button><button type="submit" name="submit" id="submit">Soumettre l&apos;annonce</button>
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
            
            <td style="width:250px;">
                WIDGETS....HERE
            </td>
        </tr>
        <?php print FOOTNOTE; ?>
    </table>
    
</body>
</html>
