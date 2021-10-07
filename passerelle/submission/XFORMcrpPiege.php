<?php

require_once("../config.php");





//######
//######		ACTIVER pour DEBUG, attention : déplacer le ficher xml dans le dossier submission et lancer directement l'url de ce script pour rejouer le traitement
//######
//http://ipduserveur/passerelle/submission/XFORMcrpPiege.php
//$xml = simplexml_load_file('./LPS crp Piege_2021-04-02_09-06-31.xml');


//$attribut_balise = $xml->attributes();
//echo $attribut_balise['id'];









//Pensez au TRAITEMENT des valeurs reçues pour un futur imprt dans la base de données avec real_escape_string : Protège une commande SQL de la présence de caractères spéciaux
//$StartTime = (isset($xml->StartTime) ? $mysqli->real_escape_string($xml->StartTime) : '');


$StartTime = (isset($xml->StartTime) ?$xml->StartTime : '');
$EndTime = (isset($xml->EndTime) ?$xml->EndTime : '');
$Binome = (isset($xml->binome) ?$xml->binome : '');


$gps_select = (isset($xml->gps_select) ?$xml->gps_select : '');
$latitude = (isset($xml->latitude) ?$xml->latitude : '');
$longitude = (isset($xml->longitude) ?$xml->longitude : '');
$locationMap = (isset($xml->locationMap) ?$xml->locationMap : '');


$DatePose = (isset($xml->datepose) ?$xml->datepose : '');
$Nom = (isset($xml->nom) ?$xml->nom : '');
$Type = (isset($xml->type) ?$xml->type : '');
$Pheromone = (isset($xml->pheromone) ?$xml->pheromone : '');
$Kairomone = (isset($xml->kairomone) ?$xml->kairomone : '');
$Additif = (isset($xml->additif) ?$xml->additif : '');
$Adresse = (isset($xml->adresse) ?$xml->adresse : '');
$Remarque = (isset($xml->remarque) ?$xml->remarque : '');
$Support = (isset($xml->support) ?$xml->support : '');
$Hauteur = (isset($xml->hauteur) ?$xml->hauteur : '');
$Actif = (isset($xml->actif) ?$xml->actif : '');






		switch ($gps_select)
		{
			//case 'GpsGarmin':
				//echo "GpsGarmin";
				//ne rien faire;
			//	break;
			case 'GpsEtCarte':
				//echo "GpsEtCarte";
				$EXPLODElocationMap = explode(" ", $locationMap);
				$latitude = $EXPLODElocationMap['0'];
				$longitude = $EXPLODElocationMap['1'];
				//$LOCATION_MAP_ALT = $EXPLODElocationMap['2'];
				//$LOCATION_MAP_ACC = $EXPLODElocationMap['3'];
				break;		}	
		$latitude = round($latitude,5);
		$longitude = round($longitude,5);








	//Pour debug, vérifier la lecture du xml
	$FILE_H = fopen(FS_PATH."uploads/uploaded_files/errorLogOliv.txt", "a+");
	$message = "Code bien executé!!! $Nom \n";
	fputs($FILE_H, $message);
	fclose($FILE_H);



	//ici traitemment de l'enregistrement dans la base du chemin d'accès à la photo

	
//Archiver le formulaire xml reçu "données sources"
rename(FS_PATH."uploads/uploaded_files/".$xmlfileNameToArchive , FS_PATH."uploads/uploaded_files/XMLreceptionnerETtraiter/".$xmlfileNameToArchive);





?>
