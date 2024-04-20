 <?php
            
            session_start();
           
            if (!isset($_SESSION['loggedin'])) {
                    header('Location: index.php');
                    exit;
            }
        ?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="it">
    <head>
        <title>prato fiorito</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="shortcut icon" href="#">
        <link rel="stylesheet" href="../CSS/play.css">
        <link rel="stylesheet" href="../CSS/menu.css">
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../js/time.js"></script> 
        <script src="../js/menu.js"></script>
        <script src="../js/play.js"></script> 
        <script src="../js/points.js"></script>
        <script src="../js/create.js"></script> 
        
        
    </head>
    <body  oncontextmenu="return false" onload="initialize(9,9,10,0), reset()" class="main"> <!-- resetta imposta il radio alla prima scelta-->
        
        <div class="wrapper">
            <h1>PRATO FIORITO</h1>
            <br>


            <div id="Prato" >

            </div>
            <br><br>
            <form>
                <span class="par" > Numero di bandierine posizionabili:</span>          <!-- span perchè è inline-->
                <input type="text" id="bandierine" value="" readonly="readonly" class="inputflag">
                <br><br>

            </form>

            <div class="time"><span id="minute">00</span>:<span id="second">00</span></div>

                <button  class='button1' onclick='choose()'>Ricomincia</button>

            <div class="sidenav">
                <div id="myNav" onclick="openNav(event), pause(), notAChoice()">Come si gioca</div>
                <div id="myNav2" onclick="openNav(event), pause(), notAChoice()">Opzioni di gioco</div>
                <div class="refresher" id="myNav3" onclick="openNav(event), pause(), notAChoice()">Statistiche</div>
                <a href="logout.php">Esci</a>
                <div class="hide"></div>  <!-- vuoto per ottenere il bordo -->
            
        </div>
        
        </div>
        
        <div id="myNav1" class="overlay">
            <a id="chiudi1"  class="closebtn" onclick="closeNav(event)">&times;</a>

            <h1>...ecco qua una breve guida sulle regole del gioco</h1>
            <div class="explain">
                <pre>   
                Per iniziare a giocare porta il cursore del mouse su una casella della griglia e premi il pulsante sinistro, 
                se in tale casella si celava una bomba avrai subito perso... ma non preoccuparti, potrai subito giocare una 
                nuova partita premendo il pulsante "ricomincia".
                
                Se ti sei salvato, si apriranno una o più caselle, alcune vuote ad indicare che non hanno bombe ai loro confini, 
                altre presenteranno un numero il quale indica la quantità di bombe con cui confinano, basandoti sui numeri potrai 
                capire sotto quali caselle sono nascoste le bombe e di conseguenza eviatrle.

                Come aiuto potrai inserire una bandierina sopra la casella in cui pensi ci sia una bomba, premendo il tasto destro 
                del mouse, inoltre se accidentalmente dovessi cliccare su una casella con la bandierina con il tasto sinistro, 
                fortunatamente per te la casella non si aprirà, ma rimarrà bloccata, man mano che inserisci bandierine,  il numero 
                di bandierine riportato nella casella diminuirà fino all'esaurimento delle bandierine disponibili. 
              
                Oltre a questo, se non sei sicuro che sotto una cella ci sia una bomba potrai  inserire un punto interrogativo nella 
                casella, premendo due volte il tasto destro del mouse, attenzione però... se in questo caso premi il tasto sinistro 
                del mouse in quella casella, questa si aprirà normalmente come le caselle senza la bandierina.

                Se riuscirai a scoprire tutte le caselle che non contengono bombe, avrai raggiunto la vittoria, altrimenti potrai 
                ritentare tutte le volte che desideri, puoi inoltre scegliere la difficoltà di gioco selezionando l'opzione che
                preferisci nella sezione "Opzioni di gioco" che trovi nel menu a sinistra della griglia di gioco.

                Nella sezione "Statistiche" troverai delle informazioni riguardanti le tue partite giocate, la tua posizione nella 
                classifica nazionale e nella classifica globale, nella classifica viene data priorità al punteggio ottenuto, in caso
                di parità peserà la percentuale di vittorie, per sapere come viene calcolato il punteggio guarda la tabella qui sotto.    
                </pre>
            </div>
            <br><br>

            <table class="rank1" >
                <thead>
                    <tr>
                      <th>Difficoltà</th>
                      <th>Tempo<br>≤ 90</th>
                      <th>Tempo<br>&gt; 90 e &lt; 300</th>
                      <th>Tempo<br>≥ 300 e ≤ 420</th>
                      <th>Tempo<br>≥ 420</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td class="col">Principiante</td>
                      <td>10 punti</td>
                      <td>5 punti</td>
                      <td>1 punto</td>
                      <td>1 punto</td>

                    </tr>
                    <tr>
                      <td class="col">Intermedio</td>
                      <td>20 punti</td>
                      <td>10 punti</td>
                      <td>2 punti</td>
                      <td>1 punto</td>

                    </tr>
                     <tr>
                      <td class="col">Avanzato</td>
                      <td>50 punti</td>
                      <td>20 punti</td>
                      <td>5 punti</td>
                      <td>1 punto</td>

                    </tr>
                </tbody>
            </table>
        </div>
        
        
        <div id="myNav21" class="overlay">
            <a id="chiudi2"  class="closebtn" onclick="closeNav(event), notAChoice()">&times;</a>

            <h1>Scegli la difficoltà di gioco che preferisci</h1>

            <div class="mark">
                <div class="radio-toolbar">
                    <form >
                        <input type="radio" id="easy" name="difficolta" value="principiante" checked>

                        <label for="easy">Principiante<br><br>10 Bombe<br> Griglia 9x9</label>

                        <input type="radio" id="medium" name="difficolta" value="intermedio">

                        <label for="medium">Intermedio<br><br>40 Bombe<br> Griglia 16x30</label>

                        <input type="radio" id="hard" name="difficolta" value="avanzato">

                        <label for="hard">Avanzato<br><br>99 Bombe<br> Griglia 16x30</label> 

                    </form>
                    
                    <button  class='button1 button2' onclick='choose()'>Conferma</button>

                </div>
            </div>
        </div>
        
        
        <div id="myNav31" class="overlay">
            <a id="chiudi3"  class="closebtn" onclick="closeNav(event), notAChoice()">&times;</a>

            <h1>Statistiche</h1>
            <div id="fieldset-to-refresh">
                <fieldset>
                    <legend>Statistiche:</legend>
                    <label >Partite giocate:</label> <span>0</span><br>
                    <label >Vittorie:</label> <span>0</span><br>
                    <label >Percentuale vittorie:</label> <span>0 %</span><br>
                </fieldset>
            </div>
            <br>

            <fieldset class="fieldset1">

                <legend>Classifiche:</legend>

                <div class="left">
                    <label >Classifica Nazionale:</label> 


                    <div class="table-scroll">
                        <table id="table-to-refresh" class="rank">
                            <thead>
                                <tr>
                                  <th class="text">Utente</th>
                                  <th class="text">Punteggio</th>
                                  <th class="text">Percentuale</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="right">
                    <label >Classifica Globale:</label> 

                    <div class="table-scroll">

                        <table id="table-to-refresh1" class="rank" >
                           <thead>
                                <tr>
                                  <th>Utente</th>
                                  <th>Punteggio</th>
                                  <th>Percentuale</th>
                                  <th>Nazione</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>

                                </tr>

                            </tbody>
                        </table>
                  </div>

                </div>  

            </fieldset>
        </div>
    
    </body>
    
</html>