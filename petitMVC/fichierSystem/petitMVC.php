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

/* alias du séparateur de dossier */
if(!defined('SD'))
{
    define('SD',SEPARATEUR_DOSSIER);
}


/* DECLARE LE DOSSIER DE L'APPLI */
if(!defined('PMVC_DOSSIER_APPLI'))
{
    define('PMVC_DOSSIER_APPLI', PMVC_BASEDIR . 'myapp' . DS);
}

/* set include_path for spl_autoload */
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
