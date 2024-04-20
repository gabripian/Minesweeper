//cliccando su Statistiche si richiama la pagina php che aggiorna le statistiche in base all'utente corrente
$(document).ready(function () {
    $(document).on('click', '.refresher', function () {
        $.ajax({
            url: '../php/ranking.php',
            method: "GET",

            success: function(response) {
                
                var json_data = JSON.parse(response);
               
                $('#table-to-refresh').html(json_data.id1);
                $('#table-to-refresh1').html(json_data.id2);
                $('#fieldset-to-refresh').html(json_data.id3);
            }
        });
    });
});

//calcola il punteggio lato client ed invia i parametri lato server dove verranno inseriti nel database
function points(loose){
    //le partite sono 1 in ogni caso perchè si somma poi al numero di partite nel database
    var punti, partite=1, vittorie;
    var minuti=parseInt((document.getElementById('minute').textContent)*60);
    var secondi=parseInt(document.getElementById('second').textContent);
    var tempo=minuti+secondi;  

    //se l'utente ha perso i punti saranno 0 e al numero di vittorie sarà sommato 0
    if(loose===1){
        punti=0;
        vittorie=0;

    }else{
        //se l'utente ha vinto viene calcolato il punteggio in base al tempo ed alla difficoltà
        var difficolta = document.forms[1];  
        var valore="";
        var i;

        //si prendela difficoltà della partita appena terminata
        for (i = 0; i < difficolta.length; i++) {

            if (difficolta[i].checked) {
              valore = i;
            }
        }

        if(valore===0){
            if(tempo<=90){
                punti=10;
            }else if(tempo>90 && tempo<300){
                punti=5;
            }else if(tempo>=300){
                punti=1;
            }
        }else if(valore===1){
            if(tempo<=90){
                punti=20;
            }else if(tempo>90 && tempo<300){
                punti=10;
            }else if(tempo>=300 && tempo<420){
                punti=2;
            }else if(tempo>=420){
                punti=1;
            }
        }else if(valore===2){
             if(tempo<=90){
                punti=50;
            }else if(tempo>90 && tempo<300){
                punti=20;
            }else if(tempo>=300 && tempo<420){
                punti=5;
            }else if(tempo>=420){
                punti=1;
            }
        }

        vittorie=1;

    }

    //si aggiornano le statistiche nel database
    $.ajax({
        type: "POST",
        url: "../php/stats.php",
        data: {punti: punti, vittorie: vittorie, partite: partite}

    });


}