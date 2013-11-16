<?php
include_once '../Model/WebRadio.php';
include_once '../DAO/URLmanager.php';

$url=   $_POST["url"];
$nom=   $_POST["nom"];
//$url= "www.test.com";
//$nom=   "blabla";

// creation de la webRadio
$webradio = array("nom" => $nom, "url" => $url);
// sauvegarde
echo URLmanager::save($webradio);


?>
