<?php

include_once '../DAO/URLmanager.php';

echo json_encode(URLmanager::getURLactive());
?>
