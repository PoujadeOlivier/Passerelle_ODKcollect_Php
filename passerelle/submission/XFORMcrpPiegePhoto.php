<?php

require_once("../config.php");






//######
//######		ACTIVER pour DEBUG, attention : déplacer le ficher xml dans le dossier submission et lancer directement l'url de ce script pour rejouer le traitement
//######
//$xml = simplexml_load_file('./LPS crp photopiege_2021-04-02_09-06-45.xml');



//Pensez au TRAITEMENT des valeurs reçues pour un futur imprt dans la base de données avec real_escape_string : Protège une commande SQL de la présence de caractères spéciaux


$StartTime = (isset($xml->StartTime) ? $xml->StartTime : '');
$EndTime = (isset($xml->EndTime) ? $xml->EndTime : '');



$binome = (isset($xml->binome) ? $xml->binome : '');
$date = (isset($xml->date) ? $xml->date : '');
$idpiege = (isset($xml->idpiege) ? $xml->idpiege : '');
$remarque = (isset($xml->remarque) ? $xml->remarque : '');
$photo = (isset($xml->photo) ? $xml->photo : '');






	//Pour debug, vérifier la lecture du xml
	$FILE_H = fopen(FS_PATH."uploads/uploaded_files/errorLogOliv.txt", "a+");
	$message = "Code bien executé!!! $binome \n";
	fputs($FILE_H, $message);
	fclose($FILE_H);



// Normalement obligatoire dans le formulaire, on n'enregistre cette entrée QUE si il y a la photo,
// puisque c'est seulement un formulaire photo
if($photo != '')
{

	//id de l'entree dans votre base sql par exemple
	$id_filesql = 'monid';

	$path_et_filename = FS_PATH.'uploads/uploaded_files/'.$photo;
	//où vous souhaitez stocker les photos, le dossier doit être autoriser en écriture
	$newpath_et_newfilename = FS_PATH."uploads/uploaded_files/Photo/".$id_filesql."_".$photo;	
	if(rename ($path_et_filename,$newpath_et_newfilename))
	{ 
		//ici traitemment de l'enregistrement dans la base du chemin d'accès à la photo
	}
	else
	{
		$message = "\n ".date('Y-m-d H:i:s')." Le fichier ".FS_PATH."uploads/uploaded_files/Photo/".$id_filesql ."_". $photo." n'a pu être créé..";
		$FILE_H = fopen(FS_PATH."uploads/uploaded_files/errorLogOliv.txt", "a+");
		fputs($FILE_H, $message);
		fclose($FILE_H);	
	}
}

 



	
//Archiver le formulaire xml reçu "données sources"
rename(FS_PATH."uploads/uploaded_files/".$xmlfileNameToArchive , FS_PATH."uploads/uploaded_files/XMLreceptionnerETtraiter/".$xmlfileNameToArchive);



?>