<?php
include_once '../DAO/URLmanager.php';
include_once '../DAO/CrontabManager.php';

// récup des variables
$heure=     $_POST["heure"];
$minute=    $_POST["minute"];
$action=    $_POST["action"];

// suivant si c'est on ou off l'action n'est pas la même

// préaration de la commande cron
$cron =$minute." ".$heure." * * * ";
switch ($action){
 case "on":
        $webRadio=  URLmanager::getURLactive();
        // test de l'url. Suivant l'extension le lancement du player change
        $url = $webRadio["url"];
        $explode_url= explode(".", $url);
        $count= sizeof($explode_url);
        $extension= $explode_url[$count-1];

        switch ($extension){
         case "mp3":
             $cron.= "sudo mplayer ". $url;
             break;
         case "pls":
             $cron.= "sudo mplayer -playlist ". $url; 
             break;
         default :
             $cron.= "sudo mplayer ". $url;
             break;
             
        }

        echo CrontabManager::setClockAlarm($heure, $minute,$cron);
     break;
 case "off":
        echo CrontabManager::deleteClockAlarm();
     break;
}



?>
