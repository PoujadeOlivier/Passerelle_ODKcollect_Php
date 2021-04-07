# Passerelle_ODKcollect_Php


Prérequis serveur<br/>
Apache2<br/>
Php > 5.4  -  Php 7  -  Php 8<br/>

Prérequis client Android<br/>
ODK Collect 
(https://play.google.com/store/apps/details?id=org.odk.collect.android&hl=fr&gl=US  |  https://github.com/getodk/collect)<br/>


Sources pratiques<br/>
https://github.com/ken-muturi/php-odk/blob/master/submission/index.php <br/>
http://www.laroeco.com/2016/Intercept-odk-collect-submissions/

Sources théoriques<br/>
https://docs.getodk.org/openrosa-authentication/<br/>
https://bitbucket.org/javarosa/javarosa/wiki/AuthenticationAPI


############# Mise en place

Côté serveur

Copier le dossier <b>passerelle</b> à la racine de votre serveur apache <br/>
<b>Rendre accessible en écriture le dossier</b> /passerelle/uploads/uploaded_files

Côté client

Configurer la partie serveur de l'application Android ODKcollect avec <br/>
URL <br/>
http://ipdevotreserveur/passerelle <br/>
Nom d'utilisateur <br/>
testA <br/>
Mot de passe <br/>
AAA <br/>

############# Fin de la Mise en place


Les transactions entre ODKcollect et le serveur sont opérationnelles.<br/>

Ce code traite <br/>
- la récupération des formulaires vierges<br/>
- la réception des formulaires complétés avec média rattachés (photo, signature, son...)<br/>
- les entrées en doublons si la connexion est réinitilisée par ODKcollect et les données renvoyées, en cas de connexion mauvaise, un exemple dans XFORMcrpBoucleComptage.php<br/>

Fonctionne autant en HTTP qu'en HTTPS, ODKcollect n'accepte que des certificats certifiés !<br/>
On peut utiliser des ports personnalisés pour le http ou https sans problèmes. (ex: 8080)<br/>
Je l'ai utilisé avec un certificat letsencrypt.org généré par certbot <br/>
source<br/>
https://howto.wared.fr/ubuntu-certificats-ssl-tls-certbot/


Remarques pour le démarrage :<br/>
php.ini<br/>
#pensez à paramétrer la taille de réception d'un fichier si vous récupérez des photos<br/>
post_max_size = 10M<br/>
upload_max_filesize = 30M<br/>
#pensez au temps de transfert, donc au temps que vous laissez à votre script pour effectuer l'opération<br/>
max_execution_time = 60

apache2<br/>
#pensez à interdire l'exécution de page php dans les dossiers de réception des fichiers reçus du clients ODKcollect<br/>
<DirectoryMatch "uploads/uploaded_files"><br/>
RemoveHandler all<br/>
RemoveType all<br/>
php_flag engine off<br/>
</DirectoryMatch>

#pensez à bien vérifier les réponses récupérées via les formulaires, si intégration dans une base de données<br/>
//exemple avec real_escape_string : Protège une commande SQL de la présence de caractères spéciaux<br/>
// $mysqli->real_escape_string($xml->ReponseQuestion);

//pour suivre les erreurs si rien ne fonctionne<br/>
shell# tail -f 10 /var/log/apache2/error.log
