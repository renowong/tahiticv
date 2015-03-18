1. en root :
aptitude install libapache2-mod-php5 php5 apache2 mysql-server phpmyadmin subversion php-mail

Nota : le chemin par defaut des sites web sous apache2 se trouve dans /var/www

2. faire un checkout
svn co file:///

&lt;path&gt;

/Dropbox/svn/tahiticv /var/www/tahiticv

3. récupérer la base
Sous Phpmyadmin, accessible sous http://localhost/phpmyadmin (entrer login et password), créer une table vide "tahiticv", créer un user "tahiticv" avec mot de passe "tahiticv" avec accès complet sur la base.

4. import
Chemin : dans le répertoire tahiticv, sous db, tahiticv.sql

5. accéder au site
http://localhost/tahiticv

Nota pour Komodo:
pour activer subversion, aller dans edit, préférences, source code control,
Activer SVN integration, et donner le chemin de l'executable (/usr/bin/svn)