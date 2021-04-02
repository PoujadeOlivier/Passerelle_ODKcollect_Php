<?php

require("../config.php");
require("../util.php");

/*
//DEBUG
			$FILE_H = fopen(FS_PATH."uploads/uploaded_files/errorLogOliv.txt", "a+");
			$toto = "\n RECUP Arg GET : ".json_encode($_GET);
			$toto .="\n RECUP Arg POST : ".json_encode($_POST);
			$toto .="\n RECUP Arg REQUEST : ".json_encode($_REQUEST);
			$toto .="\n RECUP Arg SERVER : ".json_encode($_SERVER);
			$toto .="\n RECUP Arg FILES : ".json_encode($_FILES);

			fputs($FILE_H, $toto);
			fclose($FILE_H);
*/


//https://github.com/ken-muturi/php-odk/blob/master/submission/index.php
//http://www.laroeco.com/2016/Intercept-odk-collect-submissions/

/*
			$FILE_H = fopen(FS_PATH."uploads/uploaded_files/errorLogOliv.txt", "a+");
			$toto = "\n toto"." - ".serialize($_SERVER['PHP_AUTH_DIGEST']);
			fputs($FILE_H, $toto);
			fclose($FILE_H);
*/
$mediaStoreFolder = FS_PATH."uploads/uploaded_files/";

$deviceid = isset($_GET['deviceID']) ? $_GET['deviceID'] : false;





if (!empty($_FILES))
{

/// PROCESS THE $_FILES DATA HERE

}
else
{
	
	    if (empty($_SERVER['PHP_AUTH_DIGEST'])) { // before credentials
        http_response_code(401);
        header("HTTP/1.1 401 Unauthorized");
        header('Content-Type: text/xml; charset=utf-8');
				header('WWW-Authenticate: Digest realm="'. $realm .'",qop="auth",nonce="'.uniqid().'",opaque="'. md5($realm) .'"');
        header('HTTP_X_OPENROSA_VERSION:1.0');
        header('X-OpenRosa-Accept-Content-Length: 20000');
        header('Content-Length: 0');

				die('Canceled !');
		}
}





$filearray = array();
if( $_SERVER['REQUEST_METHOD'] === "HEAD" )
{
        header("Server: Apache-Coyote/1.1");
        header("X-OpenRosa-Version: 1.0");
        header("X-OpenRosa-Accept-Content-Length: 1048576000");


		$url =  Util::site_url('submission/');
		header("Location: $url",true,204);
		 
}
elseif( $_SERVER['REQUEST_METHOD'] === "POST" )
{




			$data = util::http_digest_parse($_SERVER['PHP_AUTH_DIGEST']);
//ici code de vérif identifiant odkcollecy, fonctionne en http, mais crash en https, il faut que je relise mon source
/*
			if (! $data || ! isset($users[ $data['username'] ]))
				die('Wrong Credentials!');


			// generate the valid response
			if ( ! util::check_user_pass($users) )
			die('Wrong Credentials!');			

*/
			


					http_response_code(201);
					$tmpname = $_FILES['xml_submission_file']['tmp_name'];
					$name = $_FILES['xml_submission_file']['name'];


					libxml_use_internal_errors(true);


				   if( ! file_exists($tmpname) )
					   $test = "XML not found";
					else
					   $test = "TOUT EST BON";




/*
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
*/	


					//2020 oliv : être sûr que le fichier est bien dans le dossier tmp, si réseau faible, échange trop long
					foreach( $_FILES as $file)
					{
						if($file['tmp_name'] == '')
						Util::printError("Connexion réseau trop faible", "522 Oliv : Connexion réseau trop faible pour transférer correctement le formulaire");
					}
			
			
			
			
					foreach( $_FILES as $file)
					{


					
						$file_name = FS_PATH.'uploads/uploaded_files/'. $file['name'];
						$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
						
						if($file_extension == 'xml')
						{
							$xml = simplexml_load_file($file['tmp_name']);

							$xmlfileNameToArchive = $file['name'];
						}

						
						
					//Pour debug, vérifier les xml qui sont traités et quand
					file_put_contents($mediaStoreFolder .'headers.txt', date('Y-m-d H:i:s')."Temp name : ".$file['tmp_name']."\n", FILE_APPEND);
					file_put_contents($mediaStoreFolder .'headers.txt', "Name : ".$file_name."\n", FILE_APPEND);						
						
					move_uploaded_file( $file['tmp_name'],  $file_name);
						
					

							

					}	
							

							
						//Enfin traitement du contenu du formulaire
						//afin d'enregistrer les valeurs dans une base de données
							$xmlDATA_idform = $xml->attributes()->id;

							
							if( strstr($xmlDATA_idform, 'CRP_Piege'))
							require_once './XFORMcrpPiege.php';
							else if( strstr($xmlDATA_idform, 'CRP_BoucleComptage'))
							require_once './XFORMcrpBoucleComptage.php';						
							else if( strstr($xmlDATA_idform, 'CRP_Comptage'))
							require_once './XFORMcrpComptage.php';
							else if( strstr($xmlDATA_idform, 'CRPphotopiege'))
							require_once './XFORMcrpPiegePhoto.php';

						
							

	}
?>
