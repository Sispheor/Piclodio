<?php
include_once '../Model/Player.php';
include_once '../DAO/URLmanager.php';
// récupération de l'url active
$webRadio=  URLmanager::getURLactive();
// siretour 0 alors pas d'URL active
if ($webRadio["nom"]=="Aucune radio active"){
    echo "Aucune URL active";
}else{
    // test de l'url. Suivant l'extension le lancement du player change
    $url = $webRadio["url"];
    $explode_url= explode(".", $url);
    $count= sizeof($explode_url);
    $extension= $explode_url[$count-1];

    switch ($extension){
     case "mp3":
         echo Player::play($url." > /dev/null 2>/dev/null &");
         break;
     case "pls";
         echo Player::play("-playlist ".$url." > /dev/null 2>/dev/null &");
    }
}


?>
