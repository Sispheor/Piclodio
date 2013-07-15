<?php

include_once '../Model/WebRadio.php';
include_once '../DAO/URLmanager.php';

$tab = URLmanager::load();
//envoi en json au client
echo json_encode(($tab));
?>
