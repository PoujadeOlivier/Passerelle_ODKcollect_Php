<?php


    $realm = 'Passerelle ODK Aggregate';
    $users = [
        'testA' => 'AAA',
        'testB' => 'BBB'
    ];

preg_match_all("/\/([^\/]+)\//i", $_SERVER['REQUEST_URI'], $match);

define('REQUEST_URI', $_SERVER['REQUEST_URI']);

define('BASE_DIR', $match[1][0] . '/');

define ('FS_PATH', str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'] . '/' . BASE_DIR));

//Olivier traitement si port non standard
//define ('BASE_URL', 'http://' . str_replace('//', '/', $_SERVER['SERVER_NAME'] . '/' . BASE_DIR));
//devient

$olivPORT = ( ($_SERVER['SERVER_PORT'] != '80') && ($_SERVER['SERVER_PORT'] != '443') ? ":".$_SERVER['SERVER_PORT'] : '');
$olivHTTP = ( $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://');
define ('BASE_URL', $olivHTTP . str_replace('//', '/', $_SERVER['SERVER_NAME']. $olivPORT . '/' . BASE_DIR));

?>
