<?php
/* includes */
include_once("mods/compose/compose_top.php");
//include_once("includes/global_vars.php");  -- alreadly included in compose_top.php
include_once("menu.php"); /* this includes cookie check and custom menu */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=Windows-1252">
    <title><? print(SITENAME) ?></title>
    <!-- jquery -->
    <script type="application/x-javascript" src="js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="css/jsDatePick_ltr.css" />
    <script type="text/javascript" src="js/jsDatePick.jquery.full.1.3.js"></script>
    <script type="text/javascript" src="js/inputcontrols.js"></script>
    <script type="application/x-javascript">
    $(document).ready(function () {
        $("#divmessage").hide();
        $('#pic1').hide();
        
        /* implement exit */
        $("#sortir").click(function(){
            message("Fermeture session");
            document.cookie = "user=;expires=Thu, 01-Jan-1970 00:00:01 GMT";
            setTimeout("redirect('index.php')",1000);
        });
        
        /* load existing data */
        loaddata();
        
        /*load calendar*/  //example only, calendar not convenient here
        //new JsDatePick({
        //    useMode:2,
        //    target:"txt_dn",
        //    dateFormat:"%d-%m-%Y",
        //    cellColorScheme:"ocean_blue"
        //});
        
        /*this makes message div stay on top*/
        $(window).scroll(function () {
            $("#divmessage").css("top",$(window).scrollTop()+"px");
        });
    });
    
    
    function loaddata() {
        $.get("mods/compose/get_cv.php", {},
        function(response) {
            readresponse(response);
            //alert(response);
        },'xml');
    }
    
    
    function readresponse(xml){
        var date_expire;
        var success="";
        var msg="";
        var ar_dn;
        var d = new Date();
        var currentYear = d.getFullYear();
        $(xml).find("response").each(function(){
            success = $(this).attr("success");
            msg = $(this).attr("msg");
            date_expire = $(this).find("expire").text();
            message(msg);
            $("#idcv").val($(this).find("idcv").text());
            $("#txt_nom").val($(this).find("nom").text());
            $("#txt_prenom").val($(this).find("prenom").text());
            $("#txt_prenom2").val($(this).find("prenom2").text());
            if($(this).find("dn").text()!=='') {$("#txt_dn").val(date_format($(this).find("dn").text()));};
            if($(this).find("open").text()==1) {$("#chk_open").attr("checked", "checked");};
            $("#avatar").val($(this).find("avatar").text());
            loadAvatar();
            $("#txt_adresse").val($(this).find("adresse").text());
            $("#txt_tel").val($(this).find("telephone").text());
            $("#txt_vini").val($(this).find("mobile").text());
            $("#txt_fax").val($(this).find("fax").text());
            $("#txt_email").val($(this).find("email").text());
            $("#txt_web").val($(this).find("web").text());
            $("#txt_objectif").val($(this).find("objectif").text());
            
            ar_dn = $("#txt_dn").val();
            ar_dn = ar_dn.split('-');
            
            build_select(1,31,'slt_dn_jour',ar_dn[0]);
            build_select(1,12,'slt_dn_mois',ar_dn[1]);
            build_select(1925,currentYear,'slt_dn_annee',ar_dn[2]);
            
            /*etat civil data loaded, next load experiences*/
            var exp_ids = $(this).find("experiences_ids").text();
            ids_extract_and_load('exp',exp_ids);
            
            /*experiences data loaded, next load diplomas*/
            var dip_ids = $(this).find("educations_ids").text();
            ids_extract_and_load('dip',dip_ids);
            
            /*diplomas data loaded, next load certifications*/
            var cert_ids = $(this).find("certifications_ids").text();
            ids_extract_and_load('cert',cert_ids);
            
            /*certifications data loaded, next load competences*/
            var comp_ids = $(this).find("competences_ids").text();
            ids_extract_and_load('comp',comp_ids);
            
            /*competences data loaded, next load languages*/
            var lang_ids = $(this).find("langues_ids").text();
            ids_extract_and_load('lang',lang_ids);
            
            /*languages data loaded, next load hobbies*/
            var cint_ids = $(this).find("centre_interets_ids").text();
            ids_extract_and_load('cint',cint_ids);
            
            /*set expire button*/
            actif_inactif(date_expire);
        });
    }
    
    function actif_inactif(date_expire){
        var today = new Date();
        var jsexpire_date = date_expire.replace(/-/g,", ");
        var expire = new Date(jsexpire_date);
        var expired = today > expire;
        if(expired){
            $("#status").empty;
            $("#status").text("Désactivé");
            $("#trstatus").css("background-color","red");
            $("#btn_status").attr('value','Activer');
        }else{
            $("#status").empty;
            $("#status").text("Activé (jusqu'au "+date_format(date_expire)+")");
            $("#btn_status").attr('value','Désactiver');
        };
    }
    
    function toggle_active(status){
        //alert(status);
        if(status=="Activer"){
            var today = new Date()
            var this_year = today.getFullYear();
            var next_month = today.getMonth();
            next_month++;            
            var this_day = today.getDate();
            //if(this_day==31){this_day=30;}
            //if(this_day>28 && next_month==2){this_day=28;}

            var in_a_month = new Date(this_year, next_month, this_day);
            //changer le status
            actif_inactif(formatDatetoMysql(in_a_month));
            $("#trstatus").css("background-color","#66FF33");
            //envoyer une nouvelle date dans db
            updatedata('cv','date_expiration',formatDatetoMysql(in_a_month))
            
        } else {
            actif_inactif("1900-01-01");
            $("#trstatus").css("background-color","red");
            updatedata('cv','date_expiration',"1900-01-01")
        }
        
    }
    
    function formatDatetoMysql(date1) {
    return date1.getFullYear() + '-' +
    (date1.getMonth() < 9 ? '0' : '') + (date1.getMonth()+1) + '-' +
    (date1.getDate() < 10 ? '0' : '') + date1.getDate();
    }
    
    function ids_extract_and_load(div,ids){
        //alert(div+ids);
        var split_result = ids.split("|");
        split_result = split_result.slice(1,split_result.length-1);
        //alert(split_result);
        for(i = 0; i < split_result.length; i++){
            //alert(split_result[i]);
            if(split_result[i]!==''){loaddiv(div, split_result[i]);}
        }

    }

    function message(string){
        var m = $("#divmessage");
        m.empty();
        m.text(string);
        //m.text(m.offset().top);
        m.slideDown().delay(3000).fadeOut("slow");
    }


    function redirect(url){
        window.location = url;
    }
    
    
    function loaddiv(div,id) {
        var randomnumber=Math.floor(Math.random()*1000000);
        var idcv = $("#idcv").val();
        //alert("includes/"+div+"_plugin.php?id="+randomnumber+"&idcv="+idcv+"&"+div+"id="+id);
        $("<div id='parent_"+randomnumber+"'>").load("includes/"+div+"_plugin.php?id="+randomnumber+"&idcv="+idcv+"&"+div+"id="+id, function(){
            if(!$("#"+div).is(':empty')){$("#"+div).append("<hr id='hr_"+randomnumber+"'/>")};
            $("#"+div).append($(this));
            });
    }
    
    function deletediv(id,pluginname,pluginid) {
        //alert("removing divid "+id);
        var yesno = confirm("Etes-vous sûr(e) de vouloir supprimer cette donnée?");
        if(yesno){
            var idcv = $("#idcv").val();
            $.get("mods/compose/del_piped_data.php", { tbl:'cv', id: idcv, col: pluginname, data : pluginid  },
            function(data) {
                //alert("Data Loaded: " + data);
            });
            //alert(id);
            $("#"+id).remove();
            $("#parent_"+id).remove();
            $("#hr_"+id).remove();
        }
    }
    
    function updatedata(tbl,col,value,type,plugin_id,tbl_parent){
        switch (type){
            case 'date':
                value = date_format(value);
            break;
        
            case 'checkbox':
                if(value=="on"){value=1;}else{value=0;};
            break;
        
            case 'annee':
                if(value!==""){
                    var valide = validate_annees(value);
                    if(!valide){return false;}    
                }
            break;
        
            case 'email':
                if(value!==""){
                    var valide = validate_email(value);
                    if(!valide){return false;}    
                }
            break;
        
            case 'url':
                if(value!==""){
                    var valide = validate_url(value);
                    if(!valide){return false;}    
                }
            break;
        
            case 'numbers':
                if(value!==""){
                    var valide = validate_numbers(value);
                    if(!valide){return false;}    
                }
            break;
            
            case 'letters':
                if(value!==""){
                    var valide = validate_letters(value);
                    if(!valide){return false;}    
                }
            break;
            
            default:
                //value = addslashes(value);
                //alert(value);
        }
        
        //alert(col);
        $.post("mods/compose/update_cv.php", { tbl: tbl, col: col, value: value, plugin_id: plugin_id },
        function(data) {
            //alert("Data Loaded: " + data);
        });
    }

    function date_format(date){
        var arrdate = date.split("-");
        return arrdate[2]+"-"+arrdate[1]+"-"+arrdate[0];
    }
    
    function addcomp_exp_plugin(divid,expid,cvid,compid){
        //alert("includes/comp_exp_plugin.php?divid="+divid+"&expid="+expid+"&cvid="+cvid+"&compid="+compid);
        $("<div>").load("includes/comp_exp_plugin.php?divid="+divid+"&expid="+expid+"&cvid="+cvid+"&compid="+compid, function(){
            $("#comp_exp_"+divid).append($(this));
            });
    }
    
    function delete_comp_exp(id,compid,expid) {
        //alert(id+" "+compid+" "+expid);
        $.get("mods/compose/del_piped_data.php", { tbl:'experiences', id: expid, col: 'competences', data : compid  },
        function(data) {
            //alert("Data Loaded: " + data);
        });
        $("#"+id).remove();
    }
    
    function build_select(start,end,select,selected){
        var output = "";
        var i;
        var zero;
        for(i=start;i<=end;i++){
            if(i<10){zero="0";}else{zero="";}
            $('#'+select).append($('<option></option>').val(zero+i).html(zero+i));
        }
        $('#'+select).val(selected);
    }
    
    function build_dn(){
        var day = $("#slt_dn_jour").val();
        var month = $("#slt_dn_mois").val();
        var year = $("#slt_dn_annee").val();
        
        $("#txt_dn").val(day+"-"+month+"-"+year);
        updatedata('cv','date_naissance',$("#txt_dn").val(),'date');
    }
    
    function set_exemple(id){
        var comp_input = $("#txt_competence_"+id);
        var ex = $("#ex_comp_"+id);
        comp_input.val(ex.val());
    }
    
    function downloadpdf(){
        var id = $("#idcv").val();
        window.open("html2pdf/createcv.php?id="+id,"cv");

    }
    var Childwin;
    var Childtimer;
    
    function wopen(url, name, w, h){
        Childwin = window.open(url,
          name, 
          'width=' + w + ', height=' + h + ', ' +
          'location=no, menubar=no, ' +
          'status=no, toolbar=no, scrollbars=no, resizable=no');
         Childwin.focus();
         $('#pic1').delay(500).fadeOut(1500);
         $('#pic0').delay(2000).fadeIn(1500);
         Childtimer = setInterval("checkChild()", 500);
    }
    
    function checkChild() {
        if (!Childwin || Childwin.closed) {
            updateavatar($("#avatar").val());
            loadAvatar();
            clearInterval(Childtimer);
        }
    }
    
    function loadAvatar(){
        if($("#avatar").val()!==""){
            $("#pic1").attr("src","<? print AVATARPATH; ?>"+$("#avatar").val());
            $('#pic0').delay(500).fadeOut(1500);
            $('#pic1').delay(2000).fadeIn(1500);
        }
    }
    
    function updateavatar(avatar){
        $.post("mods/compose/update_avatar.php", { avatar: avatar },
        function(data) {
            //alert("Data Loaded: " + data);
        });
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
        <tr><td colspan="2" class="title"><h1>Composition CV</h1></td></tr>
        <tr><td colspan="2" class="mainmenu"><? print($menu); ?></td></tr>
        <tr>
            <td class="content">
                <form name="frm_cv" action="cv_submit.php" method="POST" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="idcv" id="idcv"/>
                    <table class="coinArrondi" style="border:double 2px;">
                        <tr>
                            <td colspan="2">
                                <br />
                                <table style="border:1px;width:100%;">
                                    <tr>
                                        <td id="trstatus" class="trstatus">
                                            Status : <span id="status" name="status"></span> | <input type="button" name="btn_status" id="btn_status" value="" onclick="toggle_active(this.value)" /> | <a href="javascript:downloadpdf();" style="vertical-align:inherit;" target="_blank"><img style="vertical-align:inherit;" src="images/pdf_icon.png"/></a>                 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="hidden" id="avatar" name="avatar" value=""/>
                                            <div id="avatar_div" style="position:absolute;top:15em;z-index:90;float:left;">
                                                <a href="javascript:void(0);" onClick="wopen('cropscript/index.php', 'avatar', '1080', '750'); return false;">
                                                <img id="pic0" src="images/unknown-person.jpg" width="134" height="167" style="border:1px solid black;"/><img id="pic1" src="images/unknown-person.jpg" style="border:1px solid black;"/>
                                                </a>
                                            </div>   
                                        </td>
                                    </tr>
                                </table>
                                <br /><br /><br /><br /><br /><br />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="txt_nom">Nom : </label><br/><input type="text" name="txt_nom" id="txt_nom" class="allcaps" size="25" maxlength="20" onblur="updatedata('cv','nom',this.value,'letters');" /><br/>
                                <label for="txt_prenom">Pr&eacute;nom : </label><br/><input type="text" name="txt_prenom" id="txt_prenom" class="firstcap" size="25" maxlength="20" onblur="updatedata('cv','prenom',this.value,'letters');" /><br/>
                                <label for="txt_prenom2">Deuxi&egrave;me Pr&eacute;nom : </label><br/><input type="text" name="txt_prenom2" id="txt_prenom2" class="firstcap" size="25" maxlength="20" onblur="updatedata('cv','prenom2',this.value,'letters');" /><br/>
                                <label for="txt_dn">Date de Naissance : </label><br/>
                                <select name="slt_dn_jour" id="slt_dn_jour" onchange="build_dn();"></select>
                                <select name="slt_dn_mois" id="slt_dn_mois" onchange="build_dn();"></select>
                                <select name="slt_dn_annee" id="slt_dn_annee" onchange="build_dn();"></select>
                                <input type="hidden" name="txt_dn" id="txt_dn" size="10" maxlength="10" onblur="updatedata('cv','date_naissance',this.value,'date');" readonly /><br/><br/>
                                <span class="nota">Nota : Les informations d&apos;&eacute;tat civil ne seront divulgu&eacute;es que sur votre autorisation.<br/>
                                Si toutefois, vous d&eacute;sirez laisser libre acc&egrave;s &agrave; ces informations, veuillez cocher :</span><br/>
                                <input type="checkbox" name="chk_open" id="chk_open" onchange="updatedata('cv','open',this.value,'checkbox');" /> <span class="important">Autoriser le libre acc&egrave;s</span>
                            </td>
                            <td>
                                <label for="txt_adresse">Adresse Postale : </label><br/><textarea name="txt_adresse" id="txt_adresse" cols="40" rows="3" wrap="SOFT" onblur="updatedata('cv','adresse',this.value);"></textarea><br/>
                                <label for="txt_tel">T&eacute;l : </label><br/><input type="text" name="txt_tel" id="txt_tel" size="25" maxlength="15" onblur="updatedata('cv','telephone',this.value,'numbers');"/><br/>
                                <label for="txt_vini">Vini : </label><br/><input type="text" name="txt_vini" id="txt_vini" size="25" maxlength="15" onblur="updatedata('cv','mobile',this.value,'numbers');"/><br/>
                                <label for="txt_fax">Fax : </label><br/><input type="text" name="txt_fax" id="txt_fax" size="25" maxlength="15" onblur="updatedata('cv','fax',this.value,'numbers');"/><br/>
                                <label for="txt_email">Email : </label><br/><input type="text" name="txt_email" id="txt_email" size="40" maxlength="25" class="allscaps" onblur="updatedata('cv','email',this.value,'email');"/><br/>
                                <label for="txt_web">Site Web : </label><br/><input type="text" name="txt_web" id="txt_web" size="40" class="allscaps" maxlength="50" onblur="updatedata('cv','web',this.value,'url');"/><br/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="txt_objectif">Objectifs : </label><br/><textarea name="txt_objectif" id="txt_objectif" cols="85" rows="5" wrap="SOFT" onblur="updatedata('cv','objectif',this.value);"></textarea>
                            </td>
                        </tr>
                        <tr class="cv_exp">
                            <td colspan="2" style="border:solid 1px;">
                                <h3>Exp&eacute;riences Professionnelles : </h3>
                                <div name="exp" id="exp" class="coinArrondi"></div><br>
                                <input type="button" value="Ajouter une nouvelle exp&eacute;rience professionnelle" onclick="loaddiv('exp');">
                            </td>
                        </tr>
                        <tr class="cv_diplome">
                            <td colspan="2" style="border:solid 1px;">
                                <h3>Dipl&ocirc;mes/Formations : </h3>
                                <div name="dip" id="dip" class="coinArrondi"></div><br>
                                <input type="button" value="Ajouter un nouveau dipl&ocirc;me" onclick="loaddiv('dip');">
                            </td>
                        </tr>
                        <tr class="cv_cert">
                            <td colspan="2" style="border:solid 1px;">
                                <h3>Certifications/Autres aptitudes : </h3>
                                <div name="cert" id="cert" class="coinArrondi"></div><br>
                                <input type="button" value="Ajouter une nouvelle certification" onclick="loaddiv('cert');">
                            </td>
                        </tr>
                        <tr class="cv_comp">
                            <td colspan="2" style="border:solid 1px;">
<!--                                Compétences : <br/>
                                Compétence : <input type="text" name="txt_competence" id="txt_competence" size="70" maxlength="50" />[X]<br/>-->
                                <h3>Comp&eacute;tences : </h3>
                                <div name="comp" id="comp" class="coinArrondi"></div><br>
                                <input type="button" value="Ajouter une nouvelle comp&eacute;tence" onclick="loaddiv('comp');">
                            </td>
                        </tr>
                        <tr class="cv_lang">
                            <td colspan="2" style="border:solid 1px;">
                                <!--Langues : <br/>
                                Langue : <input type="text" name="txt_langue" id="txt_langue" size="30" maxlength="20" /> Observation : <input type="text" name="txt_langue_obs" id="txt_langue_obs" size="30" maxlength="15" />[X]<br/>-->
                                <h3>Langues : </h3>
                                <div name="lang" id="lang" class="coinArrondi"></div><br>
                                <input type="button" value="Ajouter une nouvelle langue" onclick="loaddiv('lang');">
                            </td>
                        </tr>
                        <tr class="cv_cint">
                            <td colspan="2" style="border:solid 1px;">
                                <h3>Centre d'int&eacute;r&ecirc;ts : </h3>
                                <div name="cint" id="cint" class="coinArrondi"></div><br>
                                <input type="button" value="Ajouter un nouveau centre d'int&eacute;r&ecirc;ts" onclick="loaddiv('cint');">
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
            <td style="width:250px;">Astuces, Widget style "feature jobs"</td>
        </tr>
            <?php print FOOTNOTE; ?>
    </table>
    
</body>
</html>
