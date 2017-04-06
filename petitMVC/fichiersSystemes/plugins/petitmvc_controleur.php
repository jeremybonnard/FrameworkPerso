<?php

/////
//
// Nom : petitmvc_controleur
// Auteur : Vincent
// Date dernière MAJ : 06/04/2017
// Description : Plugin contrôleur
//
/////

// ------------------------------------------------------------------------

/**
 * PetitMVC_Controleur
 *
 * @package   TinyMVC
 * @author    Monte Ohrt
 */

class PetitMVC_Controleur
{

	/**
	 * constructeur de classe
	 *
	 * @access  public
	 */
	function __construct()
	{
		/* sauvegarder l'instance du contrôleur */
		tmvc::instance($this,'controller');
	
		/* instantiate load library */
		$this->load = new TinyMVC_Load;  

		/* instantiate view library */
		$this->view = new TinyMVC_View;
	}
	
	/**
	 * index
	 *
	 * the default controller method
	 *
	 * @access  public
	 */    
	function index() { }

	/**
	 * __call
	 *
	 * gets called when an unspecified method is used
	 *
	 * @access  public
	 */    
	function __call($function, $args) {
	
		throw new Exception("Unknown controller method '{$function}'");

	}
	
}

?>
