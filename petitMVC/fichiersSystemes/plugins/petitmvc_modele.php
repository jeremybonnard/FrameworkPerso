<?php

/////
//
// Nom : petitmvc_modele
// Auteur : Vincent
// Date dernière MAJ : 06/04/2017
// Description : Plugin modèle
//
/////

// ------------------------------------------------------------------------

/**
 * PetitMVC_Modele
 *
 * @package		TinyMVC
 * @author		Monte Ohrt
 */

class PetitMVC_Modele
{
 	/**
	 * $db
	 *
	 * the database object instance
	 *
	 * @access	public
	 */
  var $db = null;  
    
 	/**
	 * class constructor
	 *
	 * @access	public
	 */
  function __construct($poolname=null) {
    $this->db = tmvc::instance()->controller->load->database($poolname);
  }
  
}

?>
