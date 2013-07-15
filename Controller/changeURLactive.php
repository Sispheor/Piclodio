<?php
include_once '../Model/WebRadio.php';
include_once '../DAO/URLmanager.php';
// id de la web radio
$id=$_POST['id'];
echo URLmanager::setURLActive($id);

?>
