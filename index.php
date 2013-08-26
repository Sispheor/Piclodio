<!DOCTYPE html>
<html>
    <head>
        <!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0 " charset=UTF-8>
        <title>PiClockRadio</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
        <script src="Controller/controller.js"></script>
        <script type="text/javascript" >
          $(document).on('pageshow', function(){
                updateTimer();
                initIndexPage();
          });
        </script> 
    </head>
    <body  >
         <div data-role="page"  id="index"> 
             <div data-role="content">
                <!-- Popup -->
                <div data-role="popup" id="message" class="ui-content"></div>
                
               <!-- Reveil -->
                <ul data-role="listview" data-inset="true" data-divider-theme="d">
                    <li data-role="list-divider">Réveil</li>
                    <li style="text-align: center">
                        <!-- Activation du reveil -->
                        <select name="slider2" id="slider2" data-role="slider" onchange="ActionSelectClock(this)" >
                            <option value="off">Off</option>
                            <option value="on">On</option>
                        </select>
                    </li>
                    <li style="text-align: center">
                        <!-- Reglage heure reveil -->
                        <fieldset data-role="controlgroup" data-type="horizontal">
                            <select name="select-native-1" id="select-heure">
                                <?php for ($i =0; $i<24 ;$i++){
                                    if($i<10){
                                        $j="0".$i;
                                    }else{
                                        $j=$i;
                                    }
                                    echo "<option value=$i>$j</option>";
                                }
                                ?>

                            </select>
                            <select name="select-native-1" id="select-minute">
                                <?php for ($i =0; $i<60 ;$i++){
                                    if($i<10){
                                        $j="0".$i;
                                    }else{
                                        $j=$i;
                                    }
                                    echo "<option value=$i>$j</option>";
                                }
                                ?>

                            </select>
                       </fieldset> 
                    </li>
                </ul>

                <ul data-role="listview" data-inset="true" data-divider-theme="d">
                    <li data-role="list-divider">Radio</li>
                    <li>
                        <a  id="ButtonCurentRadio" href="views/ManageRadio.php" data-role="button" data-mini="true" data-icon="gear">Aucune radio</a>
                    </li>

                    <!-- Boutton play et stop -->
                    <li data-role="controlgroup" data-type="horizontal" style="text-align: center">
                        <input type="radio" name="radio-choice-h-2" onClick="play();" id="radio-choice-h-2a" value="on" >
                        <label for="radio-choice-h-2a" >Play</label>
                        <input type="radio" name="radio-choice-h-2" onClick="stop();" id="radio-choice-h-2b" value="off"  checked="checked">
                        <label for="radio-choice-h-2b" >Stop</label>
                    </li>

                </ul>

                <ul data-role="listview" data-inset="true" data-divider-theme="d">
                    <li data-role="list-divider">Heure Raspberry</li>
                    <li>
                        <h3 style="text-align: center" ><div id="timer" onClick="updateTimer();"> </div></h3>
                    </li>
                </ul>
             </div> 
            
        </div>
    </body>
</html>
