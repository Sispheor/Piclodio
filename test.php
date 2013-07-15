<?php

// test du nombre de processus
       $cmd="sudo /usr/bin/pgrep mplayer";
       // execution
       exec($cmd, $output);
       if ($output ==null){
           echo "vide";
       }elseif (sizeof($output)>0) {
           echo "lancé";
       }
      
       
        
?>
