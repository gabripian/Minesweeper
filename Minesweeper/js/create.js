var  n, m, vivo, Nbombe, conta;     //n ed m sono le dimensioni della griglia
var a =[];                          //matrice duale alla griglia di gioco
var c = [];                         //matrice contenente le posizioni di bandierine e ?

//inizializza le variabili necessarie al refresh, alla pressione del tasto "ricomincia" 
//e alla pressione del tasto "conferma"
function initialize(n1, m1, Nbombe1, remove=1){
    n=n1;
    m=m1;
    Nbombe= Nbombe1;
    conta=Nbombe1;
    vivo=0;
    document.getElementById("bandierine").value = conta;

   //se inizializza è chiamata da onload non rimuove la griglia, se è chiamata dalla Choose rimuove la griglia vecchia

    if(remove===1){
        var griglia = document.getElementById("grill");
        griglia.remove();  //rimozione della vecchia griglia */
    }

    create();
    startGame(Nbombe);
}

//riempimento della matrice a, in base alla quale verrà costruita la griglia di gioco
function create() {

    var x, y, s=0;  
    //si crea una matrice con una cornice di -1 intorno
    for (var i = 0; i <= n + 1; i++) {
        a[i] = [];                                      //la  matrice non si dichiara con a[][], quindi si crea il vettore a[] e gli assegnamo tanti vettori, in modo da creare una matrice
        for (var j = 0; j <= m + 1; j++) {
            if (i === 0 || i === n+1 || j === 0 || j === m+1) {
                a[i][j] = -1;
            } else {
                a[i][j] = 0;
            }
        }
    }
    //si assegnano le bombe in maniera casuale
    for (var i = 1; i <= Nbombe; i++) {
        x = Math.floor(Math.random() * n) + 1;
        y = Math.floor(Math.random() * m) + 1;

        if (a[x][y] !== 'B') {

            a[x][y] = 'B';

        } else {

            i--;
        }

    }
    //le caselle che non contengono bombe sono inizializzate col numero di bombe con cui confinano
    for (var i = 1; i <= n; i++) {
        for (var j = 1; j <= m; j++) {

            if (a[i][j] !== 'B') {
                for (var h = i - 1; h <= i + 1; h++) {
                    for (var k = j - 1; k <= j + 1; k++) {

                        if (a[h][k] === 'B') {

                            s++;

                        }
                    }
                    a[i][j] = s;
                }
            }
            s = 0;
        }
    }
    //si crea la matrice che contiene bandierine e ?, inizializzata a 0
    for (var i = 0; i <= n + 1; i++) {
        c[i] = [];
        for (var j = 0; j <= m + 1; j++) {
            c[i][j] = 0;
        }
    }


}

//creazione della griglia di gioco
function startGame(conto) {

    //creazione della griglia di gioco
     prato = document.getElementById("Prato");

    var tabella = document.createElement('table');
    tabella.setAttribute("class", "center");
    tabella.setAttribute("id","grill");

    for (var i = 0; i < n; i++) {
      var trTabella = document.createElement('tr');
      tabella.appendChild(trTabella);

        for (var j = 0; j < m; j++) {
        var tdTabella = document.createElement('td');

        tdTabella=document.createElement("input");

        if(n>9){
            tdTabella.setAttribute("class", "buttonsmall");
        }else{
            tdTabella.setAttribute("class", "button");
        }
        tdTabella.setAttribute("onClick", "cell(event)");
        tdTabella.setAttribute("onMouseDown", "right(event)");

        tdTabella.id= i+"-"+j;
        trTabella.appendChild(tdTabella);
        }
    }
    //in caricamento il contatore di bandierine viene inizializzato a 10, altrimenti negli altri casi, in base alla griglia corrente
    if(conto==null){
        document.getElementById("bandierine").value =10;
    }else{     
        document.getElementById("bandierine").value =conto;
    }

    prato.appendChild(tabella);


}


