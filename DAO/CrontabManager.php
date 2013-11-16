<?php

/**
 * Gestion de la crontab pour ajouter un réveil
 *
 * @author nico
 */
class CrontabManager {
    /**
     * Mise en place d'une ligne dans le crontab pour lancer la webRadio
     * @param type $heure   Heure du réveil
     * @param type $minute  Minute du réveil
     */
    public static function setClockAlarm($heure,$minute, $cron){
                
        file_put_contents('../crontab.txt', $cron.PHP_EOL);

        exec('crontab ../crontab.txt',$out,$return_var);
        
        //return $return_var; // 0 si ok
        if($return_var==0){
            return "Alarme activée";
        }else{
            return "Erreur";
        }
        
    }
    
    /**
     * Suppression de la webRadio dans le cronTab
     */
    public static function deleteClockAlarm(){
        exec('crontab -r',$out,$return_var);
        //return $return_var;      // 0 si ok         
        if($return_var==0){
            return "Alarme désactivé";
        }else{
            return "Erreur";
        }
    }
    
    public static function getCronStatus(){
        exec('crontab -l 2>&1', $out);
        $crontab= $out[0];
        if ($crontab=="no crontab for www-data"){
            $minute=0;
            $heure=0;
            $action="off";
	    $url="off";
            $nom="off";

        }else{
            $explode_out=explode(" ", $crontab);
	    $total_token=count($explode_out);
            $minute= $explode_out[0];
            $heure= $explode_out[1];
            $action="on";
	    $url = $explode_out[$total_token-2];
	    $nom = substr($explode_out[$total_token-1],1);
        }

        $tab_return=array(
                "minute"    => $minute,
                "heure"     => $heure,
                "action"    => $action,
		"url" => $url,
		"nom" => $nom,
            );
        return $tab_return;
    }
}

?>
