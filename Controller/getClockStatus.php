<?php
include_once '../DAO/CrontabManager.php';

echo json_encode(CrontabManager::getCronStatus());

?>
