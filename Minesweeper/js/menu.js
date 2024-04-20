//se si esegue il refresh della pagina, il valore del radio button viene resettato alla difficoltà "facile", 
//altrimenti rimarrebbe all'ultima difficoltà selezionata
function reset() {

    var difficolta = document.forms[1];  
    var i;

    for (i = 0; i < difficolta.length; i++) {

      if (i===0) {
        difficolta[i].checked=true;
      }else{
          difficolta[i].checked=false;
      }
    }              
}        

//in base alla scelta della difficoltà richiama la funzione "inizializza" con determinati valori
//richiamata solo se l'utente preme il tasto di conferma, altrimentri il valore selezionato non verrà preso
function choose() {


    var difficolta = document.forms[1];  //1 perchè è preceduta da un'altra form
    var valore = "";
    var i;

    for (i = 0; i < difficolta.length; i++) {

        if (difficolta[i].checked) {
            valore = difficolta[i].value;
        }
    }   


    if(valore==="principiante"){

        initialize(9,9,10);

    }

    else if(valore==="intermedio"){

        initialize(16,30,40);
    }

    else if(valore==="avanzato"){

        initialize(16,30,99);
    }
    //la funzione è richiamata se l'utente preme "conferma", in quetso caso chiude il div, resetta il tempo, e lo mette in pausa, 
    //altrimenti partirebbe subito
    document.getElementById("myNav21").style.width = "0%";  //
    resetTime();
    pause();
}    

//se l'utente cambia il valore della difficoltà senza premere "conferma", 
//non viene considerata come scelta e il radio button viene impostato in base al tipo di griglia corrente
function notAChoice(){

    var difficolta = document.forms[1];  
    var i, j;

    if(Nbombe===10){
        j=0;
    }else if(Nbombe===40){
        j=1;
    }else{
        j=2;
    }

    for (i = 0; i < difficolta.length; i++) {       
      if (i===j) {
        difficolta[i].checked=true;
      }else{
          difficolta[i].checked=false;
      }
    }           
}



//apre la voce del menu selezionata, e chiude un eventuale altra pagina del menu aperta
function openNav(v) {


    var ide=document.getElementById(v.target.id).getAttribute("id");
    ide=ide+"1";

    var i;

    for (i = 0; i <=2; i++) {

      if ((document.getElementsByClassName("overlay")[i].style.width !=="0%") && (document.getElementsByClassName("overlay")[i].id !== ide)) {

            document.getElementsByClassName("overlay")[i].style.width= "0%";
      }
    }   

   
    document.getElementById(ide).style.width = "90%";
}
//chiude la pagina del menu se lìutente preme sulla X in alto a destra
function closeNav(v) {
    
    //se una volta chiusa la pagina la partita era ancora in corso, il tempo riprende 
    //da dove si era bloccato, altrimenti se la partita è finita o non è iniziata il tempo rimane bloccato
    if(( document.getElementById('second').childNodes[0].nodeValue !== '00' || document.getElementById('minute').childNodes[0].nodeValue !== '00') && !checkDisable()){

        start();            
    }
  //ricavo l'id del div che ricopre l'intera pagina, per impostare la sua larghezza nuovamente a 0
  var ide=document.getElementById(v.target.id).parentNode.getAttribute("id");

  document.getElementById(ide).style.width = "0%";

}