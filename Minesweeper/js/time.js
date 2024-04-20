var second = 0;
var cron;
//ogni secondo aggiorna il timer appena parte il gioco   
function timer() {
           
    ++second;
            
    document.getElementById('minute').childNodes[0].nodeValue= returnData(parseInt(second/60));
    document.getElementById('second').childNodes[0].nodeValue = returnData(second%60);
            
}
 //se input è >=10, input prende se stesso, altrimenti prende 0 affiancato da una cifra decimale
function returnData(input) {
  return input >= 10 ? input : '0'+input;       
}    
//inizia a contare, se si mette in pausa, grazie a cron il tempo riparte da dove si era fermato
function start() {
  pause();
  cron = setInterval( timer, 1000);
}
//mette il tempo in pausa
function pause() {
  clearInterval(cron);
}
//resetta il conteggio
function resetTime() {

  second = 0;

  document.getElementById('minute').childNodes[0].nodeValue = '00';
  document.getElementById('second').childNodes[0].nodeValue = '00';

}  
            
            
            
            