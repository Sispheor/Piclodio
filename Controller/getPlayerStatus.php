<?php
include_once '../Model/Player.php';

if(Player::isStarted()){
    echo 1;
}else{
    echo 0;
}
    

?>
