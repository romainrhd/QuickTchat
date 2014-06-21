<?php

/**
 * Fonction qui permet de créer la structure de la base de données
*/
function create_db($connexion, $file){
    $req='';
    $req=file_get_contents ($file);
    $req=str_replace("\n","",$req);
    $req=str_replace("\r","",$req);
    $connexion->exec($req);
}

/**
 * Fonction qui permet de récupérer les noms des tables d'une base de données
 */
function getTables($connexion){
    $req = $connexion->query("show tables");
    $tables = $req->fetchAll();
    return $tables;
}

?>