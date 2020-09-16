<?php

$host = "localhost";
$dbname = "a11"; // to adapt
$login = "root";
$mdp = "";

/**
 * try connection
 * catch and display the error and stop process
 */
try{
    $db = new PDO(
        'mysql:host='.$host.';dbname='.$dbname.';charset=UTF8',
        $login,
        $mdp
    );
    // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
    die('Erreur:'.$e->getMessage());
}
