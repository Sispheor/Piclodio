<?php
include_once '../Model/WebRadio.php';

/**
 * Gestion des URL des webradios
 * Les web radio de l'utilisateur sont dans le fichier webRadio.ini à la racine du projet
 * Le manager s'occupe de la persistance des URLs
 * @author nico
 */
class URLmanager {
    
    /**
     * Sauvegarde une webRadio dans le fichier ini
     * @param WebRadio $webRadio La web radio a sauver
     */
    public static function save($webRadio){
        // sérialisation de l'objet
        $serialized_webradio = serialize($webRadio);
        $filename="../webRadio.txt";
        if(file_put_contents($filename, $serialized_webradio."\n",FILE_APPEND)!=FALSE){
            return 1;
        }else{
            return 0;
        }
            
    }  
    
    /**
     * Retourne un tableau d'objet WebRadio
     * @return array
     */
    public static function load(){
        // creation d'un tableau d'objet webRadio à retourner
        $tabWebRadio=   array();
        $webRadio=      array();
        $filename="../webRadio.txt";
        // ouverture du fichier
        if (file_exists($filename)) { 
            $datain = file_get_contents($filename);
            $lines = explode("\n", $datain);
            
            $count = count($lines);
            
            for ($i = 0; $i < $count; $i++){
               $webRadio = unserialize($lines[$i]);
               if ($webRadio){
                   /* @var $webRadio WebRadio */
                   
                    // construction de l'objet json
                   $arr= array(
                    "id" =>        $i,  // ligne dans le fichier
                    "nom" =>       $webRadio->getNom(),
                    "url" =>       $webRadio->getUrl(),
                    );
                   array_push($tabWebRadio, $arr);
                    
               }
              
            }
            
            // retour du tableau
            return $tabWebRadio;
        }else{
            //creation du fichier
            $fp = fopen($filename,"w");  
            fwrite($fp,"");  
            fclose($fp);
            return $tabWebRadio;
        }
    }
    
   
    /**
     * Retourne l'url de la ligne dans le fichier des Web Radios
     * @param int $numLine
     */
    public static function setURLActive($numLine){
        //****************************************************
        // récupération de l'url dans le fichier à la ligne numLIne
        //****************************************************
        $url="http://provisioning.streamtheworld.com/pls/KSEGFM.pls";    // une url par défaut au cas ou
        $filename="../webRadio.txt";
        $datain = file_get_contents($filename);
        // ouverture du fichier
        if (file_exists($filename)){ 
            $lines = explode("\n", $datain);
            $webRadio = $lines[$numLine];
            
        }
        //****************************************************
        //  Enregistrement dans le fichier de l'url active
        //****************************************************
        $filename="../urlActive.txt";
        if(file_put_contents($filename, $webRadio) >0){
            return 1;   // retour 1 si ok
        }else{
            return 0;
        }
    }
    
    public static function getURLactive(){
        $filename="../urlActive.txt";
        if (file_exists($filename)) { 
            $urlActive= file_get_contents($filename);
            $urlActive=unserialize($urlActive);
            
            if(is_object($urlActive)) {
                $arr= array(
                "id" =>        "1",  // ligne dans le fichier
                "nom" =>       $urlActive->getNom(),
                "url" =>       $urlActive->getUrl(),
                );
                
            }else{
                $arr= array(
                "id" =>        "1",  // ligne dans le fichier
                "nom" =>       "Aucune radio active",
                "url" =>       "",
                );
            }
            
        }else{
            // creation du fichier
            $fp = fopen($filename,"w");  
            fwrite($fp,"");  
            fclose($fp);
            $arr= array(
                "id" =>        "1",  // ligne dans le fichier
                "nom" =>       "Aucune radio active",
                "url" =>       "",
                );
        }
        // retour du tab
        return $arr;
    }
    
    public static function deleteWebRadio($numLine){
        // recup des web radios actuel
        $tabWebRadio=  self::load();
        //rez du fichier
        self::rezWebRadioFile();
        $i = 0; //compteur de ligne
        foreach($tabWebRadio as $radio){
            if ($i !=$numLine ){ // si la ligne corespond pas à celle que l'on ne garde pas
                $newWebRadio = new WebRadio($radio["nom"], $radio["url"]);
                self::save($newWebRadio);// alors l'objet radio est sauvé dans le fichier
            }else{
                // On est sur la radio qui va être supprimée. il faut tester si c'est aussi l'url active
                $urlactive= self::getURLactive();
                if($urlactive["url"]==$radio["url"]){// suppression si identique
                    self::rezUrlActiveFile();
                }
            }
            $i++;
        }
        return 1; 
    }
    
    public static function rezWebRadioFile(){
        $filename="../webRadio.txt";
        $fp = fopen($filename,"w");  
        fwrite($fp,"");  
        fclose($fp);
    }
    
    public static function rezUrlActiveFile(){
        $filename="../urlActive.txt";
        $fp = fopen($filename,"w");  
        fwrite($fp,"");  
        fclose($fp);
    }
            
}
       
?>
