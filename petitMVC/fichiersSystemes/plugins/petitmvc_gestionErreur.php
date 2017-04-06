<?php

/////
//
// Nom : petitmvc_gestionErreur
// Auteur : Vincent
// Date dernière MAJ : 06/04/2017
// Description : Plugin gestion erreur
//
/////

// ------------------------------------------------------------------------

/**
 * PetitMVC_GestionErreur
 * 
 * A simple exception handler to display exceptions in a formatted box.
 *
 * @package		TinyMVC
 * @author		Monte Ohrt
 */
function PetitMVC_GestionErreur($errno, $errstr, $errfile, $errline) {
  // do nothing if error reporting is turned off
  if (error_reporting() === 0)
  {
    return;
  }
  // be sure received error is supposed to be reported
  if (error_reporting() & $errno)
  {   
		throw new TinyMVC_ExceptionHandler($errstr, $errno, $errno, $errfile, $errline);
  }
}

?>