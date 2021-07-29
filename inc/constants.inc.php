<?php
//Active la gestion des erreurs
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/*Selon la structure d'accueil de l'appli,
on adapte les constantes de connexion à la BDD*/

switch ($_SERVER['HTTP_HOST']) {
    case 'localhost':
        define('HOST', 'localhost');
        define('PORT', 3306);
        define('DATA', 'greta60');
        define('USER', 'root');
        define('PASS', '');
        break;
    case 'baobab-svr5': // Fictif
        define('HOST', 'baobab-svr5');
        define('DATA', 'baobab-sql5');
        define('USER', 'baobab-usr1');
        define('PASS', 'aR5*hgt+7uIopp$');
        break;
    default:
        // do nothing
}

//echo HOST;

/*
LOCAL
host:localhost
dname:greta60
user: root
pass:root

REMOTE
host:baobab-svr5
dname: baobab-sql5
user: baobab_usr1
pass:aR5*hgt+7uIopp$
*/

?>