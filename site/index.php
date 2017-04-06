<?php

/////
//
//  Nom : index
//  Auteur : Vincent
//  Date dernière MAJ : 06/04/2017
//  Description : Index du site
//
/////

// Demander à PHP d'afficher toutes les erreurs :
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// + ne pas oublier de définir "display_errors = on" dans son "php.ini".

// Alias du séparateur de dossiers
if(!defined('DS'))
  define('DS',DIRECTORY_SEPARATOR);

// Définition du dossier base
if(!defined('PMVC_BASEDIR')) {
	define('PMVC_BASEDIR',dirname(__FILE__) . DS . '..' . DS . 'petitMVC' . DS);
}


// Inclure la classe pmvc principale
require(PMVC_BASEDIR . 'fichiersSystemes' . DS . 'petitMVC.php');

// Instanciation puis exécution de la méthode main
$pmvc = new pmvc();
$pmvc->main();

?>