<?php
include_once '../DAO/URLmanager.php';
$id= $_POST["id"];
echo URLmanager::deleteWebRadio($id);

?>
