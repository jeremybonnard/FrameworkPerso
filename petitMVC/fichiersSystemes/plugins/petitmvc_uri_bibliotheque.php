<?php

/////
//
// Nom : petitmvc_uri_bibliotheque
// Auteur : Vincent
// Date dernière MAJ : 06/04/2017
// Description : Plugin URI bibliotheque
//
/////

/***
 
 example usage: 
 
 $this->load->bibliotheque('uri');
 // gets third segment from URI
 $this->uri->segment(3);
 // get key/val associative array starting with the third segment
 $uri = $this->uri->uri_to_assoc(3);
 // assign params to an indexed array, starting with third segment
 $uri = $this->uri->uri_to_array(3);
 
 ***/

 

class PetitMVC_URI_Bibliotheque {
 
  var $path = null;
 
  function __construct()
  {
    $this->path = tmvc::instance()->url_segments;
  }
 
  function segment($index)
  {
    if(!empty($this->path[$index-1]))
      return $this->path[$index-1];
    else 
      return false;
  }
 
  function uri_to_assoc($index)
  {
    $assoc = array();
    for($x = count($this->path), $y=$index-1; $y<$x; $y+=2)
    {
      $assoc_idx = $this->path[$y];
      $assoc[$assoc_idx] = isset($this->path[$y+1]) ? $this->path[$y+1] : null;
    }
    return $assoc;
  }
 
  function uri_to_array($index=0)
  {
    if(is_array($this->path))
      return array_slice($this->path,$index);
    else
      return false;
  }
 
 
}

?>
