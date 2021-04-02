<?php

require_once("../config.php");







//######
//######		ACTIVER pour DEBUG, attention : déplacer le ficher xml dans le dossier submission et lancer directement l'url de ce script pour rejouer le traitement
//######
//http://192.168.1.64/test/submission/XFORMcrpPiege.php
//$xml = simplexml_load_file('./LPS crp BoucleComptage_2021-04-02_09-05-59.xml');





//$URIvisite = (isset($xml->URIvisite) ? $xml->URIvisite : uniqid());
//Utile ici pour éviter les entrées traitées plusieurs fois, doublons
//car si le reéseau est faible, la connexion est réinitialiser et odk collect renvoi tous les formulaires
//il peut y avoir des bugs de traitement 2 fois, notamenent si il y a des photos ou des formulaires assez gros !!
$URIvisite = (isset($xml->URIvisite) ? $xml->URIvisite : '');


//Pensez au TRAITEMENT des valeurs reçues pour un futur imprt dans la base de données avec real_escape_string : Protège une commande SQL de la présence de caractères spéciaux
//$StartTime = (isset($xml->StartTime) ? $mysqli->real_escape_string($xml->StartTime) : '');

$StartTime = (isset($xml->StartTime) ? $xml->StartTime : '');
$EndTime = (isset($xml->EndTime) ? $xml->EndTime : '');

$Date = (isset($xml->date) ? $xml->date : '');
$Binome = (isset($xml->binome) ? $xml->binome : '');

foreach($xml->repeat_observation as $repeat_observation)
{	




	//$URIvisite = (isset($xml->URIvisite) ? $xml->URIvisite : uniqid());
	//Utile ici pour éviter les entrées traitées plusieurs fois, doublons
	//car si le reéseau est faible, la connexion est réinitialiser et odk collect renvoi tous les formulaires
	//il peut y avoir des bugs de traitement 2 fois, notamenent si il y a des photos ou des formulaires assez gros !!
	$URIobservation = (isset($repeat_observation->URIobservation) ? $repeat_observation->URIobservation : '');
	




	$IdPiege = (isset($repeat_observation->idpiege) ? $repeat_observation->idpiege : '');
	
	$NbreFemelle = (isset($repeat_observation->nbrefemmelle) ? $repeat_observation->nbrefemmelle : '');
	$NbreMale = (isset($repeat_observation->nbremale) ? $repeat_observation->nbremale : '');
	$NbreFemelleParasite = (isset($repeat_observation->nbrefemmelleparasite) ? $repeat_observation->nbrefemmelleparasite : '0');
	$NbreMaleParasite = (isset($repeat_observation->nbremaleparasite) ? $repeat_observation->nbremaleparasite : '0');
	$Note = (isset($repeat_observation->note) ? $repeat_observation->note : '');
	$Activite = (isset($repeat_observation->activite) ? $repeat_observation->activite : '');
	$Etat = (isset($repeat_observation->etat) ? $repeat_observation->etat : '');
	$RemarqueEtat = (isset($repeat_observation->remarqueetat) ? $repeat_observation->remarqueetat : '');
	$AutreInsecte = (isset($repeat_observation->autreinsecte) ? $repeat_observation->autreinsecte : '');
	
	
	$EtatPiegeSolRetourne = (isset($repeat_observation->etatpiegesolretourne) ? $repeat_observation->etatpiegesolretourne : '');
	$EtatPiegeSolCasse = (isset($repeat_observation->etatpiegesolcasse) ? $repeat_observation->etatpiegesolcasse : '');
	$EtatPiegeSuspenduTombe = (isset($repeat_observation->etatpiegesuspendutombe) ? $repeat_observation->etatpiegesuspendutombe : '');
	$EtatPiegeSuspenduCasse = (isset($repeat_observation->etatpiegesuspenducasse) ? $repeat_observation->etatpiegesuspenducasse : '');
	$EntretienRenouvellementEau = (isset($repeat_observation->entretienrenouvellementeau) ? $repeat_observation->entretienrenouvellementeau : '');
	$EntretienChangementPheromone = (isset($repeat_observation->entretienchangementpheromone) ? $repeat_observation->entretienchangementpheromone : '');
	$EntretienChangementKairomone = (isset($repeat_observation->entretienchangementkairomone) ? $repeat_observation->entretienchangementkairomone : '');
	$EntretienAjoutAttractif = (isset($repeat_observation->entretienajoutattractif) ? $repeat_observation->entretienajoutattractif : '');
	
	
	
	//Rechercher dans votre base si l'entrée avec cet URIobservation esxite !!!
	//$nodoublon = recherche_si_present($URIobservation, 'Champs', 'Table'); // fonction perso à faire chez vous
	$nodoublon = 0;
	
	if($nodoublon == '0')
	{	

		//ici traitemment de l'enregistrement dans la base du chemin d'accès à la photo

		

		//Pour debug, vérifier la lecture du xml	
		$FILE_H = fopen(FS_PATH."uploads/uploaded_files/errorLogOliv.txt", "a+");
		$message = "Code bien executé!!! $IdPiege - $URIobservation \n";
		fputs($FILE_H, $message);
		fclose($FILE_H);
	}


	
	
	

	
}


	
//Archiver le formulaire xml reçu "données sources"	
rename(FS_PATH."uploads/uploaded_files/".$xmlfileNameToArchive , FS_PATH."uploads/uploaded_files/XMLreceptionnerETtraiter/".$xmlfileNameToArchive);





?>