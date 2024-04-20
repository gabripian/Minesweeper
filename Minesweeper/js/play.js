 //funzione richiamata quando si clicca su una casella della griglia             
function cell(cord) {

    var x1, y1; 
    var Cellevuote= (n*m)-Nbombe;
    //se il tempo non è ancora iniziato avvia il timer, altrimenti prosegui con il timer avviato
    if(( document.getElementById('second').childNodes[0].nodeValue === '00') && (document.getElementById('minute').childNodes[0].nodeValue === '00')){
        start();
    }
    
    //prendo le coordinate dell'elemento clicato e le assegno ad x1, y1 per accedere alle matrici 
    var lunghezza;                       

    lunghezza= cord.target.id.length;       //prendo la lunghezza dell'id dell'elemento che viene cliccato
   
    x1=cord.target.id.substring(0,2);        //assegno ad x1 i primi due caratteri dell'id, se i secondo è -, allora prendo solo il primo

    if(x1.charAt(1)==='-'){
        x1 = x1.charAt(0);
    }

    parseInt(x1);
    x1++;

    y1 = cord.target.id.substring(lunghezza-2, lunghezza);  //y1 contiene gli ultimi due caratteri della stringa

     if(y1.charAt(0)==='-'){            //se il primo carattere della stringa prelevata è -, il numero è ad una cifra, quindi tolgo il -, altrimenti va bene così

        y1 = y1.charAt(1);
    }

    parseInt(y1);
    y1++;

    //se nella casella c'è una bandierina, termina e la casella non si apre
    if (c[x1][y1] === 'F') {
        return false;
    }

    //se nella casella c'era un ? allora apre la casella normalmente a seconda della dimensione della griglia
    if(c[x1][y1]==='?'){

        if(m>9){
              
            document.getElementById((x1-1)+'-'+(y1-1)).setAttribute("class", "buttonsmall");
               
        }else{
                
            document.getElementById((x1-1)+'-'+(y1-1)).setAttribute("class", "button");
        }
    }   

    //se nella casella selezionata non c'è nessuna bomba incrementa vivo, ad indicare il numero
    //di caselle aperte fino a quel momento, e apri le caselle
    if (a[x1][y1] !== 'B') {

        //se nella casella c'è un numero la pare e basta, se è vuota richiama la funzione apri
        if (a[x1][y1] !== 0) {

            vivo++;
            //in base al numero contenuto si assegna il colore tramite la funzione colori
            var colore=colors(a[x1][y1]);

            document.getElementById(cord.target.id).style.color = colore;
            document.getElementById(cord.target.id).value = a[x1][y1];

            document.getElementById(cord.target.id).style.backgroundColor = "#82E0FF";
            document.getElementById(cord.target.id).style.borderRadius = 0;
            document.getElementById(cord.target.id).disabled = true;

        } else {

           open(x1, y1);

        }

    } else {

        document.getElementById((x1-1)+'-'+(y1-1)).style.backgroundColor = "#82E0FF";
        document.getElementById((x1-1)+'-'+(y1-1)).style.borderRadius = 0;
        
        //mostra la bomba colpita nella versione rossa in base alla dimensione della griglia
        if(m>9){
            
            document.getElementById((x1-1)+'-'+(y1-1)).setAttribute("class", "buttonsmall bomb11");

        }else{
            
            document.getElementById((x1-1)+'-'+(y1-1)).setAttribute("class","button bomb1"); 
        }

        lost();    //mostra tutte le bombe
        pause();        //stoppa il tempo
        var loose=1;
        points(loose);  //calcola il punteggio in base alla sconfitta
        alert("hai preso la bomba,hai perso");

        disable();      //disabilita la griglia di gioco

    }
    
    //se si arriva fin qua ci si è salvati e se il numero di celle aperte corrisponde al numero di caselle senza bombe
    // si ha vinto
    if (vivo === Cellevuote) {
        
        pause();                //stoppa il tempo
        var loose=0;
        points(loose);          //calcola il punteggio
        alert("hai vinto"); 
        disable();              //disabilita l'intera griglia

    }

}

//disabilita la griglia di gioco
function disable(){
    
    for(var i=0;i<n;i++){
        
        for(var j=0;j<m;j++){
            
            document.getElementById(i+'-'+j).disabled = true;
        }
    }     
}

//controlla che la griglia sia disabilitata, utile per fermare o far ripartire il timer alla chiusura 
//di una finestra del menu
function checkDisable(){
    
    var c=0;
    for(var i=0;i<n;i++){
        
        for(var j=0;j<m;j++){
            
            if(document.getElementById(i+'-'+j).disabled === true){
                c++;
            }
        }   
    }
    //se tutte le celle sono disabilitate restituisce true
    if(c===(n*m)){
        
        return true;
    }

    return false;
}


//funzione ricorsiva, richiamata per ogni casella vuota trovata
function open(x, y) {

    var ide;
   
    ide = (x - 1) + '-' + (y - 1);
    //devo incrementare il numero di caselle, per ogni casella che apro
    vivo++;

    document.getElementById(ide).style.backgroundColor = "#82E0FF";
    document.getElementById(ide).style.borderRadius = 0;
    document.getElementById(ide).disabled = true;
    //se c'è un ? lo rimuove
    if(c[x][y]=='?'){

        document.getElementById(ide).classList.remove("questionmark");  
        document.getElementById(ide).classList.remove("questionmark1");

    }
    //mette vuoto nella casella al posto di 0, sia nella matrice che nella griglia reale
    a[x][y] = " ";
    document.getElementById(ide).value = a[x][y];

    //apre gli elementi vuoti adiacenti, aprendo anche i numeri al confine, 
    //non aprela casella se trova una bomba o una bandierina
    for (var h = x - 1; h <= x + 1; h++) {
        for (var k = y - 1; k <= y + 1; k++) {

            if (a[h][k] != 0 && a[h][k] != 'B' && a[h][k] != -1 && c[h][k]!='F') {
                
                ide = (h - 1) + '-' + (k - 1);

                if(document.getElementById(ide).style.backgroundColor !== "rgb(130, 224, 255)"){

                    var colore=colors(a[h][k]);
                    document.getElementById(ide).style.color = colore;
                    document.getElementById(ide).value = a[h][k];
                    a[h][k]=-1;

                    document.getElementById(ide).style.backgroundColor = "#82E0FF";
                    document.getElementById(ide).style.borderRadius = 0;
                    document.getElementById(ide).disabled = true;

                    if(c[h][k]=='?'){

                        document.getElementById(ide).classList.remove("questionmark");
                        document.getElementById(ide).classList.remove("questionmark1");
                    }

                    vivo++;
                }

            } else if (a[h][k] === 0 && c[h][k]!=='F') {

                open(h, k);
            }
        }
    }
}    
//si attiva premendo il tasto destro del mouse
function right(v) {

    var x2,y2;
    var lunghezza;       //si ricavano le coordinate come fatto prima                

    lunghezza= v.target.id.length;

    x2=v.target.id.substring(0,2);

    if(x2.charAt(1)==='-'){
        
        x2 = x2.charAt(0);
    }

    parseInt(x2);
    x2++;

    y2 = v.target.id.substring(lunghezza-2, lunghezza);  

    if(y2.charAt(0)==='-'){            

        y2 = y2.charAt(1);
    }

    parseInt(y2);
    y2++;

    //se il tasto è il sinistro non fa nulla e termina
    if (v.button === 1) {

        return false;
    }
    
    //se il tasto è quello destro, allora inserisce la bandierina o il ?, o li toglie
    if (v.button === 2) {
        //se nella casella non c'è nè una bandierina, nè un ?
        if ( c[x2][y2] !== 'F' && c[x2][y2] !== '?') {
            //se il contatore di bandierine è > di 0, lo decrementa e inserisce la bandierina
            if (conta > 0) {
                
                conta--;


                if(m>9){
                    
                      document.getElementById(v.target.id).setAttribute("class", "buttonsmall flag1"); 

                }else{
                    
                    document.getElementById(v.target.id).setAttribute("class", "button flag"); 
                }

                c[x2][y2] = 'F';
                document.getElementById("bandierine").value = conta;

            }

        } else if(c[x2][y2] !== '?'){       //se nella casella c'è una bandierina e non un ?, toglie la bandierina, 
                                            //incrementa il contatore e mette un ? 
            conta++;

            if(m>9){
                document.getElementById(v.target.id).setAttribute("class","buttonsmall questionmark1");

            }else{
                document.getElementById(v.target.id).setAttribute("class","button questionmark");
              }


              c[x2][y2] = '?';
              document.getElementById("bandierine").value = conta;

        } else {                //se nella casella c'è un ? lo toglie

            if(m>9){
                document.getElementById(v.target.id).setAttribute("class", "buttonsmall");

            }else{
                document.getElementById(v.target.id).setAttribute("class", "button");
            }

            c[x2][y2] = 0;

        }

    }

}

//in base al valore della casella aperta restituisce il colore da assegnare
function colors(c){

switch (c) {
    case 1:
      c = "#0066ff";
      break;
    case 2:
      c = "#2eb82e";
      break;
    case 3:
      c = "#ff0000";
      break;
    case 4:
      c = "#ff3399";
      break;
    case 5:
      c = "#9900cc";
      break;
    case 6:
      c = "#ff5500";
      break;
    case  7:
      c = "#663300";
      break;
    case  8:
      c = "#ccff33";
}    

return c;  

}

//mostra la posizione di ogni bomba, evidenziando in rosso la bomba colpita
function lost(){

    for (var i = 1; i<=n; i++) {
        for (var j =1; j <= m; j++) {
            
            //se nella cella c'è una bomba diversa da una bomba rossa la mostra
            if (a[i][j] === 'B' && document.getElementById((i-1)+'-'+(j-1)).getAttribute("class")!=="button bomb1" && document.getElementById((i-1)+'-'+(j-1)).getAttribute("class")!=="buttonsmall bomb11") {
    
                document.getElementById((i-1)+'-'+(j-1)).style.backgroundColor = "#82E0FF";
                document.getElementById((i-1)+'-'+(j-1)).style.borderRadius = 0;

                if(n>9){
                    
                    document.getElementById((i-1)+'-'+(j-1)).setAttribute("class","buttonsmall bomb21");
                }else{
                    
                  document.getElementById((i-1)+'-'+(j-1)).setAttribute("class","button bomb2"); 

                }
            }                                   
        } 
    }
}