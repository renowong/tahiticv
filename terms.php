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
            <h2 class="static_h2 fnt5">Comprendre vos droits et responsabilités en tant qu'utilisateur TahitiCV.</h2>
            <div class="clear"></div>
        </div>
        <div id="static_container_body_main">
            <p>Ce document précise les Conditions d'Utilisation (Conditions) sous lesquelles l'utilisateur (ou « vous ») est autorisé utilise les sites et les services de TahitiCV (telles indiquées ci-dessous).</p>
<p><b>Ces conditions représentent un accord contraignant entre vous et TahitiCV qui exploite le site Web pour le pays dans lequel vous vivez ou dans lequel se trouve le siège de l'entreprise (« TahitiCV »). Vous acceptez ces conditions chaque fois que vous accédez au site de TahitiCV ou utilisez les services de TahitiCV. N'utilisez pas les sites ou les services de TahitiCV si vous n'acceptez pas les conditions présentées ici.</b></p>
<p>Les sites de TahitiCV sont définis en tant que tous les sites sous le contrôle de TahitiCV, qu'il s'agisse de contrôle partiel ou autre (en particulier TahitiCV.com et le site web à partir duquel vous avez eu accès à ces conditions d'utilisation). Les sites de TahitiCV comprennent de nombreuses fonctions et de nombreux services dont un service en ligne pour publier et rechercher des offres d'emploi («  Services de TahitiCV »). Les sites de TahitiCV comprennent aussi des communautés en ligne (« communautés TahitiCV ») conçues pour permettre une mise en réseau de valeur et professionnelle entre les utilisateurs (« utilisateurs ») des sites de TahitiCV en se basant sur des expériences et des intérêts communs. Les sites de TahitiCV permettent aux utilisateurs de définir aussi des profils individuels qui peuvent contenir des informations personnelles (« Profils ») et donne aussi la possibilité de rendre public ce profil ou une partie du profil.</p>
<p>TahitiCV peut modifier ces conditions en mettant en ligne une version actualisée de cette page web. Vous devez visiter régulièrement cette page et lire les conditions car elles sont légalement contraignantes pour vous.</p>
<p><b>Si des utilisateurs violent ces conditions, TahitiCV peut suspendre pour un temps ou mettre fin à leur accès.</b></p>
<p>Vous devez avoir 16 ans ou plus pour pouvoir visiter ou utiliser les sites de TahitiCV. Si vous avez moins de 18 ans ou moins que l'âge de la majorité définie dans votre juridiction, vous devez utiliser les sites de TahitiCV sous la supervision d'un parent, responsable légal ou un autre adulte responsable.</p>
            <h2>1. Utilisation des contenus de TahitiCV</h2>
<p>TahitiCV vous autorise, selon les présentes conditions à accéder et utiliser les sites de TahitiCV et leur contenu (comme défini ci-dessous) pour télécharger et imprimer lesdits contenus qui sont disponibles sur ou à partir des sites de TahitiCV et ceci exclusivement pour une utilisation privée, non commerciale. Les contenus, par exemple des designs, textes, graphiques, images, vidéos, informations, logos, icônes-boutons, logiciels, fichiers audio et autres (rassemblés sous le terme « contenus de TahitiCV ») sont protégés par copyright, la protection des marques commerciales déposées et d'autres lois. Tous les contenus sont la propriété de TahitiCV ou ses affiliés. La compilation (au sens de la collecte, de l'arrangement et de l'assemblage) de tous les contenus sur les sites est la propriété exclusive de TahitiCV et est protégée par les lois sur les droits d'auteur, la protection des marques commerciales et d'autres lois. Une utilisation non autorisée des contenus peut violer ces lois et/ ou les réglementations et statuts sur les communications et est strictement interdite. Vous devez garder toutes les copies autorisées que vous avez faites de contenus de TahitiCV, toutes les informations soumises aux droits d'auteur, à la protection des marques commerciales, des marques de service et d'autres informations propriétaires incluses dans les contenus d'origine de TahitiCV.</p>
<p>Tout code créé par TahitiCV pour générer ou afficher des contenus de TahitiCV ainsi que les pages dont sont faits les sites de TahitiCV, sont également protégés par copyright et vous ne devez pas copier ou modifier ces codes dans le cadre des réglementations légales.</p>
<p>Vous ne devez utiliser aucune partie des contenus de TahitiCV sur un autre site web ou dans un environnement Réseau (en particulier par le téléchargement ou la reproduction de contenus de TahitiCV sur Internet, Intranet ou Extranet ou en incluant des contenus dans une autre base de données ou en faisant une compilation d'informations). A moins que cela soit expressément indiqué, rien dans ces conditions ne peut être interprété comme une transmission de droits de propriété intellectuelle, que ce soit par préclusion, tacitement ou d'une autre façon. La licence accordée au titre des présentes est discrétionnairement résiliable à tout moment par TahitiCV. </p>
            <h2>2. Utilisation des Services de TahitiCV.</h2>
<p>
Les publications d'offre, la base de données des CV et les autres
fonctions des sites de TahitiCV ne peuvent être utilisées que par des
personnes recherchant un emploi et/ou des informations de carrière
ainsi que par les employeurs recherchant du personnel. De même, les
communautés de TahitiCV ne peuvent être utilisées qu'à des fins
professionnelles ou personnelles licites. Votre utilisation des
services de TahitiCV est aussi soumise à tout autre contrat que vous
pourriez avoir avec TahitiCV. En cas de conflit entre les présentes
Conditions et contrat que vous pourriez avoir avec TahitiCV, les termes
de votre contrat prévaudront. Le terme « publier », mentionné aux
présentes, signifie la soumission, la publication ou l'affichage de
données par vous sur un site de TahitiCV. <br>
<br>
</p>
<p><b>Les utilisateurs s'interdisent de :</b> </p>
<dl>
<dd>(a)Transmettre, publier, distribuer, enregistrer ou détruire tout
matériel, en particulier les contenus de TahitiCV, en violation des lois
ou règlementations en vigueur concernant la collecte, le traitement ou
le transfert d'informations personnelles, ou en violation des
directives de protection des informations de TahitiCV. </dd>
<br>
<dd>(b) d'effectuer des actions qui représenteraient une contrainte
non raisonnable ou disproportionnée pour l'infrastructure du site web
de
TahitiCV. </dd>
<br>
<dd>(c) d'utiliser un autre logiciel de navigation ou de recherche
sur un site web de TahitiCV que les outils disponibles sur le site, les
navigateurs web généralement disponibles de la part de tiers ou
d'autres outils autorisés par TahitiCV; </dd>
<br>
<dd>(d) utiliser des systèmes d'exploration de données (data mining),
des robots ou tout autre méthode semblable pour la collecte et
l'exploitation de données; </dd>
<br>
<dd>(e) de mettre en danger ou essayer de mettre en danger la
sécurité d'un site web de TahitiCV. Cela comprend les tentatives de
contrôler, scanner
ou tester la vulnérabilité d'un système ou réseau ou de violer des
mesures de sécurité ou d'authentification sans une autorisation
préalable expresse. </dd>
<br>
<dd>(f) contrefaire les protocoles TCP/IP ou toute partie des données
d'en-tête de mail ou de publication sur un forum; </dd>
<br>
<dd>(g) d'effectuer une ingénierie inversée (Reverse Engineering) ou
une décompilation de pages Web de TahitiCV; </dd>
<br>
<dd>(h) agréger, copier ou dupliquer de quelque manière que soit le
Contenu ou les informations disponibles sur les sites TahitiCV, en ce
compris
les d'offres d'emploi expirées, sauf dûment autorisé par les présentes
Conditions; </dd>
<br>
<dd>(i) référencer ou créer des liens vers tout Contenu ou
information disponible depuis les sites de TahitiCV, sauf expressément
autorisé par
les présentes Conditions; </dd>
<br>
<dd>(j) Publier des contenus ou des matériels qui contiennent des
informations fausses ou induisant en erreur ou qui promeuvent,
soutiennent ou renforcent des activités qui sont interdites par ces
conditions. Par exemple la fabrication ou l'achat d'armes illégales,
des violations de la vie privée, la préparation ou l'introduction de
virus informatiques ou de copies piratées; </dd>
<br>
<dd>(k) de publier un CV ou de poser sa candidature pour un poste au
nom d'une autre personne; </dd>
<br>
<dd>(l) divulguer à tout agent, agence ou autre tiers, le contact
d'un employeur; </dd>
<br>
<dd>(m) rendre publique plus d'une copie d'un même CV à la fois; </dd>
<br>
<dd>(n) partager, avec un tiers, toute identification de connexion
aux sites TahitiCV, un tiers étant toute personne autre que
l'utilisateur
unique auquel est affecté l'identifiant; </dd>
<br>
<dd>(o) obtenir des données ne vous étant pas destinées ou se
connecter à un serveur ou un compte pour lequel vous n'êtes pas
autorisé; </dd>
<br>
<dd>(p) publier ou soumettre sur les sites TahitiCV une information
biographique incomplète, fausse ou inexactes ou qui appartenant à un
tiers; </dd>
<br>
<dd>(q) de publier un contenu qui contient des pages à accès
restreint, protégées par mot de passe ou des pages web ou images
masquées; </dd>
<br>
<dd>(r) obtenir d'autres utilisateurs des mots de passe ou des
données
personnelles d'identification; </dd>
<br>
<dd>(s) supprimer ou modifier tout élément publié par une autre
personne ou entité; </dd>
<br>
<dd>(t) harceler, inciter au harcèlement ou prôner le harcèlement à
l'encontre d'un groupe, d'une entreprise ou d'une personne; </dd>
<br>
<dd>(u) envoyer des courriers, mails ou fax ou effectuer des appels
téléphonique non sollicités, notamment pour promouvoir des produits ou
services, à tout utilisateur ou tenter de contacter ces derniers sans
avoir obtenu au préalable leur accord; </dd>
<br>
<dd>(v) tenter d'interférer avec le service fourni à tout
utilisateur, hébergeur ou réseau, au moyen notamment d'un
téléchargement de virus
informatique, d'une surcharge, de "flooding", "spamming", "mailbombing"
ou "crashing"; </dd>
<br>
<dd>(w) répandre ou encourager la copie illégale ou non autorisée du
travail d'un tiers protégé par des droits d'auteur, tels que le
transfert ou la mise à disposition de logiciels informatiques piratés
ou leurs liens, fournir ou mettre à disposition des renseignements
permettant de contourner des dispositifs manufacturiers couvert par des
droits d'auteurs, ou fournir ou mettre à disposition de la musique,
vidéo ou autres médias et liens vers des sites de piratage; </dd>
<br>
<dd>(x) utiliser les Services TahitiCV à des fins illicites ou pour
les besoins d'une activité illégale, publier ou soumettre tout contenu,
CV
ou d'offre d'emploi diffamatoire, calomnieuse, implicitement ou
explicitement offensante, vulgaire, obscène, menaçante, abusive,
haineuse, raciste, discriminatrice, à tendance menaçante ou pouvant
troubler, gêner, provoquer de l'anxiété, harceler tout individu ainsi
que d' incorporer des liens vers du contenu pornographique, indécent ou
à connotation sexuelle; ou </dd>
<br>
<dd>(y) mettre en ligne un CV autre qu'un réel CV et qui aurait pour
but de promouvoir des produits ou services. </dd>
</dl>
<p>
Des violations de la sécurité du système ou du réseau peuvent conduire
à des poursuites civiles et pénales. TahitiCV recherchera les occasions
dans lesquelles de telles violations pourraient avoir eu lieu et peut
faire appel aux autorités judiciaires pour poursuivre des utilisateurs
qui ont participés à de telles violations et coopérer avec ces
autorités.
</p>
            <h2>3. Conditions supplémentaires applicables aux employeurs.</h2>
<p>Il est de votre responsabilité de conserver la confidentialité de
votre compte Employeur, du profil et des mots de passe. Il vous est
interdit de partager même temporairement, vos identifiant, mot de passe
et autre paramètre d'accès à votre compte à des tiers. Vous êtes
responsable pour l'utilisation de vos enregistrements et mots de passe
sur les sites de TahitiCV, que cette utilisation ait été autorisée ou
pas par vous. A ce titre, vous vous obligez à informer TahitiCV, sans
délai, de toutes utilisations non autorisées de son compte et /ou
identifiants.</p>
<p>Les employeurs sont seuls responsables de leurs publications sur les
sites TahitiCV. TahitiCV ne pourra en aucun cas être assimilé à un
employeur ou à un mandataire de ce dernier eu égard à votre utilisation
du site TahitiCV et/ou des décisions d'embauche, pour quelques raisons
que ce soient, de l'entité publiant des offres sur le site de TahitiCV. <br>
</p>
<p>Vous comprenez et reconnaissez que si vous mettez fin à votre compte
d'employer, toutes vos informations de compte de TahitiCV, y compris les
CV enregistrés, les contacts de réseau et les listes d'emails seront
effacés de la base de données de TahitiCV. Le délai de traitement de la
demande de suppression peut néanmoins laisser subsister des données
quelques temps. </p>
<p>Afin de protéger les utilisateurs TahitiCV de campagnes publicitaires
ou
de sollicitations indésirables, TahitiCV se réserve le droit de limiter,
à sa seule discrétion, le nombre de mails susceptibles d'être envoyés
par les employeurs, et ce peut envoyer aux utilisateurs. </p>
<p>Des profils de candidats provenant de contenus utilisateur peuvent
aussi être rendus accessibles sur les sites. TahitiCV ne garantit en
aucun cas l'exactitude ou la validité de tels profils ou de leur
pertinence pour une évaluation par les employeurs. Les profils dérivés
peuvent différer significativement du contenu original de l'utilisateur.</p>
<b>Publications d'Offres </b>
<br>
<br>
<p><b>Une Offre ne saurait en aucun cas contenir :</b>
</p>
<dl>
<dd>(a) de liens hypertexte, autres que ceux expressément autorisés
par
TahitiCV; </dd>
<br>
<dd>(b) des mots clés « cachés », pouvant induire en erreur ou
illisible,
ou des mots clé répétitifs ou sans rapport avec l'offre d'emploi
publiée;</dd>
<br>
<dd>(c) les noms, logos ou marques d'entreprises autres que les
vôtres ou
expressément autorisées par TahitiCV;</dd>
<br>
<dd>(d) les noms d'école ou institutions, de villes, de départements,
de
régions ou pays n'ayant aucun lien avec l'offre;</dd>
<br>
<dd>(e) plus d'une offre ou description, plus d'une localité, ou plus
d'une
catégorie, à moins que le produit ne le permette;</dd>
<br>
<dd>(f) des donnés incorrectes, fausses ou erronées; et</dd>
<br>
<dd>(g) des éléments ou des liens vers des éléments à connotation
sexuelle,
violente ou situation d'abus ou qui sollicite des données personnelles
de personnes de moins de 16 ans.</dd>
<br>
<p><b>Il vous est interdit d'utiliser les services TahitiCV en vue de :</b>
</p>
<dl>
<dd>(a) publier des offres non conforme aux lois et règlements en
vigueur
dans le pays de publication de l'offre ou en tout autre pays, si
applicable, en matière, notamment, de droit du travail, d'égalité des
chances, et des exigences en fonction des qualifications par rapport à
l'emploi, la protection des informations, l'accès et l'utilisation des
données personnelles ainsi que la propriété intellectuelle; </dd>
<br>
<dd>(b) publier des offres exigeant une nationalité particulière ou
une
résidence permanente dans un pays comme condition d'emploi, à moins
qu'une telle condition soit requise par la loi ou réglementations en
vigueur;</dd>
<br>
<dd>(c) publier des offres qui imposerait des contrôles ou critères
spécifiques pour l'accès à l'emploi sans que ces contrôles ou critères
soient juridiquement obligatoires;</dd>
<br>
<dd>(d) publier des offres et autres publicités pour le compte de
concurrents de TahitiCV ou publier des offres ou autre contenu qui
comportent des liens vers des sites concurrents de TahitiCV;</dd>
<br>
<dd>(e) vendre, valoriser ou faire de la publicité de produits ou
services;</dd>
<br>
<dd>(f) publier des offres portant sur des franchises, système
pyramidal,
adhésion à un club, accords de distribution, de concession ou d'agence
commerciale, ou à la vente à niveaux multiples (« multi-level Marketing
»);</dd>
<br>
<dd>(g) publier des offres portant sur une opportunité d'affaires
qui
requiert un paiement d'avance ou périodique ou nécessite le recrutement
d'autres membres, sous-distributeurs ou sous-agents;</dd>
<br>
<dd>(h) publier offres portant sur des opportunités d'affaire
rémunérées
uniquement par commission à moins que l'offre précise clairement cet
état de fait et décrive précisément le produit ou service à vendre;</dd>
<br>
<dd>(i) promouvoir des opportunités qui ne sont pas des offre
d'emplois
sérieuses;</dd>
<br>
<dd>(j) publier des offres visant la recherche de modèles,
d'acteurs,
d'artistes ou autre talents ou encore des postes d'agent ou de
prospection de tels personnel;</dd>
<br>
<dd>(k) passer des annonces visant des services sexuels ou
recherchant du
personnel pour des activités de nature sexuelle;</dd>
<br>
<dd>(l) solliciter ou promouvoir le commerce du corps humain ou
d'organes,
dont notamment des services de fécondation assistée, tels que le don
d'ovules ou de « mère porteuse ».</dd>
<br>
<dd>(m) promouvoir un parti, un programme, une position ou un sujet
politique;</dd>
<br>
<dd>(n) promouvoir une religion;</dd>
<br>
<dd>(o) publier des offres pour des postes basés dans des pays
faisant
l'objet d'une sanction économique de la part du gouvernement des
Etats-Unis; et</dd>
<br>
<dd>(p) sauf si permis par la loi, publier des offres obligeant le
candidat
à fournir des données relatives à (i) ses origines ethniques ou
raciales, (ii) ses convictions politiques,(iii) croyances
philosophiques ou religieuses,(iv) son appartenance à un syndicat, (v)
sa santé physique ou mentale, (vi) se préférences sexuelles, (vii) son
passé judiciaire, ou (vii) son âge.</dd>
</dl>
<p><b>TahitiCV se réserve, à sa seule discrétion, le droit de
supprimer
toute offre ou contenu publié sur son site qui serait non conforme aux
Conditions précitées ou dont le contenu pourrait porter atteinte à
TahitiCV ou aux utilisateurs de TahitiCV. </b></p>
<p><b>Si, à tout moment, Vous portez atteinte par votre
utilisation à
TahitiCV ou autrement trompez TahitiCV quant à la nature de vos
activités, TahitiCV aura le droit de suspendre, voire résilier, les
Services souscrits.</b></p>
<p><b>Base de Données CV </b> <br>
<br>
<b>Utilisation par les Employeurs des bases de données CV </b><br>
<br>
Vous utiliserez la base de données CV de TahitiCV conformément aux
présentes Conditions et autre condition contractuelle souscrite auprès
de TahitiCV. Vous utiliserez la base de données CV de TahitiCV dans le
respect des lois et règlements relatives à la confidentialité et la
protection de données personnelles. Vous vous interdisez de divulguer
les données de la base CV de TahitiCV à des tiers, à moins que ce tiers
ne soit une agence de recrutement autorisée, une agence de
communication ou autres intermédiaires dûment autorisé par TahitiCV et
utilisant la base CV dans un but exclusif de recrutement.</p>
<p>Vous prendrez des mesures physiques, techniques et
administratives
appropriées pour protéger les informations que vous avez obtenues de la
base de données de CV de TahitiCV, contre la perte, une utilisation
malveillante, un accès non autorisé, leur publication, modification ou
destruction. Vous vous est interdit de partager les identifiants et
mots de passe des licences d'accès à la CVthèque avec des tiers.</p>
<p><b>La base de données CV de TahitiCV ne pourra en aucun cas
être
utilisée : </b></p>
<dl>
<dd>(a) dans tout autre but que celui d'un employeur recherchant du
personnel ou tout particulièrement dans le but de promouvoir des
offres, produits ou services à tout titulaire de CV;</dd>
<br>
<dd>(b) dans le but d'effectuer des appels ou envoyer des fax,
courriers,
courriels ou newsletters non sollicités à des titulaires de CV ou
encore de contacter toute personne à moins que ce contact ait fait
l'objet d'une acceptation expresse (si une telle acceptation n'est pas
requise, la personne contactée ne devra pas vous avoir avisé de son
refus d'être sollicitées); ou</dd>
<br>
<dd>(c) de rechercher ou contacter des candidats ou titulaires de
CV pour
les besoins de salons de recrutement ou des opportunités interdites par
ailleurs dans le présent article 3.</dd>
</dl>
<br>
<b>Afin d'assurer une utilisation sécurisée et efficace pour tous les
utilisateurs, TahitiCV se réserve le droit de limiter la quantité de
données (y compris les vues de CV) accessibles par l'utilisateur. Ces
limitations peuvent être modifiées à tout moment, à la seule discrétion
de TahitiCV.</b>
            <h2>4. Conditions additionnelles applicable aux Candidats. </h2>
<p>
Lorsque vous vous inscrivez sur le Site, il vous sera demandé de
fournir à TahitiCV certaines informations, incluant, sans que cela soit
limitatif, une adresse e-mail valide (vos "Informations"). </p>
<p>Tout profil que vous soumettez doit être exact et vous décrire en
tant
qu'individu. Les profils nécessitent de remplir des champs standard.
Vous pouvez ne pas inclure dans ces profils des numéros de téléphone,
adresses postales, adresses email ou d'autres information permettant de
vous contacter autre que votre nom de famille et vos URL. </p>
<p>Vous êtes seul responsable du format, du contenu et de l'exactitude
de
tout CV ou élément mis en ligne sur les sites TahitiCV.</p>
<p>TahitiCV se réserve le droit de proposer des services et produits
provenant de tiers suivant les préférences que vous aurez indiquées
lors de votre inscription ou ultérieurement et si vous avez accepté de
recevoir les offres provenant de TahitiCV ou de tiers. Vous êtes invités
à vous référer à la Notice Protection des données de TahitiCV pour de
plus amples renseignements sur le traitement des données personnelles.</p>
<p>Vous ne détenez aucun droit de propriété sur votre compte. Si vous
révoquez votre compte ou si votre compte TahitiCV est annulé, toutes vos
informations de compte, y compris celles du profil, des CV, des
lettres, emplois enregistrés et questionnaires pourront être supprimées
de la base de données de TahitiCV et enlevées du domaine public des
sites de TahitiCV. Des données peuvent toutefois subsister pour une
certaine période en raison du délai de traitement nécessaire à leur
suppression. Il est précisé que des tiers peuvent conserver des copies
sauvegardées de vos données personnelles. </p>
<p>TahitiCV se réserve le droit de supprimer votre compte Client et
toutes
vos Données après une période significative d'inactivité.
</p>
            <h2>5. Contenu Utilisateur et Soumissions. </h2>
<p>
Toutes les informations, données, textes, logiciels, musiques, sons,
photos, graphiques, vidéos, informations, nouvelles et autres matériels
que vous avez soumis, publiés ou représentés (« contenu utilisateur »)
sur les sites de TahitiCV sont sous votre seule responsabilité. TahitiCV
ne prend pas de responsabilité sur la propriété du contenu utilisateur
ou son contrôle. Vous, ou tiers affilié, restez les détenteurs de tous
les brevets, marques commerciales et droits d'auteurs des contenus
utilisateur que vous publiez sur ou par l'intermédiaire des sites de
TahitiCV. Il est de votre responsabilité de protéger ces droits. Par la
soumission, la publication ou la représentation de contenu utilisateur
sur ou par l'intermédiaire de TahitiCV, vous accordez à TahitiCV un droit
mondial non exclusif et gratuit pour reproduire, adapter, répandre,
publier ces contenus utilisateur. Par la soumission, la publication ou
la représentation d'un contenu utilisateur auquel le public peut avoir
accès, vous accordez à TahitiCV un droit mondial non exclusif et gratuit
pour reproduire, adapter, répandre, publier ces contenus utilisateur
dans des buts de promouvoir TahitiCV et ses services. TahitiCV mettra fin
à son utilisation du contenu utilisateur après une période raisonnable
suivant la suppression dudit contenu par utilisateur du site TahitiCV.
TahitiCV se réserve, à sa seule discrétion, le droit de refuser,
d'accepter, de publier, d'afficher ou de transmettre du contenu
utilisateur.</p>
<p>En soumettant du Contenu dans une partie publique du site TahitiCV,
vous
accordez à tout utilisateur le droit d'accéder, d'afficher, de
consulter, de conserver et de reproduire tel contenu à des fins
personnelles. Sous réserve de ce qui précède, le propriétaire de ce
Contenu conserve tous les droits qui peuvent exister sur le contenu
publié. TahitiCV se réserve le droit de réviser et/ou retirer tout
contenu utilisateur qui, de son avis, enfreint les présentes conditions
d'utilisation, enfreint les lois et règlements en vigueur, est abusif,
dérangeant, vulgaire, illicite ou porte atteinte aux droits de tiers,
préjudicie ou menace la sécurité des autres utilisateurs de TahitiCV.
TahitiCV se réserve, en cas de non respect des présentes, le droit
d'exclure des utilisateurs, de supprimer leur droit d'accès aux sites
de TahitiCV et leur utilisation des services. TahitiCV se réserve le
droit de prendre toute mesure qu'elle jugera utile, si le contenu
utilisateur d'une manière ou d'une autre pourrait constituer un
fondement à des poursuites, pourrait porter atteinte à la marque ou à
l'image de TahitiCV, pourrait lui faire perdre des utilisateurs ou les
services de ses fournisseurs de services Internet ou autres
fournisseurs. </p>
<p>TahitiCV ne garantit pas la véracité, l'exactitude ou la fiabilité du
contenu utilisateur ou messages postés par les utilisateurs. TahitiCV
n'endosse pas les opinions éventuellement émises par ces utilisateurs.
L'utilisateur reconnait que le crédit à accorder au contenu affiché par
d'autres utilisateurs est de sa seule responsabilité. </p>
<p>Il est interdit d'incorporer dans le contenu soumis aux forums de
TahitiCV, des données qui peuvent être interprétées comme une
sollicitation directe, une annonce ou un recrutement pour un poste
disponible ciblant les personnes recherchant un emploi soit à temps
plein ou partiel. Afin de protéger notre communauté d'utilisateurs des
publicités ou sollicitations intempestives, TahitiCV se réserve le droit
de limiter la quantité de mails ou autres messages qu'un utilisateur
peut envoyer aux utilisateurs. </p>
<p>Du contenu extrait des profils candidats peuvent aussi être rendus
disponibles sur les sites de TahitiCV. TahitiCV ne garantit aucunement la
valeur ou l'exactitude de tels extraits ou de leur pertinence pour une
évaluation par les employeurs. Ces profils dérivés peuvent varier du
Contenu original de l'utilisateur. </p>
<p>Nous apprécions le retour de nos clients et vos commentaires
concernant
nos services et les Sites TahitiCV sont les bienvenus. Cependant nous
vous informons que notre politique ne nous permet pas d'accepter ou de
prendre en considération des idées créatives, suggestions, inventions
ou contenus autres que ceux que nous demandons expressément. Bien que
nous accordions de l'importance à vos retours sur nos services, nous
vous remercions d'être précis lors de vos commentaires sur ceux-ci, et
de ne pas soumettre d'idées créatives, inventions, suggestions ou
contenus. Si, en dépit de notre demande, vous nous soumettez des
suggestions créatives, dessins, concepts, inventions, ou autres
informations (les « soumissions »), ces soumissions deviennent la
propriété de TahitiCV, ou en cas d'impossibilité pour TahitiCV de détenir
exclusivement les droit sur la soumission, vous accordez à TahitiCV, en
adhérant aux présentes, une licence gratuite, irrévocable d'utiliser la
soumission sans restriction quel qu'en soit l'usage par TahitiCV, qu'il
soit commercial ou autre, et ce sans qu'aucune compensation puisse être
réclamée par le client ou autre tiers. Aucune des soumissions ne pourra
faire l'objet d'une obligation de confidentialité de notre part et nous
ne serons pas responsables de l'utilisation ou la divulgation qui
pourrait être faite de la soumission.
</p>
            <h2>6. Notifications relatives aux Droits d'auteur ou des marques.</h2>
<p>Si des éléments publiés sur l'un quelconque des sites de TahitiCV
porte atteinte à des droits d'auteur ou autre droits protégés, ces
faits doivent être porté à l'attention du juriste de TahitiCV indiqué ci-dessous, lequel a été désigné
par notre société pour recevoir toute plainte relative aux droits de la
propriété intellectuelle ou autre non-conformité par rapport aux
présentes Conditions.
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
Polynésie Française<br>
</td>
</tr>
</tbody>
</table>
<p>
Besoin d'aide pour un problème relatif aux candidats --> <a
href="contact.php" title="Contactez-nous">Contactez-nous</a>.<br>
</p>
<h2>7. Résiliation pour infraction aux droits de la propriété
intellectuelle d'autrui. </h2>
<p>
TahitiCV respecte les droits de propriété intellectuelle des tiers et
nous demandons à nos utilisateurs, titulaires de comptes et partenaires
de contenu d'en faire autant. La reproduction, copie, distribution,
modification, représentation ou diffusion au public non autorisées
d''uvres protégées par le droit d'auteur, constitue une violation des
droits du titulaire. Vous consentez à ne pas utiliser ce Site ou tout
Site TahitiCV en vue de violer les droits de propriété intellectuelle
d'autrui de quelque manière que ce soit. Nous supprimerons les comptes
de tout titulaire de compte et bloquerons l'accès à notre Site et/ou
aux autres Sites TahitiCV à tout utilisateur qui viole de manière
répétée le droit d'auteur ou autres droits de propriété intellectuelle
d'autrui. Nous nous réservons le droit d'entreprendre ces actions à
tout moment, à notre seule discrétion, avec ou sans préavis, et sans
responsabilité de notre part à l'égard du titulaire de compte désabonné
ou à l'égard de l'utilisateur dont l'accès est bloqué. </p>
<p>Nonobstant ce qui précède, si de bonne foi, vous pensez que la
suppression de compte a été faite sur des bases injustifiées, nous vous
prions de contacter le Directeur des Conformités et de Prévention des
Fraudes comme indiqué ci-dessus. </p>
            <h2>
8. La Responsabilité de TahitiCV</h2>
<p>
Les sites TahitiCV sont uniquement des lieux d'échanges permettant (i)
aux employeurs d'afficher des offres d'emploi et rechercher des
candidats et (ii) aux candidats de publier leurs CV et profiles et
rechercher un emploi. TahitiCV ne procède par au filtrage ou à la
censure des offres. TahitiCV n'est pas partie à la relation entre les
employeurs et les candidats. En conséquence, TahitiCV n'exerce aucun
contrôle sur la qualité, la sécurité ou la légalité des emplois ou CV
affichés, la véracité ou la précision des rubriques, la capacité des
employeurs à offrir des emplois aux candidats ou l'aptitude des
candidats à pourvoir aux positions proposées. Bien que TahitiCV se
réserve le droit, à tout moment et à sa seule discrétion de retirer
tout contenu utilisateur, offre d'emploi, CV ou autre élément publié
sur ses sites, TahitiCV n'assume sur ce point aucune obligation, sous
réserve toutefois des obligations légales impératives, et rejette toute
responsabilité pour ne pas avoir supprimé quelques élément publié sur
son site. </p>
<p>Les communautés de TahitiCV offrent un point de rencontre
permettant la mise en réseau de personne à des fins professionnelles
et/ou privées. TahitiCV ne surveille et ne censure aucun profil ou
contenu utilisateur sur les pages web de TahitiCV. TahitiCV ne prend pas
part à la communication entre les utilisateurs. Il en résulte que
TahitiCV n'a pas de contrôle sur l'exactitude, la fiabilité, l'état de
complétude ou l'actualité des profils et des contenus utilisateur
postés sur ses pages web. TahitiCV n'est nullement responsable de ces
profils et contenus utilisateur. </p>
<p>Nous attirons votre attention sur la
présence de risques (pouvant aller jusqu'au risque de préjudice
corporel) qui pourrait résulter de contact avec des étrangers, des
mineurs ou des gens qui utilisent de fausses identités. Vous assumez
tous les risques qui résultent des relations avec d'autres utilisateurs
avec lesquels vous entrez en contact sur les sites de TahitiCV. Des
informations sur d'autres personnes peuvent être offensantes,
blessantes ou inexactes. Dans certains cas, vous pouvez être présenté
de façon erronée ou mensongère. Nous nous attendons à ce que vous soyez
prudent et raisonnable quand vous utilisez les sites de TahitiCV.
</p>
<p>Comme l'identification d'utilisateurs est difficile sur Internet,
TahitiCV ne saurait garantir que chaque utilisateur correspond à ce
qu'il prétend être. De la même manière que nous ne sommes, ni ne
pouvons être, partie aux échanges entre des utilisateurs, nous ne
contrôlons pas le comportement des participants sur les sites TahitiCV.
En cas de litige avec un ou plusieurs utilisateurs, vous déchargez
expressément TahitiCV (nos agents et employés) de toute demande,
réclamation et dommages (dommages consécutifs effectifs, directs ou
indirects) de tout type et de toute nature, connu ou inconnu, dommages
soupçonnés ou insoupçonnés, dommages révélés et non révélés qui
résulteraient du comportement ou de la tromperie d'un utilisateur. </p>
<p>Les sites et les contenus de TahitiCV peuvent inclure des
inexactitudes et
des fautes de frappe. TahitiCV ne donne aucune garantie concernant
l'exactitude, la fiabilité, l'état de complétude ou d'actualité des
sites ou de leur contenu. L'utilisation des sites et des contenus de
TahitiCV se fait à vos propres risques et périls. Des changements sont
régulièrement effectués sur les sites de TahitiCV. TahitiCV ne peut donne
aucune garantie de résultat quant à l'utilisation de tout ou partie de
ses sites. Aucun conseil ou information, oral ou écrit, reçu par un
utilisateur de TahitiCV ou par un des sites de TahitiCV ne crée pour
cette dernière une obligation autre que celles expressément listées aux
présentes. </p>
<p>Si vous résidez en Californie, vous renoncez à la
'California Civil Code Section 1542', qui précise : « A general release
does not extend to claims which the creditor does not know or suspect
to exist in his or her favor at the time of executing the release,
which if known by him or her must have materially affected his or her
settlement with the debtor. » </p>
<p>Si vous résidez en Pologne, vous
reconnaissez que sur la base de l'article 558 ss du Code Civil
polonais, la garantie de TahitiCV, pour des défauts intrinsèques ou
légaux afférents à des produits offerts, est exclue. </p>
<p>TahitiCV vous
conseille de conserver une copie de sécurité de vos contenus
utilisateur. TahitiCV rejette toute responsabilité, dans la mesure où
c'est permis pas la loi, pour l'effacement, la perte ou la modification
non autorisée de tout contenu utilisateur. </p>
<p>TahitiCV ne donne aucune
garantie concernant la nature ou la qualité des produits ou services de
tiers, même achetés via un site web de TahitiCV. Les obligations,
garanties, assurances, conventionnelles ou légales, sont à la charge
exclusive du fournisseur desdits produits ou services suivants les
conditions négociées entre l'acquéreur et le fournisseur. </p>
<p>Si vous
constatez quelque élément sur le site qui pourrait contredire ce qui
précède, nous vous prions de vous mettre en contact avec le responsable
désigné en article 6 ci-dessus.
</p>
<p>La décision de supprimer ou amender le contenu ainsi dénoncé revient
exclusivement à TahitiCV, laquelle ne pourra en aucun cas être tenu de
le faire sans que cela puisse engager d'une manière ou d'une autre sa
responsabilité.
</p>
            <h2>9. Exclusion de garantie</h2>
<p>
SOUS RESERVE DE LOIS D'ORDRE PUBLIC CONTRAIRES, TahitiCV N'EST AUCUNEMENT RESPONSABLE DES DYSFONCTIONNEMENTS DE SES SITES, DE SES SERVICES, D'EVENTUELS VIRUS OU AUTRE MECANISME DOMMAGEABLE. TahitiCV NE SAURAIT ÊTRE TENUE POUR RESPONSABLE DES COUTS LIES A D'EVENTUELS REMPLACEMENTS D'EQUIPEMENT, MESURES DE REMISE EN ETAT, RESTAURATIONS DE DONNEES OU AUTRES EVENEMENT LIE A VOTRE UTILISATION DES SITES TahitiCV OU DE LEUR CONTENU. LES SITES ET LEUR CONTENU SONT FOURNIS SANS AUCUNE GARANTIE D'AUCUNE SORTE QUE CE SOIT AU TITRE DES POSSIBILITES DE COMMERCIALISATION, LA PERTINENCE PAR RAPPORT AU BUT RECHERCHE OU ENCORE DES EVENTUELLES RESTRICTION D'UTILISATION. TahitiCV NE DONNE AUCUNE GARANTIE CONCERNANT L'EXACTITUDE, LA FIABILITE, L'ETAT DE COMPLETUDE OU D'ACTUALITE DES CONTENUS, SERVICES, LOGICIELS, TEXTES, GRAPHIQUES ET LIENS.</p>
<h2>10. Exclusion de garantie pour dommages consécutifs </h2>
<p>
SOUS RESERVE DE DISPOSITIONS DE LOIS D'ORDRE PUBLIC CONTRAIRES, TahitiCV, SES FOURNISSEURS OU TOUT TIERS MENTIONNE SUR QUELQUE SITE DE TahitiCV NE SAURAIENT EN AUCUN CAS VOIR SA RESPONSABILITE ENGAGEE POUR TOUT DOMMAGE, QUEL QU'IL SOIT (EN CE COMPRIS NOTAMMENT LES DOMMAGES INCIDENTS, CONSECUTIFS, PERTES D'UNE CHANCE, PERTES DE PROFIT OU DE DONNEES OU ENCORE INTERRUPTION DE BUSINESS) RESULTANT DE L'UTILISATION OU DE L'INCAPACITE D'UTILISER TOUT OU PERTIE DU SITE TahitiCV ET SES CONTENUS, QUE L'ON SE BASE POUR UNE RECLAMATION SUR UNE GARANTIE, UN CONTRAT, UNE MANIPULATION NON AUTORISEE OU UNE AUTRE RAISON LEGALE ET QUE TahitiCV SOIT OU NON INFORME DE TELS DOMMAGES.</p>
<h2>11. Limitation de responsabilité</h2><p>
SI LA RESPONSABILITE DE TahitiCV DEVAIT TOUTEFOIS ÊTRE ENGAGEE, SA RESPONSABILITE AU  TITRE DES DOMMAGES SUBIS DU FAIT DE L'UTILISATION DES SITES DE TahitiCV OU DE LEUR CONTENU, SERA, SOUS RESERVE D'UNE LOI CONTRAIRE, LIMITEE A 100', QUE SA RESPONSABILITE SOIT CONTRACTUELLE, DELICTUELLE OU AUTRE. </p>
<h2>12. Liens vers d'autres sites </h2><p>
Les sites de TahitiCV comprennent des liens vers des sites tiers. Ces liens ne sont fournis que pour vous aider et TahitiCV n'en cautionne pas les contenus et ne saurait être associée d'une quelconque manière à ces sites. TahitiCV ne saurait être tenue pour responsable desdits sites et ne garantit dès lors ni leur contenu, ni leur fiabilité. Si vous accédez à ces sites tiers, vous le faites à vos risques et périls. </p>
<h2>13. Pas de revente ou d'autre utilisation commerciale non autorisée </h2><p>
Vous vous engagez à ne pas vendre ou céder vos droits et obligations dans le cadre des présentes conditions. Vous vous engagez également de ne faire aucune utilisation commerciale non autorisée de tout ou partie des sites TahitiCV. </p>
<h2>14. Indemnisation</h2><p>
Vous garantissez TahitiCV, ses dirigeants, ses administrateurs, employés et agents contre toute réclamation, action en justice ou demande incluant sans restriction, les frais juridiques et comptables résultant de (i) tout contenu que vous avez fourni sur un Site TahitiCV, (ii) tout usage que vous avez fait du Contenu du Site ou (iii) votre manquement aux présentes Conditions d'Utilisation. TahitiCV vous notifiera promptement toute réclamation, plainte ou procédure. </p>

            <h2>15. Généralités </h2>
<p>
TahitiCV ne garantit pas qu'il soit possible d'accéder ou de consulter le Site en dehors de la Polynésie Française. L'accès au Contenu du Site peut ne pas être licite pour certaines personnes ou dans certains pays. Si vous accédez aux Sites de TahitiCV, c'est sous votre seule responsabilité. Vous êtes responsables du respect des lois du lieu où vous vous situez. Des logiciels qui sont téléchargés à partir des sites de TahitiCV sont soumis aux règlementations de contrôle des exportations des Etats Unis d'Amérique. Ces logiciels ne doivent pas être téléchargés exportés ou réexportés d'une autre façon vers un citoyen ou un habitant de (i) Cuba, Irak, Lybie, Corée du Nord, Iran, Syrie ou autre Etat qui est soumis à un embargo commercial des Etats-Unis. Ils ne peuvent non plus être transmis à (ii) une personne ou une entreprise se trouvant sur la liste "Specially Designated Nationals" établie par le département du trésor des Etats-Unis (« US Treasury Department » ou la liste "Table of Deny Orders" du département du commerce des Etats-Unis (« U.S. Commerce Department »). </p>
<p>
Pour le téléchargement ou l'utilisation de tels logiciels, vous garantissez que vous ne vous trouvez pas dans un tel pays, que vous n'êtes pas soumis au contrôle d'un tel pays, que vous n'êtes pas citoyen ou habitant d'un tel pays ou une personne ou une entreprise se trouvant sur une telle liste. </p>
<p>
Ces conditions sont soumises au droit français. Toute réclamation concernant les présentes conditions d'utilisation sera soumise au tribunal compétent de Papeete. Si une clause des présentes est déclarée nulle par une juridiction compétente, cette nullité ne pourra pas affecter la validité des autres clauses des Conditions d'Utilisation qui demeureront en vigueur. Aucune renonciation à une clause des Conditions d'Utilisation ne constituera une renonciation future ou permanente à cette clause ou à toute autre clause. De plus, si TahitiCV n'applique par une des clauses de ces Conditions, cela ne sera pas considéré comme un renoncement à cette stipulation ou n'influencera pas autrement la capacité de TahitiCV d'appliquer cette clause dans le futur. Sauf expressément prévu par un contrat dûment formé entre vous et TahitiCV ou conditions d'utilisation spécifiques à certaines parties du Site de TahitiCV, y compris dans la Notice Protection des Données (disponible sur http://mon.TahitiCV.fr/privacy/), les présentes conditions représentent l'intégralité de l'accord entre vous et TahitiCV concernant l'utilisation du Site. Aucune modification des présentes Conditions d'Utilisation n'est possible sauf en cas d'affichage révisé de ces pages.
</p>
            <h2>16. Conditions complémentaires d'utilisation </h2>
<p>
Certaines parties/pages des Sites TahitiCV sont soumis à des conditions d'utilisation spécifiques ou supplémentaires. En utilisant ces parties ou toute partie de celles-ci, vous acceptez d'être lié par lesdites conditions complémentaires d'utilisation. </p>
<p>
©GfK GeoMarketing Informations géographiques fournies par GfK GeoMarketing GfK. GeoMarketing fournit les informations géographiques des codes postaux de l'Europe de l'Ouest et du Canada pour créer un moteur de recherche permettant de localiser et de visualiser des offres sur une carte. Les cartes et les informations géographiques sont protégées par un copyright. Elles ne peuvent être utilisées que par l'application Internet et les fonctionnalités fournies par TahitiCV. Toute autre utilisation (ou diffusion) des informations géographiques et des cartes n'est pas autorisée.</p>
<p>
©Maponics, LLC 2008 Informations géographiques fournies par Maponics, LLC. Maponics fournit les informations géographiques et les cates pour les codes postaux des Etats Unis. Ces informations sont protégées par copyright. Elles ne peuvent être utilisées que dans le cadre de l'application Internet et des fonctionnalités fournies par TahitiCV. Toute autre utilisation (ou diffusion) des coordonnées géographiques et des cartes n'est pas autorisée.
</p>
            <h2>17. Durée et résiliation </h2>
<p>
Les présentes conditions sont valables tant que vous être utilisateur des sites de TahitiCV. TahitiCV se réserve le droit, à sa seule discrétion, d'exercer toutes les voies de recours que lui accorde la loi, incluant, sans limitation, la suppression de vos affichages sur des Sites TahitiCV ainsi que la résiliation immédiate de votre inscription avec ou sans autre possibilité d'accès aux Sites TahitiCV et/ou à tout autre service que vous fournit TahitiCV, en cas de manquement de votre part aux présentes Conditions d'Utilisation ou si TahitiCV ne peut vérifier ou authentifier les informations soumises lors de votre enregistrement sur un site de TahitiCV. De plus, si vous n'être plus un utilisateur des sites de TahitiCV, certaines clauses des présentes resteront en vigueur après cessation d'utilisation du (des) site(s), dont notamment les clauses 1, 2, 5 et de 7 à 16 inclus. </p>
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
