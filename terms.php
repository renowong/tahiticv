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
        <tr><td colspan="2" class="title"><img src="images/drapeaupolynesie2.jpg" align="left" width=130 height=80></img><h1>Conditions d'Utilisation de TahitiCV</h1></td></tr>
        <tr><td colspan="2" class="mainmenu"><? print($menu); ?></td></tr>
        <tr>
            <td class="content"><div class="static_container">
    <div class="PageContainerWide terms_container">
        <div class="PageContainerWide_heading">
            <h1 class="static_h1 fnt12">Conditions d'Utilisation</h1>
            <h2 class="static_h2 fnt5">Comprendre vos droits et responsabilit�s en tant qu'utilisateur TahitiCV.</h2>
            <div class="clear"></div>
        </div>
        <div id="static_container_body_main">
            <p>Ce document pr�cise les Conditions d'Utilisation (Conditions) sous lesquelles l'utilisateur (ou � vous �) est autoris� utilise les sites et les services de TahitiCV (telles indiqu�es ci-dessous).</p>
<p><b>Ces conditions repr�sentent un accord contraignant entre vous et TahitiCV qui exploite le site Web pour le pays dans lequel vous vivez ou dans lequel se trouve le si�ge de l'entreprise (� TahitiCV �). Vous acceptez ces conditions chaque fois que vous acc�dez au site de TahitiCV ou utilisez les services de TahitiCV. N'utilisez pas les sites ou les services de TahitiCV si vous n'acceptez pas les conditions pr�sent�es ici.</b></p>
<p>Les sites de TahitiCV sont d�finis en tant que tous les sites sous le contr�le de TahitiCV, qu'il s'agisse de contr�le partiel ou autre (en particulier TahitiCV.com et le site web � partir duquel vous avez eu acc�s � ces conditions d'utilisation). Les sites de TahitiCV comprennent de nombreuses fonctions et de nombreux services dont un service en ligne pour publier et rechercher des offres d'emploi (�  Services de TahitiCV �). Les sites de TahitiCV comprennent aussi des communaut�s en ligne (� communaut�s TahitiCV �) con�ues pour permettre une mise en r�seau de valeur et professionnelle entre les utilisateurs (� utilisateurs �) des sites de TahitiCV en se basant sur des exp�riences et des int�r�ts communs. Les sites de TahitiCV permettent aux utilisateurs de d�finir aussi des profils individuels qui peuvent contenir des informations personnelles (� Profils �) et donne aussi la possibilit� de rendre public ce profil ou une partie du profil.</p>
<p>TahitiCV peut modifier ces conditions en mettant en ligne une version actualis�e de cette page web. Vous devez visiter r�guli�rement cette page et lire les conditions car elles sont l�galement contraignantes pour vous.</p>
<p><b>Si des utilisateurs violent ces conditions, TahitiCV peut suspendre pour un temps ou mettre fin � leur acc�s.</b></p>
<p>Vous devez avoir 16 ans ou plus pour pouvoir visiter ou utiliser les sites de TahitiCV. Si vous avez moins de 18 ans ou moins que l'�ge de la majorit� d�finie dans votre juridiction, vous devez utiliser les sites de TahitiCV sous la supervision d'un parent, responsable l�gal ou un autre adulte responsable.</p>
            <h2>1. Utilisation des contenus de TahitiCV</h2>
<p>TahitiCV vous autorise, selon les pr�sentes conditions � acc�der et utiliser les sites de TahitiCV et leur contenu (comme d�fini ci-dessous) pour t�l�charger et imprimer lesdits contenus qui sont disponibles sur ou � partir des sites de TahitiCV et ceci exclusivement pour une utilisation priv�e, non commerciale. Les contenus, par exemple des designs, textes, graphiques, images, vid�os, informations, logos, ic�nes-boutons, logiciels, fichiers audio et autres (rassembl�s sous le terme � contenus de TahitiCV �) sont prot�g�s par copyright, la protection des marques commerciales d�pos�es et d'autres lois. Tous les contenus sont la propri�t� de TahitiCV ou ses affili�s. La compilation (au sens de la collecte, de l'arrangement et de l'assemblage) de tous les contenus sur les sites est la propri�t� exclusive de TahitiCV et est prot�g�e par les lois sur les droits d'auteur, la protection des marques commerciales et d'autres lois. Une utilisation non autoris�e des contenus peut violer ces lois et/ ou les r�glementations et statuts sur les communications et est strictement interdite. Vous devez garder toutes les copies autoris�es que vous avez faites de contenus de TahitiCV, toutes les informations soumises aux droits d'auteur, � la protection des marques commerciales, des marques de service et d'autres informations propri�taires incluses dans les contenus d'origine de TahitiCV.</p>
<p>Tout code cr�� par TahitiCV pour g�n�rer ou afficher des contenus de TahitiCV ainsi que les pages dont sont faits les sites de TahitiCV, sont �galement prot�g�s par copyright et vous ne devez pas copier ou modifier ces codes dans le cadre des r�glementations l�gales.</p>
<p>Vous ne devez utiliser aucune partie des contenus de TahitiCV sur un autre site web ou dans un environnement R�seau (en particulier par le t�l�chargement ou la reproduction de contenus de TahitiCV sur Internet, Intranet ou Extranet ou en incluant des contenus dans une autre base de donn�es ou en faisant une compilation d'informations). A moins que cela soit express�ment indiqu�, rien dans ces conditions ne peut �tre interpr�t� comme une transmission de droits de propri�t� intellectuelle, que ce soit par pr�clusion, tacitement ou d'une autre fa�on. La licence accord�e au titre des pr�sentes est discr�tionnairement r�siliable � tout moment par TahitiCV. </p>
            <h2>2. Utilisation des Services de TahitiCV.</h2>
<p>
Les publications d'offre, la base de donn�es des CV et les autres
fonctions des sites de TahitiCV ne peuvent �tre utilis�es que par des
personnes recherchant un emploi et/ou des informations de carri�re
ainsi que par les employeurs recherchant du personnel. De m�me, les
communaut�s de TahitiCV ne peuvent �tre utilis�es qu'� des fins
professionnelles ou personnelles licites. Votre utilisation des
services de TahitiCV est aussi soumise � tout autre contrat que vous
pourriez avoir avec TahitiCV. En cas de conflit entre les pr�sentes
Conditions et contrat que vous pourriez avoir avec TahitiCV, les termes
de votre contrat pr�vaudront. Le terme � publier �, mentionn� aux
pr�sentes, signifie la soumission, la publication ou l'affichage de
donn�es par vous sur un site de TahitiCV. <br>
<br>
</p>
<p><b>Les utilisateurs s'interdisent de :</b> </p>
<dl>
<dd>(a)Transmettre, publier, distribuer, enregistrer ou d�truire tout
mat�riel, en particulier les contenus de TahitiCV, en violation des lois
ou r�glementations en vigueur concernant la collecte, le traitement ou
le transfert d'informations personnelles, ou en violation des
directives de protection des informations de TahitiCV. </dd>
<br>
<dd>(b) d'effectuer des actions qui repr�senteraient une contrainte
non raisonnable ou disproportionn�e pour l'infrastructure du site web
de
TahitiCV. </dd>
<br>
<dd>(c) d'utiliser un autre logiciel de navigation ou de recherche
sur un site web de TahitiCV que les outils disponibles sur le site, les
navigateurs web g�n�ralement disponibles de la part de tiers ou
d'autres outils autoris�s par TahitiCV; </dd>
<br>
<dd>(d) utiliser des syst�mes d'exploration de donn�es (data mining),
des robots ou tout autre m�thode semblable pour la collecte et
l'exploitation de donn�es; </dd>
<br>
<dd>(e) de mettre en danger ou essayer de mettre en danger la
s�curit� d'un site web de TahitiCV. Cela comprend les tentatives de
contr�ler, scanner
ou tester la vuln�rabilit� d'un syst�me ou r�seau ou de violer des
mesures de s�curit� ou d'authentification sans une autorisation
pr�alable expresse. </dd>
<br>
<dd>(f) contrefaire les protocoles TCP/IP ou toute partie des donn�es
d'en-t�te de mail ou de publication sur un forum; </dd>
<br>
<dd>(g) d'effectuer une ing�nierie invers�e (Reverse Engineering) ou
une d�compilation de pages Web de TahitiCV; </dd>
<br>
<dd>(h) agr�ger, copier ou dupliquer de quelque mani�re que soit le
Contenu ou les informations disponibles sur les sites TahitiCV, en ce
compris
les d'offres d'emploi expir�es, sauf d�ment autoris� par les pr�sentes
Conditions; </dd>
<br>
<dd>(i) r�f�rencer ou cr�er des liens vers tout Contenu ou
information disponible depuis les sites de TahitiCV, sauf express�ment
autoris� par
les pr�sentes Conditions; </dd>
<br>
<dd>(j) Publier des contenus ou des mat�riels qui contiennent des
informations fausses ou induisant en erreur ou qui promeuvent,
soutiennent ou renforcent des activit�s qui sont interdites par ces
conditions. Par exemple la fabrication ou l'achat d'armes ill�gales,
des violations de la vie priv�e, la pr�paration ou l'introduction de
virus informatiques ou de copies pirat�es; </dd>
<br>
<dd>(k) de publier un CV ou de poser sa candidature pour un poste au
nom d'une autre personne; </dd>
<br>
<dd>(l) divulguer � tout agent, agence ou autre tiers, le contact
d'un employeur; </dd>
<br>
<dd>(m) rendre publique plus d'une copie d'un m�me CV � la fois; </dd>
<br>
<dd>(n) partager, avec un tiers, toute identification de connexion
aux sites TahitiCV, un tiers �tant toute personne autre que
l'utilisateur
unique auquel est affect� l'identifiant; </dd>
<br>
<dd>(o) obtenir des donn�es ne vous �tant pas destin�es ou se
connecter � un serveur ou un compte pour lequel vous n'�tes pas
autoris�; </dd>
<br>
<dd>(p) publier ou soumettre sur les sites TahitiCV une information
biographique incompl�te, fausse ou inexactes ou qui appartenant � un
tiers; </dd>
<br>
<dd>(q) de publier un contenu qui contient des pages � acc�s
restreint, prot�g�es par mot de passe ou des pages web ou images
masqu�es; </dd>
<br>
<dd>(r) obtenir d'autres utilisateurs des mots de passe ou des
donn�es
personnelles d'identification; </dd>
<br>
<dd>(s) supprimer ou modifier tout �l�ment publi� par une autre
personne ou entit�; </dd>
<br>
<dd>(t) harceler, inciter au harc�lement ou pr�ner le harc�lement �
l'encontre d'un groupe, d'une entreprise ou d'une personne; </dd>
<br>
<dd>(u) envoyer des courriers, mails ou fax ou effectuer des appels
t�l�phonique non sollicit�s, notamment pour promouvoir des produits ou
services, � tout utilisateur ou tenter de contacter ces derniers sans
avoir obtenu au pr�alable leur accord; </dd>
<br>
<dd>(v) tenter d'interf�rer avec le service fourni � tout
utilisateur, h�bergeur ou r�seau, au moyen notamment d'un
t�l�chargement de virus
informatique, d'une surcharge, de "flooding", "spamming", "mailbombing"
ou "crashing"; </dd>
<br>
<dd>(w) r�pandre ou encourager la copie ill�gale ou non autoris�e du
travail d'un tiers prot�g� par des droits d'auteur, tels que le
transfert ou la mise � disposition de logiciels informatiques pirat�s
ou leurs liens, fournir ou mettre � disposition des renseignements
permettant de contourner des dispositifs manufacturiers couvert par des
droits d'auteurs, ou fournir ou mettre � disposition de la musique,
vid�o ou autres m�dias et liens vers des sites de piratage; </dd>
<br>
<dd>(x) utiliser les Services TahitiCV � des fins illicites ou pour
les besoins d'une activit� ill�gale, publier ou soumettre tout contenu,
CV
ou d'offre d'emploi diffamatoire, calomnieuse, implicitement ou
explicitement offensante, vulgaire, obsc�ne, mena�ante, abusive,
haineuse, raciste, discriminatrice, � tendance mena�ante ou pouvant
troubler, g�ner, provoquer de l'anxi�t�, harceler tout individu ainsi
que d' incorporer des liens vers du contenu pornographique, ind�cent ou
� connotation sexuelle; ou </dd>
<br>
<dd>(y) mettre en ligne un CV autre qu'un r�el CV et qui aurait pour
but de promouvoir des produits ou services. </dd>
</dl>
<p>
Des violations de la s�curit� du syst�me ou du r�seau peuvent conduire
� des poursuites civiles et p�nales. TahitiCV recherchera les occasions
dans lesquelles de telles violations pourraient avoir eu lieu et peut
faire appel aux autorit�s judiciaires pour poursuivre des utilisateurs
qui ont particip�s � de telles violations et coop�rer avec ces
autorit�s.
</p>
            <h2>3. Conditions suppl�mentaires applicables aux employeurs.</h2>
<p>Il est de votre responsabilit� de conserver la confidentialit� de
votre compte Employeur, du profil et des mots de passe. Il vous est
interdit de partager m�me temporairement, vos identifiant, mot de passe
et autre param�tre d'acc�s � votre compte � des tiers. Vous �tes
responsable pour l'utilisation de vos enregistrements et mots de passe
sur les sites de TahitiCV, que cette utilisation ait �t� autoris�e ou
pas par vous. A ce titre, vous vous obligez � informer TahitiCV, sans
d�lai, de toutes utilisations non autoris�es de son compte et /ou
identifiants.</p>
<p>Les employeurs sont seuls responsables de leurs publications sur les
sites TahitiCV. TahitiCV ne pourra en aucun cas �tre assimil� � un
employeur ou � un mandataire de ce dernier eu �gard � votre utilisation
du site TahitiCV et/ou des d�cisions d'embauche, pour quelques raisons
que ce soient, de l'entit� publiant des offres sur le site de TahitiCV. <br>
</p>
<p>Vous comprenez et reconnaissez que si vous mettez fin � votre compte
d'employer, toutes vos informations de compte de TahitiCV, y compris les
CV enregistr�s, les contacts de r�seau et les listes d'emails seront
effac�s de la base de donn�es de TahitiCV. Le d�lai de traitement de la
demande de suppression peut n�anmoins laisser subsister des donn�es
quelques temps. </p>
<p>Afin de prot�ger les utilisateurs TahitiCV de campagnes publicitaires
ou
de sollicitations ind�sirables, TahitiCV se r�serve le droit de limiter,
� sa seule discr�tion, le nombre de mails susceptibles d'�tre envoy�s
par les employeurs, et ce peut envoyer aux utilisateurs. </p>
<p>Des profils de candidats provenant de contenus utilisateur peuvent
aussi �tre rendus accessibles sur les sites. TahitiCV ne garantit en
aucun cas l'exactitude ou la validit� de tels profils ou de leur
pertinence pour une �valuation par les employeurs. Les profils d�riv�s
peuvent diff�rer significativement du contenu original de l'utilisateur.</p>
<b>Publications d'Offres </b>
<br>
<br>
<p><b>Une Offre ne saurait en aucun cas contenir :</b>
</p>
<dl>
<dd>(a) de liens hypertexte, autres que ceux express�ment autoris�s
par
TahitiCV; </dd>
<br>
<dd>(b) des mots cl�s � cach�s �, pouvant induire en erreur ou
illisible,
ou des mots cl� r�p�titifs ou sans rapport avec l'offre d'emploi
publi�e;</dd>
<br>
<dd>(c) les noms, logos ou marques d'entreprises autres que les
v�tres ou
express�ment autoris�es par TahitiCV;</dd>
<br>
<dd>(d) les noms d'�cole ou institutions, de villes, de d�partements,
de
r�gions ou pays n'ayant aucun lien avec l'offre;</dd>
<br>
<dd>(e) plus d'une offre ou description, plus d'une localit�, ou plus
d'une
cat�gorie, � moins que le produit ne le permette;</dd>
<br>
<dd>(f) des donn�s incorrectes, fausses ou erron�es; et</dd>
<br>
<dd>(g) des �l�ments ou des liens vers des �l�ments � connotation
sexuelle,
violente ou situation d'abus ou qui sollicite des donn�es personnelles
de personnes de moins de 16 ans.</dd>
<br>
<p><b>Il vous est interdit d'utiliser les services TahitiCV en vue de :</b>
</p>
<dl>
<dd>(a) publier des offres non conforme aux lois et r�glements en
vigueur
dans le pays de publication de l'offre ou en tout autre pays, si
applicable, en mati�re, notamment, de droit du travail, d'�galit� des
chances, et des exigences en fonction des qualifications par rapport �
l'emploi, la protection des informations, l'acc�s et l'utilisation des
donn�es personnelles ainsi que la propri�t� intellectuelle; </dd>
<br>
<dd>(b) publier des offres exigeant une nationalit� particuli�re ou
une
r�sidence permanente dans un pays comme condition d'emploi, � moins
qu'une telle condition soit requise par la loi ou r�glementations en
vigueur;</dd>
<br>
<dd>(c) publier des offres qui imposerait des contr�les ou crit�res
sp�cifiques pour l'acc�s � l'emploi sans que ces contr�les ou crit�res
soient juridiquement obligatoires;</dd>
<br>
<dd>(d) publier des offres et autres publicit�s pour le compte de
concurrents de TahitiCV ou publier des offres ou autre contenu qui
comportent des liens vers des sites concurrents de TahitiCV;</dd>
<br>
<dd>(e) vendre, valoriser ou faire de la publicit� de produits ou
services;</dd>
<br>
<dd>(f) publier des offres portant sur des franchises, syst�me
pyramidal,
adh�sion � un club, accords de distribution, de concession ou d'agence
commerciale, ou � la vente � niveaux multiples (� multi-level Marketing
�);</dd>
<br>
<dd>(g) publier des offres portant sur une opportunit� d'affaires
qui
requiert un paiement d'avance ou p�riodique ou n�cessite le recrutement
d'autres membres, sous-distributeurs ou sous-agents;</dd>
<br>
<dd>(h) publier offres portant sur des opportunit�s d'affaire
r�mun�r�es
uniquement par commission � moins que l'offre pr�cise clairement cet
�tat de fait et d�crive pr�cis�ment le produit ou service � vendre;</dd>
<br>
<dd>(i) promouvoir des opportunit�s qui ne sont pas des offre
d'emplois
s�rieuses;</dd>
<br>
<dd>(j) publier des offres visant la recherche de mod�les,
d'acteurs,
d'artistes ou autre talents ou encore des postes d'agent ou de
prospection de tels personnel;</dd>
<br>
<dd>(k) passer des annonces visant des services sexuels ou
recherchant du
personnel pour des activit�s de nature sexuelle;</dd>
<br>
<dd>(l) solliciter ou promouvoir le commerce du corps humain ou
d'organes,
dont notamment des services de f�condation assist�e, tels que le don
d'ovules ou de � m�re porteuse �.</dd>
<br>
<dd>(m) promouvoir un parti, un programme, une position ou un sujet
politique;</dd>
<br>
<dd>(n) promouvoir une religion;</dd>
<br>
<dd>(o) publier des offres pour des postes bas�s dans des pays
faisant
l'objet d'une sanction �conomique de la part du gouvernement des
Etats-Unis; et</dd>
<br>
<dd>(p) sauf si permis par la loi, publier des offres obligeant le
candidat
� fournir des donn�es relatives � (i) ses origines ethniques ou
raciales, (ii) ses convictions politiques,(iii) croyances
philosophiques ou religieuses,(iv) son appartenance � un syndicat, (v)
sa sant� physique ou mentale, (vi) se pr�f�rences sexuelles, (vii) son
pass� judiciaire, ou (vii) son �ge.</dd>
</dl>
<p><b>TahitiCV se r�serve, � sa seule discr�tion, le droit de
supprimer
toute offre ou contenu publi� sur son site qui serait non conforme aux
Conditions pr�cit�es ou dont le contenu pourrait porter atteinte �
TahitiCV ou aux utilisateurs de TahitiCV. </b></p>
<p><b>Si, � tout moment, Vous portez atteinte par votre
utilisation �
TahitiCV ou autrement trompez TahitiCV quant � la nature de vos
activit�s, TahitiCV aura le droit de suspendre, voire r�silier, les
Services souscrits.</b></p>
<p><b>Base de Donn�es CV </b> <br>
<br>
<b>Utilisation par les Employeurs des bases de donn�es CV </b><br>
<br>
Vous utiliserez la base de donn�es CV de TahitiCV conform�ment aux
pr�sentes Conditions et autre condition contractuelle souscrite aupr�s
de TahitiCV. Vous utiliserez la base de donn�es CV de TahitiCV dans le
respect des lois et r�glements relatives � la confidentialit� et la
protection de donn�es personnelles. Vous vous interdisez de divulguer
les donn�es de la base CV de TahitiCV � des tiers, � moins que ce tiers
ne soit une agence de recrutement autoris�e, une agence de
communication ou autres interm�diaires d�ment autoris� par TahitiCV et
utilisant la base CV dans un but exclusif de recrutement.</p>
<p>Vous prendrez des mesures physiques, techniques et
administratives
appropri�es pour prot�ger les informations que vous avez obtenues de la
base de donn�es de CV de TahitiCV, contre la perte, une utilisation
malveillante, un acc�s non autoris�, leur publication, modification ou
destruction. Vous vous est interdit de partager les identifiants et
mots de passe des licences d'acc�s � la CVth�que avec des tiers.</p>
<p><b>La base de donn�es CV de TahitiCV ne pourra en aucun cas
�tre
utilis�e : </b></p>
<dl>
<dd>(a) dans tout autre but que celui d'un employeur recherchant du
personnel ou tout particuli�rement dans le but de promouvoir des
offres, produits ou services � tout titulaire de CV;</dd>
<br>
<dd>(b) dans le but d'effectuer des appels ou envoyer des fax,
courriers,
courriels ou newsletters non sollicit�s � des titulaires de CV ou
encore de contacter toute personne � moins que ce contact ait fait
l'objet d'une acceptation expresse (si une telle acceptation n'est pas
requise, la personne contact�e ne devra pas vous avoir avis� de son
refus d'�tre sollicit�es); ou</dd>
<br>
<dd>(c) de rechercher ou contacter des candidats ou titulaires de
CV pour
les besoins de salons de recrutement ou des opportunit�s interdites par
ailleurs dans le pr�sent article 3.</dd>
</dl>
<br>
<b>Afin d'assurer une utilisation s�curis�e et efficace pour tous les
utilisateurs, TahitiCV se r�serve le droit de limiter la quantit� de
donn�es (y compris les vues de CV) accessibles par l'utilisateur. Ces
limitations peuvent �tre modifi�es � tout moment, � la seule discr�tion
de TahitiCV.</b>
            <h2>4. Conditions additionnelles applicable aux Candidats. </h2>
<p>
Lorsque vous vous inscrivez sur le Site, il vous sera demand� de
fournir � TahitiCV certaines informations, incluant, sans que cela soit
limitatif, une adresse e-mail valide (vos "Informations"). </p>
<p>Tout profil que vous soumettez doit �tre exact et vous d�crire en
tant
qu'individu. Les profils n�cessitent de remplir des champs standard.
Vous pouvez ne pas inclure dans ces profils des num�ros de t�l�phone,
adresses postales, adresses email ou d'autres information permettant de
vous contacter autre que votre nom de famille et vos URL. </p>
<p>Vous �tes seul responsable du format, du contenu et de l'exactitude
de
tout CV ou �l�ment mis en ligne sur les sites TahitiCV.</p>
<p>TahitiCV se r�serve le droit de proposer des services et produits
provenant de tiers suivant les pr�f�rences que vous aurez indiqu�es
lors de votre inscription ou ult�rieurement et si vous avez accept� de
recevoir les offres provenant de TahitiCV ou de tiers. Vous �tes invit�s
� vous r�f�rer � la Notice Protection des donn�es de TahitiCV pour de
plus amples renseignements sur le traitement des donn�es personnelles.</p>
<p>Vous ne d�tenez aucun droit de propri�t� sur votre compte. Si vous
r�voquez votre compte ou si votre compte TahitiCV est annul�, toutes vos
informations de compte, y compris celles du profil, des CV, des
lettres, emplois enregistr�s et questionnaires pourront �tre supprim�es
de la base de donn�es de TahitiCV et enlev�es du domaine public des
sites de TahitiCV. Des donn�es peuvent toutefois subsister pour une
certaine p�riode en raison du d�lai de traitement n�cessaire � leur
suppression. Il est pr�cis� que des tiers peuvent conserver des copies
sauvegard�es de vos donn�es personnelles. </p>
<p>TahitiCV se r�serve le droit de supprimer votre compte Client et
toutes
vos Donn�es apr�s une p�riode significative d'inactivit�.
</p>
            <h2>5. Contenu Utilisateur et Soumissions. </h2>
<p>
Toutes les informations, donn�es, textes, logiciels, musiques, sons,
photos, graphiques, vid�os, informations, nouvelles et autres mat�riels
que vous avez soumis, publi�s ou repr�sent�s (� contenu utilisateur �)
sur les sites de TahitiCV sont sous votre seule responsabilit�. TahitiCV
ne prend pas de responsabilit� sur la propri�t� du contenu utilisateur
ou son contr�le. Vous, ou tiers affili�, restez les d�tenteurs de tous
les brevets, marques commerciales et droits d'auteurs des contenus
utilisateur que vous publiez sur ou par l'interm�diaire des sites de
TahitiCV. Il est de votre responsabilit� de prot�ger ces droits. Par la
soumission, la publication ou la repr�sentation de contenu utilisateur
sur ou par l'interm�diaire de TahitiCV, vous accordez � TahitiCV un droit
mondial non exclusif et gratuit pour reproduire, adapter, r�pandre,
publier ces contenus utilisateur. Par la soumission, la publication ou
la repr�sentation d'un contenu utilisateur auquel le public peut avoir
acc�s, vous accordez � TahitiCV un droit mondial non exclusif et gratuit
pour reproduire, adapter, r�pandre, publier ces contenus utilisateur
dans des buts de promouvoir TahitiCV et ses services. TahitiCV mettra fin
� son utilisation du contenu utilisateur apr�s une p�riode raisonnable
suivant la suppression dudit contenu par utilisateur du site TahitiCV.
TahitiCV se r�serve, � sa seule discr�tion, le droit de refuser,
d'accepter, de publier, d'afficher ou de transmettre du contenu
utilisateur.</p>
<p>En soumettant du Contenu dans une partie publique du site TahitiCV,
vous
accordez � tout utilisateur le droit d'acc�der, d'afficher, de
consulter, de conserver et de reproduire tel contenu � des fins
personnelles. Sous r�serve de ce qui pr�c�de, le propri�taire de ce
Contenu conserve tous les droits qui peuvent exister sur le contenu
publi�. TahitiCV se r�serve le droit de r�viser et/ou retirer tout
contenu utilisateur qui, de son avis, enfreint les pr�sentes conditions
d'utilisation, enfreint les lois et r�glements en vigueur, est abusif,
d�rangeant, vulgaire, illicite ou porte atteinte aux droits de tiers,
pr�judicie ou menace la s�curit� des autres utilisateurs de TahitiCV.
TahitiCV se r�serve, en cas de non respect des pr�sentes, le droit
d'exclure des utilisateurs, de supprimer leur droit d'acc�s aux sites
de TahitiCV et leur utilisation des services. TahitiCV se r�serve le
droit de prendre toute mesure qu'elle jugera utile, si le contenu
utilisateur d'une mani�re ou d'une autre pourrait constituer un
fondement � des poursuites, pourrait porter atteinte � la marque ou �
l'image de TahitiCV, pourrait lui faire perdre des utilisateurs ou les
services de ses fournisseurs de services Internet ou autres
fournisseurs. </p>
<p>TahitiCV ne garantit pas la v�racit�, l'exactitude ou la fiabilit� du
contenu utilisateur ou messages post�s par les utilisateurs. TahitiCV
n'endosse pas les opinions �ventuellement �mises par ces utilisateurs.
L'utilisateur reconnait que le cr�dit � accorder au contenu affich� par
d'autres utilisateurs est de sa seule responsabilit�. </p>
<p>Il est interdit d'incorporer dans le contenu soumis aux forums de
TahitiCV, des donn�es qui peuvent �tre interpr�t�es comme une
sollicitation directe, une annonce ou un recrutement pour un poste
disponible ciblant les personnes recherchant un emploi soit � temps
plein ou partiel. Afin de prot�ger notre communaut� d'utilisateurs des
publicit�s ou sollicitations intempestives, TahitiCV se r�serve le droit
de limiter la quantit� de mails ou autres messages qu'un utilisateur
peut envoyer aux utilisateurs. </p>
<p>Du contenu extrait des profils candidats peuvent aussi �tre rendus
disponibles sur les sites de TahitiCV. TahitiCV ne garantit aucunement la
valeur ou l'exactitude de tels extraits ou de leur pertinence pour une
�valuation par les employeurs. Ces profils d�riv�s peuvent varier du
Contenu original de l'utilisateur. </p>
<p>Nous appr�cions le retour de nos clients et vos commentaires
concernant
nos services et les Sites TahitiCV sont les bienvenus. Cependant nous
vous informons que notre politique ne nous permet pas d'accepter ou de
prendre en consid�ration des id�es cr�atives, suggestions, inventions
ou contenus autres que ceux que nous demandons express�ment. Bien que
nous accordions de l'importance � vos retours sur nos services, nous
vous remercions d'�tre pr�cis lors de vos commentaires sur ceux-ci, et
de ne pas soumettre d'id�es cr�atives, inventions, suggestions ou
contenus. Si, en d�pit de notre demande, vous nous soumettez des
suggestions cr�atives, dessins, concepts, inventions, ou autres
informations (les � soumissions �), ces soumissions deviennent la
propri�t� de TahitiCV, ou en cas d'impossibilit� pour TahitiCV de d�tenir
exclusivement les droit sur la soumission, vous accordez � TahitiCV, en
adh�rant aux pr�sentes, une licence gratuite, irr�vocable d'utiliser la
soumission sans restriction quel qu'en soit l'usage par TahitiCV, qu'il
soit commercial ou autre, et ce sans qu'aucune compensation puisse �tre
r�clam�e par le client ou autre tiers. Aucune des soumissions ne pourra
faire l'objet d'une obligation de confidentialit� de notre part et nous
ne serons pas responsables de l'utilisation ou la divulgation qui
pourrait �tre faite de la soumission.
</p>
            <h2>6. Notifications relatives aux Droits d'auteur ou des marques.</h2>
<p>Si des �l�ments publi�s sur l'un quelconque des sites de TahitiCV
porte atteinte � des droits d'auteur ou autre droits prot�g�s, ces
faits doivent �tre port� � l'attention du juriste de TahitiCV indiqu� ci-dessous, lequel a �t� d�sign�
par notre soci�t� pour recevoir toute plainte relative aux droits de la
propri�t� intellectuelle ou autre non-conformit� par rapport aux
pr�sentes Conditions.
</p>
<table border="1" cellpadding="3" cellspacing="0">
<tbody>
<tr>
<td valign="top">Par courrier:</td>
<td>Michel Ly Kui<br>
Juriste<br>
TahitiCV.com<br>
BP .... <br>
Tahiti<br>
Polyn�sie Fran�aise<br>
</td>
</tr>
</tbody>
</table>
<p>
Besoin d'aide pour un probl�me relatif aux candidats --> <a
href="contact.php" title="Contactez-nous">Contactez-nous</a>.<br>
</p>
<h2>7. R�siliation pour infraction aux droits de la propri�t�
intellectuelle d'autrui. </h2>
<p>
TahitiCV respecte les droits de propri�t� intellectuelle des tiers et
nous demandons � nos utilisateurs, titulaires de comptes et partenaires
de contenu d'en faire autant. La reproduction, copie, distribution,
modification, repr�sentation ou diffusion au public non autoris�es
d''uvres prot�g�es par le droit d'auteur, constitue une violation des
droits du titulaire. Vous consentez � ne pas utiliser ce Site ou tout
Site TahitiCV en vue de violer les droits de propri�t� intellectuelle
d'autrui de quelque mani�re que ce soit. Nous supprimerons les comptes
de tout titulaire de compte et bloquerons l'acc�s � notre Site et/ou
aux autres Sites TahitiCV � tout utilisateur qui viole de mani�re
r�p�t�e le droit d'auteur ou autres droits de propri�t� intellectuelle
d'autrui. Nous nous r�servons le droit d'entreprendre ces actions �
tout moment, � notre seule discr�tion, avec ou sans pr�avis, et sans
responsabilit� de notre part � l'�gard du titulaire de compte d�sabonn�
ou � l'�gard de l'utilisateur dont l'acc�s est bloqu�. </p>
<p>Nonobstant ce qui pr�c�de, si de bonne foi, vous pensez que la
suppression de compte a �t� faite sur des bases injustifi�es, nous vous
prions de contacter le Directeur des Conformit�s et de Pr�vention des
Fraudes comme indiqu� ci-dessus. </p>
            <h2>
8. La Responsabilit� de TahitiCV</h2>
<p>
Les sites TahitiCV sont uniquement des lieux d'�changes permettant (i)
aux employeurs d'afficher des offres d'emploi et rechercher des
candidats et (ii) aux candidats de publier leurs CV et profiles et
rechercher un emploi. TahitiCV ne proc�de par au filtrage ou � la
censure des offres. TahitiCV n'est pas partie � la relation entre les
employeurs et les candidats. En cons�quence, TahitiCV n'exerce aucun
contr�le sur la qualit�, la s�curit� ou la l�galit� des emplois ou CV
affich�s, la v�racit� ou la pr�cision des rubriques, la capacit� des
employeurs � offrir des emplois aux candidats ou l'aptitude des
candidats � pourvoir aux positions propos�es. Bien que TahitiCV se
r�serve le droit, � tout moment et � sa seule discr�tion de retirer
tout contenu utilisateur, offre d'emploi, CV ou autre �l�ment publi�
sur ses sites, TahitiCV n'assume sur ce point aucune obligation, sous
r�serve toutefois des obligations l�gales imp�ratives, et rejette toute
responsabilit� pour ne pas avoir supprim� quelques �l�ment publi� sur
son site. </p>
<p>Les communaut�s de TahitiCV offrent un point de rencontre
permettant la mise en r�seau de personne � des fins professionnelles
et/ou priv�es. TahitiCV ne surveille et ne censure aucun profil ou
contenu utilisateur sur les pages web de TahitiCV. TahitiCV ne prend pas
part � la communication entre les utilisateurs. Il en r�sulte que
TahitiCV n'a pas de contr�le sur l'exactitude, la fiabilit�, l'�tat de
compl�tude ou l'actualit� des profils et des contenus utilisateur
post�s sur ses pages web. TahitiCV n'est nullement responsable de ces
profils et contenus utilisateur. </p>
<p>Nous attirons votre attention sur la
pr�sence de risques (pouvant aller jusqu'au risque de pr�judice
corporel) qui pourrait r�sulter de contact avec des �trangers, des
mineurs ou des gens qui utilisent de fausses identit�s. Vous assumez
tous les risques qui r�sultent des relations avec d'autres utilisateurs
avec lesquels vous entrez en contact sur les sites de TahitiCV. Des
informations sur d'autres personnes peuvent �tre offensantes,
blessantes ou inexactes. Dans certains cas, vous pouvez �tre pr�sent�
de fa�on erron�e ou mensong�re. Nous nous attendons � ce que vous soyez
prudent et raisonnable quand vous utilisez les sites de TahitiCV.
</p>
<p>Comme l'identification d'utilisateurs est difficile sur Internet,
TahitiCV ne saurait garantir que chaque utilisateur correspond � ce
qu'il pr�tend �tre. De la m�me mani�re que nous ne sommes, ni ne
pouvons �tre, partie aux �changes entre des utilisateurs, nous ne
contr�lons pas le comportement des participants sur les sites TahitiCV.
En cas de litige avec un ou plusieurs utilisateurs, vous d�chargez
express�ment TahitiCV (nos agents et employ�s) de toute demande,
r�clamation et dommages (dommages cons�cutifs effectifs, directs ou
indirects) de tout type et de toute nature, connu ou inconnu, dommages
soup�onn�s ou insoup�onn�s, dommages r�v�l�s et non r�v�l�s qui
r�sulteraient du comportement ou de la tromperie d'un utilisateur. </p>
<p>Les sites et les contenus de TahitiCV peuvent inclure des
inexactitudes et
des fautes de frappe. TahitiCV ne donne aucune garantie concernant
l'exactitude, la fiabilit�, l'�tat de compl�tude ou d'actualit� des
sites ou de leur contenu. L'utilisation des sites et des contenus de
TahitiCV se fait � vos propres risques et p�rils. Des changements sont
r�guli�rement effectu�s sur les sites de TahitiCV. TahitiCV ne peut donne
aucune garantie de r�sultat quant � l'utilisation de tout ou partie de
ses sites. Aucun conseil ou information, oral ou �crit, re�u par un
utilisateur de TahitiCV ou par un des sites de TahitiCV ne cr�e pour
cette derni�re une obligation autre que celles express�ment list�es aux
pr�sentes. </p>
<p>Si vous r�sidez en Californie, vous renoncez � la
'California Civil Code Section 1542', qui pr�cise : � A general release
does not extend to claims which the creditor does not know or suspect
to exist in his or her favor at the time of executing the release,
which if known by him or her must have materially affected his or her
settlement with the debtor. � </p>
<p>Si vous r�sidez en Pologne, vous
reconnaissez que sur la base de l'article 558 ss du Code Civil
polonais, la garantie de TahitiCV, pour des d�fauts intrins�ques ou
l�gaux aff�rents � des produits offerts, est exclue. </p>
<p>TahitiCV vous
conseille de conserver une copie de s�curit� de vos contenus
utilisateur. TahitiCV rejette toute responsabilit�, dans la mesure o�
c'est permis pas la loi, pour l'effacement, la perte ou la modification
non autoris�e de tout contenu utilisateur. </p>
<p>TahitiCV ne donne aucune
garantie concernant la nature ou la qualit� des produits ou services de
tiers, m�me achet�s via un site web de TahitiCV. Les obligations,
garanties, assurances, conventionnelles ou l�gales, sont � la charge
exclusive du fournisseur desdits produits ou services suivants les
conditions n�goci�es entre l'acqu�reur et le fournisseur. </p>
<p>Si vous
constatez quelque �l�ment sur le site qui pourrait contredire ce qui
pr�c�de, nous vous prions de vous mettre en contact avec le responsable
d�sign� en article 6 ci-dessus.
</p>
<p>La d�cision de supprimer ou amender le contenu ainsi d�nonc� revient
exclusivement � TahitiCV, laquelle ne pourra en aucun cas �tre tenu de
le faire sans que cela puisse engager d'une mani�re ou d'une autre sa
responsabilit�.
</p>
            <h2>9. Exclusion de garantie</h2>
<p>
SOUS RESERVE DE LOIS D'ORDRE PUBLIC CONTRAIRES, TahitiCV N'EST AUCUNEMENT RESPONSABLE DES DYSFONCTIONNEMENTS DE SES SITES, DE SES SERVICES, D'EVENTUELS VIRUS OU AUTRE MECANISME DOMMAGEABLE. TahitiCV NE SAURAIT �TRE TENUE POUR RESPONSABLE DES COUTS LIES A D'EVENTUELS REMPLACEMENTS D'EQUIPEMENT, MESURES DE REMISE EN ETAT, RESTAURATIONS DE DONNEES OU AUTRES EVENEMENT LIE A VOTRE UTILISATION DES SITES TahitiCV OU DE LEUR CONTENU. LES SITES ET LEUR CONTENU SONT FOURNIS SANS AUCUNE GARANTIE D'AUCUNE SORTE QUE CE SOIT AU TITRE DES POSSIBILITES DE COMMERCIALISATION, LA PERTINENCE PAR RAPPORT AU BUT RECHERCHE OU ENCORE DES EVENTUELLES RESTRICTION D'UTILISATION. TahitiCV NE DONNE AUCUNE GARANTIE CONCERNANT L'EXACTITUDE, LA FIABILITE, L'ETAT DE COMPLETUDE OU D'ACTUALITE DES CONTENUS, SERVICES, LOGICIELS, TEXTES, GRAPHIQUES ET LIENS.</p>
<h2>10. Exclusion de garantie pour dommages cons�cutifs </h2>
<p>
SOUS RESERVE DE DISPOSITIONS DE LOIS D'ORDRE PUBLIC CONTRAIRES, TahitiCV, SES FOURNISSEURS OU TOUT TIERS MENTIONNE SUR QUELQUE SITE DE TahitiCV NE SAURAIENT EN AUCUN CAS VOIR SA RESPONSABILITE ENGAGEE POUR TOUT DOMMAGE, QUEL QU'IL SOIT (EN CE COMPRIS NOTAMMENT LES DOMMAGES INCIDENTS, CONSECUTIFS, PERTES D'UNE CHANCE, PERTES DE PROFIT OU DE DONNEES OU ENCORE INTERRUPTION DE BUSINESS) RESULTANT DE L'UTILISATION OU DE L'INCAPACITE D'UTILISER TOUT OU PERTIE DU SITE TahitiCV ET SES CONTENUS, QUE L'ON SE BASE POUR UNE RECLAMATION SUR UNE GARANTIE, UN CONTRAT, UNE MANIPULATION NON AUTORISEE OU UNE AUTRE RAISON LEGALE ET QUE TahitiCV SOIT OU NON INFORME DE TELS DOMMAGES.</p>
<h2>11. Limitation de responsabilit�</h2><p>
SI LA RESPONSABILITE DE TahitiCV DEVAIT TOUTEFOIS �TRE ENGAGEE, SA RESPONSABILITE AU  TITRE DES DOMMAGES SUBIS DU FAIT DE L'UTILISATION DES SITES DE TahitiCV OU DE LEUR CONTENU, SERA, SOUS RESERVE D'UNE LOI CONTRAIRE, LIMITEE A 100', QUE SA RESPONSABILITE SOIT CONTRACTUELLE, DELICTUELLE OU AUTRE. </p>
<h2>12. Liens vers d'autres sites </h2><p>
Les sites de TahitiCV comprennent des liens vers des sites tiers. Ces liens ne sont fournis que pour vous aider et TahitiCV n'en cautionne pas les contenus et ne saurait �tre associ�e d'une quelconque mani�re � ces sites. TahitiCV ne saurait �tre tenue pour responsable desdits sites et ne garantit d�s lors ni leur contenu, ni leur fiabilit�. Si vous acc�dez � ces sites tiers, vous le faites � vos risques et p�rils. </p>
<h2>13. Pas de revente ou d'autre utilisation commerciale non autoris�e </h2><p>
Vous vous engagez � ne pas vendre ou c�der vos droits et obligations dans le cadre des pr�sentes conditions. Vous vous engagez �galement de ne faire aucune utilisation commerciale non autoris�e de tout ou partie des sites TahitiCV. </p>
<h2>14. Indemnisation</h2><p>
Vous garantissez TahitiCV, ses dirigeants, ses administrateurs, employ�s et agents contre toute r�clamation, action en justice ou demande incluant sans restriction, les frais juridiques et comptables r�sultant de (i) tout contenu que vous avez fourni sur un Site TahitiCV, (ii) tout usage que vous avez fait du Contenu du Site ou (iii) votre manquement aux pr�sentes Conditions d'Utilisation. TahitiCV vous notifiera promptement toute r�clamation, plainte ou proc�dure. </p>

            <h2>15. G�n�ralit�s </h2>
<p>
TahitiCV ne garantit pas qu'il soit possible d'acc�der ou de consulter le Site en dehors de la Polyn�sie Fran�aise. L'acc�s au Contenu du Site peut ne pas �tre licite pour certaines personnes ou dans certains pays. Si vous acc�dez aux Sites de TahitiCV, c'est sous votre seule responsabilit�. Vous �tes responsables du respect des lois du lieu o� vous vous situez. Des logiciels qui sont t�l�charg�s � partir des sites de TahitiCV sont soumis aux r�glementations de contr�le des exportations des Etats Unis d'Am�rique. Ces logiciels ne doivent pas �tre t�l�charg�s export�s ou r�export�s d'une autre fa�on vers un citoyen ou un habitant de (i) Cuba, Irak, Lybie, Cor�e du Nord, Iran, Syrie ou autre Etat qui est soumis � un embargo commercial des Etats-Unis. Ils ne peuvent non plus �tre transmis � (ii) une personne ou une entreprise se trouvant sur la liste "Specially Designated Nationals" �tablie par le d�partement du tr�sor des Etats-Unis (� US Treasury Department � ou la liste "Table of Deny Orders" du d�partement du commerce des Etats-Unis (� U.S. Commerce Department �). </p>
<p>
Pour le t�l�chargement ou l'utilisation de tels logiciels, vous garantissez que vous ne vous trouvez pas dans un tel pays, que vous n'�tes pas soumis au contr�le d'un tel pays, que vous n'�tes pas citoyen ou habitant d'un tel pays ou une personne ou une entreprise se trouvant sur une telle liste. </p>
<p>
Ces conditions sont soumises au droit fran�ais. Toute r�clamation concernant les pr�sentes conditions d'utilisation sera soumise au tribunal comp�tent de Papeete. Si une clause des pr�sentes est d�clar�e nulle par une juridiction comp�tente, cette nullit� ne pourra pas affecter la validit� des autres clauses des Conditions d'Utilisation qui demeureront en vigueur. Aucune renonciation � une clause des Conditions d'Utilisation ne constituera une renonciation future ou permanente � cette clause ou � toute autre clause. De plus, si TahitiCV n'applique par une des clauses de ces Conditions, cela ne sera pas consid�r� comme un renoncement � cette stipulation ou n'influencera pas autrement la capacit� de TahitiCV d'appliquer cette clause dans le futur. Sauf express�ment pr�vu par un contrat d�ment form� entre vous et TahitiCV ou conditions d'utilisation sp�cifiques � certaines parties du Site de TahitiCV, y compris dans la Notice Protection des Donn�es (disponible sur http://mon.TahitiCV.fr/privacy/), les pr�sentes conditions repr�sentent l'int�gralit� de l'accord entre vous et TahitiCV concernant l'utilisation du Site. Aucune modification des pr�sentes Conditions d'Utilisation n'est possible sauf en cas d'affichage r�vis� de ces pages.
</p>
            <h2>16. Conditions compl�mentaires d'utilisation </h2>
<p>
Certaines parties/pages des Sites TahitiCV sont soumis � des conditions d'utilisation sp�cifiques ou suppl�mentaires. En utilisant ces parties ou toute partie de celles-ci, vous acceptez d'�tre li� par lesdites conditions compl�mentaires d'utilisation. </p>
<p>
�GfK GeoMarketing Informations g�ographiques fournies par GfK GeoMarketing GfK. GeoMarketing fournit les informations g�ographiques des codes postaux de l'Europe de l'Ouest et du Canada pour cr�er un moteur de recherche permettant de localiser et de visualiser des offres sur une carte. Les cartes et les informations g�ographiques sont prot�g�es par un copyright. Elles ne peuvent �tre utilis�es que par l'application Internet et les fonctionnalit�s fournies par TahitiCV. Toute autre utilisation (ou diffusion) des informations g�ographiques et des cartes n'est pas autoris�e.</p>
<p>
�Maponics, LLC 2008 Informations g�ographiques fournies par Maponics, LLC. Maponics fournit les informations g�ographiques et les cates pour les codes postaux des Etats Unis. Ces informations sont prot�g�es par copyright. Elles ne peuvent �tre utilis�es que dans le cadre de l'application Internet et des fonctionnalit�s fournies par TahitiCV. Toute autre utilisation (ou diffusion) des coordonn�es g�ographiques et des cartes n'est pas autoris�e.
</p>
            <h2>17. Dur�e et r�siliation </h2>
<p>
Les pr�sentes conditions sont valables tant que vous �tre utilisateur des sites de TahitiCV. TahitiCV se r�serve le droit, � sa seule discr�tion, d'exercer toutes les voies de recours que lui accorde la loi, incluant, sans limitation, la suppression de vos affichages sur des Sites TahitiCV ainsi que la r�siliation imm�diate de votre inscription avec ou sans autre possibilit� d'acc�s aux Sites TahitiCV et/ou � tout autre service que vous fournit TahitiCV, en cas de manquement de votre part aux pr�sentes Conditions d'Utilisation ou si TahitiCV ne peut v�rifier ou authentifier les informations soumises lors de votre enregistrement sur un site de TahitiCV. De plus, si vous n'�tre plus un utilisateur des sites de TahitiCV, certaines clauses des pr�sentes resteront en vigueur apr�s cessation d'utilisation du (des) site(s), dont notamment les clauses 1, 2, 5 et de 7 � 16 inclus. </p>
<br>

            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>

            </td>
            
            <td style="width:250px;">WIDGETS....</td>
        </tr>
        <?php print FOOTNOTE; ?>
    </table>
    
</body>
</html>
