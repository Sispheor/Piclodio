<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0 " charset=UTF-8>
        <title>RaspWakeFile</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
        <script src="../Controller/controller.js"></script>
        
    </head>
    <body  >
         <div data-role="page" id="manageRadio"> 
             <div data-role="content">
                <script type="text/javascript" >
                   $("#manageRadio").on('pageinit', function(){
                        refreshListWebRadio();
                    });
               </script>
               <!-- Popup -->
               <div data-role="popup" id="message" class="ui-content"></div>
               <!-- Bouton retour -->
              <a href="../index.php" data-role="button" data-icon="arrow-l" data-iconpos="left" data-inline="true">Retour</a>
               <!-- Bouton ajouter -->
              <a href="#popupNewRadio" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-icon="plus" data-theme="a" data-transition="pop">Ajouter</a>
                <!--Popup -->
                <div data-role="popup" id="popupMenu" data-theme="c" style="width: 250px">
                      <div data-role="popup" id="popupNewRadio" data-theme="c" class="ui-corner-all" style="width: 250px">
                          <form>
                              <div style="padding:10px 20px;">
                                <label for="un" class="ui-hidden-accessible">Nom affiché</label>
                                <input type="text"  id="nomRadio" value="" placeholder="Nom affiché" data-theme="a">
                                <label for="pw" class="ui-hidden-accessible">URL</label>
                                <input type="text"  id="urlRadio" value="" placeholder="URL" data-theme="a">
                                <p>
                                   <a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">Annuler</a>
                                   <button onClick="addNewRadio();" data-inline="true" data-theme="b" >Ajouter</button>
                                </p>   
                              </div>
                         </form>
                      </div>
                  </div>

               <!-- liste des radios enregistrée -->
               <ul data-role="listview" data-split-icon="delete" data-split-theme="d" data-inset="true" id="listViewWebRadio">
               </ul>
        
        </div>     
      </div>
        
    </body>
</html>
