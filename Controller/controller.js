
/**
 * Affiche un message sur l'interface client
 * @param message le message a afficher au client
 */
function message(message){
    // set message
    $("#message").html(message);
    // affiche
    $( "#message" ).popup( "open" );
    // efface le message apres 3 secondes
    var t = setTimeout("$(\"#message\").popup( \"close\" );",3000);
}

/**
 * Demande de mise en marche du lecteur
 * @returns message
 */
function play(){
    // appel au serveur
    $.ajax({
        type: "POST",               
        url: "Controller/play.php",
        success: function(msg){ 
            message(msg);
            if(msg=="Aucune URL active"){
                $( "#radio-choice-h-2a" ).prop( "checked", false ).checkboxradio( "refresh" );
                $( "#radio-choice-h-2b" ).prop( "checked", true ).checkboxradio( "refresh" );
            }
        }    
    });
}
/**
 * Demande a stoper l'audio
 * @returns message
 */
function stop(){
    // appel au serveur
    $.ajax({
        type: "POST",               
        url: "Controller/stop.php",
        success: function(msg){  
            message(msg);
        }    
    });
}

/**
 * Récup la liste des web radios enregistrée sur le serveur
 * @returns array Liste des web radio enregistrée sur le serveur
 */
function getListWebRadio(){
    var tabWebRadio;
    // appel au serveur
    $.ajax({
        type: "POST",               
        url: "../Controller/getListWebRadio.php",
        dataType: 'json',
        async: false,
        success: function(tab){  
            tabWebRadio=tab;
        }    
    });
    // retour du tableau
    return tabWebRadio;
}

function deleteWebRadio(name){
    $.ajax({
        type: "POST",               
        url: "../Controller/deleteWebRadio.php",
        data:"name="+name,
        success: function(msg){ 
            if(msg=="1"){
                refreshListWebRadio();
                message("Web Radio supprimée");
            }else{
                message("Erreur");
            }
        }    
    });
}

/**
* Récup de la liste des webRadio enregistrées sur le serveur et affiche au client
*/
function refreshListWebRadio(){
   // on vide la list avant de la rafraichir
    $("#listViewWebRadio li").remove();
   var tabWebRadio= getListWebRadio();
   // ajout de chaque objet dans la vue
   for(var i= 0; i < tabWebRadio.length; i++){
       $("#listViewWebRadio").append("<li><a onClick=\"setRadioActive('"+tabWebRadio[i].nom+"')\"><h2>"+tabWebRadio[i].nom+"</h2>\
                 <a onClick=\"deleteWebRadio("+tabWebRadio[i].nom+")\" data-rel=\"popup\" data-position-to=\"window\" data-transition=\"pop\">Supprimer</a>\
             </li>\
       ");
   }   
   // rafraichissement de la liste
   $("#listViewWebRadio").listview("refresh");
};

function updateTimer(){
    $.ajax({
    type: 'POST',
    url: 'Controller/datetime.php',
    timeout: 10000,
    success: function(data) {
       $("#timer").html(data); 
      // window.setTimeout(updateTimer(), 100000);
    }
   });
  
}
/**
*   Change la radio active sur le serveur. Met à jour la vue du client
* @param {type} id
*  */
function setRadioActive(id){
    $.ajax({
        type: 'POST',
        url: '../Controller/changeURLactive.php',
        data: 'id='+id,
        success: function(data) {
           if(data ==1){
               // retour page acceuil
               document.location.href="../index.php";
           }
        }
   });
}
/**
 * Initialise la page d'index de l'utilisateur en fonction de l'état du serveur
 * va récupérer l'état:
 * - reveil (on ou off)
 * - heure du reveil
 * - L'url active (nom de la web radio)
 * - état du lecteur (lancé ou non)
 */
function initIndexPage(){
    // recup URL Active
    $.ajax({
        type: 'POST',
        url: 'Controller/getURLactive.php',
        dataType: 'json',
        success: function(data) {
           document.getElementById("ButtonCurentRadio").innerHTML=data.nom;
        }
   });
   
   // recup de l'état du lecteur audio
   $.ajax({
        type: 'POST',
        url: 'Controller/getPlayerStatus.php',
        success: function(data) {
           if(data==1){
               // player lancé
               $( "#radio-choice-h-2a" ).prop( "checked", true ).checkboxradio( "refresh" );
               $( "#radio-choice-h-2b" ).prop( "checked", false ).checkboxradio( "refresh" );
           }else{
               $( "#radio-choice-h-2a" ).prop( "checked", false ).checkboxradio( "refresh" );
               $( "#radio-choice-h-2b" ).prop( "checked", true ).checkboxradio( "refresh" );
           }
        }
   });
   
   // etat du reveil
   $.ajax({
        type: 'POST',
        url: 'Controller/getClockStatus.php',
        dataType: 'json',
        success: function(tab) {
           // modif bouton on off reveil
           $( "#slider2" ).val(tab.action);
           $( "#slider2" ).slider('refresh');
           
           // modif heure
           var myselect = $("#select-heure");
           myselect[0].selectedIndex = tab.heure;
           myselect.selectmenu("refresh"); 
           
           // modif minute
           var myselect = $("#select-minute");
           myselect[0].selectedIndex = tab.minute;
           myselect.selectmenu("refresh"); 

           $("#radiocron").html(tab.nom+"("+tab.url+")");
	   
           
        }
   });
   
}

function addNewRadio(){
    // recup des informations saisies pas l'user
    var nomRadio= document.getElementById("nomRadio").value;
    var urlRadio= document.getElementById("urlRadio").value;
    // envoi au serveur
    $.ajax({
        type: 'POST',
        url: '../Controller/addNewWebRadio.php',
        data: 'url='+urlRadio+'&nom='+nomRadio,
        async:false,
        success: function(msg){
           if(msg=="1"){
                refreshListWebRadio();
           }
           
        }
   });
}

/**
 * Fonction appelé en cas de changement d'état du réveil
 * @param {type} objet L'objet select
 */
function ActionSelectClock(objet){
    // recup heure
    var active_selected=document.getElementById("select-heure");
    var heure=  active_selected.options[active_selected.selectedIndex].value;
    // recup minute
    active_selected=document.getElementById("select-minute");
    var minute=  active_selected.options[active_selected.selectedIndex].value;
    // recup action
    var action = objet.value;
    // envoi au serveur
    $.ajax({
        type: 'POST',
        url: 'Controller/setClockAlarm.php',
        data:'heure='+heure+'&minute='+minute+'&action='+action,
        success: function(msg) {
           message(msg);
        }
   });
    
}

