<?php

//////
//
//  Nom : petitMVC
//  Auteur : Jérémy
//  Date dernière MAJ : 06/04/2017
//  Description : Fichier d'initation de petitMVC
//
//////

if(!defined('PMVC_VERSION'))
{
	define('PMVC_VERSION','1.0.0');
}

// Déclare le dossier de l'appli
if(!defined('PMVC_DOSSIER_APPLI'))
{
	define('PMVC_DOSSIER_APPLI', PMVC_BASEDIR . 'mesApplis' . DS);
}

// set_include_path pour spl_autoload
set_include_path(get_include_path()
	. PATH_SEPARATOR . PMVC_DOSSIER_APPLI . 'controlleurs' . DS
	. PATH_SEPARATOR . PMVC_DOSSIER_APPLI . 'modeles' . DS
	. PATH_SEPARATOR . PMVC_DOSSIER_APPLI . 'configs' . DS
	. PATH_SEPARATOR . PMVC_DOSSIER_APPLI . 'plugins' . DS
	. PATH_SEPARATOR . PMVC_DOSSIER_APPLI . 'vues' . DS
	. PATH_SEPARATOR . PMVC_BASEDIR . 'mesFichiers' . DS . 'controlleurs' . DS
	. PATH_SEPARATOR . PMVC_BASEDIR . 'mesFichiers' . DS . 'mmodelesodels' . DS
	. PATH_SEPARATOR . PMVC_BASEDIR . 'mesFichiers' . DS . 'configs' . DS
	. PATH_SEPARATOR . PMVC_BASEDIR . 'mesFichiers' . DS . 'plugins' . DS
	. PATH_SEPARATOR . PMVC_BASEDIR . 'mesFichiers' . DS . 'vues' . DS
	. PATH_SEPARATOR . PMVC_BASEDIR . 'fichiersSystemes' . DS . 'controlleurs' . DS
	. PATH_SEPARATOR . PMVC_BASEDIR . 'fichiersSystemes' . DS . 'modeles' . DS
	. PATH_SEPARATOR . PMVC_BASEDIR . 'fichiersSystemes' . DS . 'configs' . DS
	. PATH_SEPARATOR . PMVC_BASEDIR . 'fichiersSystemes' . DS . 'plugins' . DS
	. PATH_SEPARATOR . PMVC_BASEDIR . 'fichiersSystemes' . DS . 'vues' . DS
);

// on met .php en premier pour une meilleur vitesse
spl_autoload_extensions('.php,.inc');

$spl_fonctions = spl_autoload_functions();
if($spl_fonctions === false)
{
	spl_autoload_register();
}
elseif(!in_array('spl_autoload',$spl_fonctions))
{
	spl_autoload_register('spl_autoload');
}

///////
//  pmvc
//
//  class main
//
///////

class pmvc
{
	//Attributs

	public $config = null;
	public $controlleur = null;
	public $action = null;
	public $path_info = null;
	public $url_segments = null;

	// Constructeur
	public function __construct($id='default')
	{
		self::instance($this,$id);
	}

	// Méthode lancement du main
	public function main()
	{
		self::timer('pmvc_app_depart');

		// MAJ path_info
		if(!empty($_SERVER['PATH_INFO']))
		{
			$this->path_info = $_SERVER['PATH_INFO'];
		}
		elseif(!empty($_SERVER['ORIG_PATH_INFO']))
		{
			$this->path_info = $_SERVER['ORIG_PATH_INFO'];
		}
		else
		{
			$this->path_info = '';
		}

		// Initialisation des erreurs
		$this->initErreur();

		// Ajout de la configs
		include('config_application.php');
		$this->config = $config;

		// configuration du routage
		$this->configRoutage();

		// découpage de l'url
		$this->decoupageElementsUrl();

		// Initialisation du controlleur
		$this->configControlleur();

		// Recuperation des action
		$this->configAction();

		// Lancement de l'autoloader
		$this->lancerAutoloaders();

		// on met en tampon si on utilise les timer
		if($this->config['timer'])
		{
			ob_start();
		}

		// On demande au controlleur de faire l'action
		$this->controlleur->{$this->action}();

		if($this->config['timer'])
		{
			$sortie = ob_get_contents();
			ob_end_clean();
			self::timer('pmvc_app_fin');
			// On met le timer.
			echo str_replace('{PMVC_TIMER}', sprintf('%0.5f',self::timer('pmvc_app_depart', 'pmvc_app_fin')), $sortie);
		}
	}

	public function initErreur()
	{
		if(defined('PMVC_ERREUR_GESTION') && PMVC_ERREUR_GESTION == 1)
		{
			set_exception_handler(array('petitMVC_Exception', 'gestionException'));
			require_once('petitmvc_erreur_gestion.php');
			set_error_handler('petitMVC_erreur_gestion');
		}
	}

	public function configRoutage()
	{
		if(!empty($this->config['routage']['recherche']) && !empty($this->config['routage']['remplace']))
		{
			$this->path_info = preg_replace( $this->config['routage']['recherche'], $this->config['routage']['remplace'], $this->path_info);
		}
	}

	public function decoupageElementsUrl()
	{
		if(!empty($this->path_info))
		{
			$this->segments_url = array_filter(explode('/', $this->path_info));
		}
		else
		{
			$this->segments_url = null;
		}
	}

	public function configControlleur()
	{
		if(!empty($this->config['root_controlleur']))
		{
			$nom_controlleur = $this->config['root_controlleur'];
			$fichier_controlleur = "{$nom_controlleur}.php";
		}
		else
		{
			$nom_controlleur = !empty($this->segments_url[1]) ? preg_replace('!\W!','',$this->segments_url[1]) : $this->config['controlleur_default'];
			$fichier_controlleur = "{$nom_controlleur}.php";
		}
	}

}
