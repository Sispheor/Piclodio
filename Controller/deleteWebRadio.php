<?php
include_once '../DAO/URLmanager.php';
$name= $_POST["name"];
echo URLmanager::deleteWebRadio($name);

?>
