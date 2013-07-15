<?php

/**
 * Description of URL
 *
 * @author nico
 */
class WebRadio {
    //*********************
    //  Variables
    //*********************
    public $nom;       // nom donnée par l'utilisateur
    public $url;       // url de la webradio
    
    //*********************
    //  Contructeur
    //*********************
    function __construct($nom, $url) {
        $this->nom = $nom;
        $this->url = $url;
    }
    
    //*********************
    //  Getter et setter
    //*********************
    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }



    
        
}

?>
