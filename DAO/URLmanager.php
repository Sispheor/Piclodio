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
        $filename="../webRadios.json";
	$webRadios = json_decode(file_get_contents($filename),true);
	$webRadios[$webRadio["nom"]] = array("url" => $webRadio["url"]);
        if(file_put_contents($filename, json_encode($webRadios))){
            return 1;
        }else{
            return 0;
        }
            
    }    

    public static function load(){
        // creation d'un tableau d'objet webRadio à retourner
        $tabWebRadio=   array();
        $filename="../webRadios.json";
        // ouverture du fichier
        if (file_exists($filename)) { 
            $datain = json_decode(file_get_contents($filename),true);
	    foreach($datain as $name => $data){
		$webradio = array ("nom" => $name, "url" => $data['url']);
		$tabWebRadio[]=$webradio;
		}
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
    public static function setURLActive($nom){
        //****************************************************
        // récupération de l'url dans le fichier à la ligne numLIne
        //****************************************************
        $url="http://provisioning.streamtheworld.com/pls/KSEGFM.pls";    // une url par défaut au cas ou
        $filename="../webRadios.json";
        $datain = file_get_contents($filename);
	$webRadios = json_decode($datain,true);
        // ouverture du fichier
        if (file_exists($filename)){ 
            $webRadio[$nom] = $webRadios[$nom];
        }
        //****************************************************
        //  Enregistrement dans le fichier de l'url active
        //****************************************************
        $filename="../urlActive.txt";
        if(file_put_contents($filename, json_encode($webRadio)) >0){
            return 1;   // retour 1 si ok
        }else{
            return 0;
        }
    }
    
    public static function getURLactive(){
        $filename="../urlActive.txt";
        if (file_exists($filename)) { 
            $webRadios= json_decode(file_get_contents($filename),true);
		reset($webRadios);
            $urlActive["nom"]=key($webRadios); 
            $urlActive["url"]=reset($webRadios)["url"];
        }else{
		$urlActive="aucune";
        }
        // retour du tab
        return $urlActive;
    }
    
    public static function deleteWebRadio($nom){
        // recup des web radios actuel
        $tabWebRadio=  self::load();
        //rez du fichier
        self::rezWebRadioFile();
	
	unset($tabWebradio[$nom]);
        $filename="../webRadios.json";
        if(file_put_contents($filename, json_encode($tabWebRadio))){
            return 1;
        }else{
            return 0;
        }
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
