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

define ('BASE_URL', 'http://' . str_replace('//', '/', $_SERVER['SERVER_NAME'] . '/' . BASE_DIR));

?>