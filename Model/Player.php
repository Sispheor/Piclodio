<?php
/**
 * Classe en charge de la gestion de l'audio
 *
 * @author Nico
 */
class Player {
    /**
     * Lance l'URL active
     */
    public static function play($url){
        // comande de lecture
        $cmd="sudo mplayer $url";
        // lancement de la lecture si pas déja lancé
        if (self::isStarted()){
            return "Lecteur déja lancé";
        }else{
            exec($cmd);
            return ("Play");
        }
       
    }
    
    /**
    * Test si le lecteur est deja lancé sur la machine
    * @return boolean
    */
   public static function isStarted(){
       // test du nombre de processus
       $cmd="sudo /usr/bin/pgrep mplayer";
       // execution
       exec($cmd, $output);
       if ($output ==null){
           return FALSE;
       }else{
           return TRUE;
       }
       
   }
   
   /**
    * Stop le lecteur
    */
   public static function stop(){
       $cmd="sudo /usr/bin/killall mplayer";
        // arret du lecteur si pas déja arreté
        if (self::isStarted()){
            exec($cmd);
            return ("Stop");
        }else{
            return "Lecteur déja arreté";
        }
       
   }
}

?>
