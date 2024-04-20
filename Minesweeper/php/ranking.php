<?php

    session_start();
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'pratofiorito';
    
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
 
    if (mysqli_connect_errno()) {
           
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    
    //si recupera l'id dell'utente loggato
    if(isset($_SESSION['account_id'])){

        $user=$_SESSION['account_id'];
    }


    //si ricava la nazione di tale utente
    $sql = "SELECT nation FROM accounts WHERE id = $user"; 
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 

        $nation= $row["nation"]; 

    } 
    
    //si ricavano i dati della classifica nazionale già ordinati
    $sql1 = "SELECT username, points, percentage FROM accounts INNER JOIN stats  ON id=user WHERE nation= '$nation'  ORDER BY points DESC, percentage DESC"; 
    $result1 = mysqli_query($con,$sql1);

    //si crea una tabella con i dati inseriti da inviare alla pagina del gioco 
    $contents3="";
    $contents= '<table class="rank">
      <thead>
          <tr>
          <th>Utente</th>
         <th>Punteggio</th>
         <th>Percentuale</th>
          </tr>
      </thead>
      <tbody>';
        
    while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){ 

        $field1name = $row1["username"];
        $field2name = $row1["points"];
        $field3name = $row1["percentage"];

        $field3name=round($field3name,2);

       $contents1= " <tr>
        <td>$field1name</td>
        <td>$field2name</td>
         <td>$field3name</td>
        </tr>";
       $contents3=$contents3.$contents1;
    }    
    $contents2=' </tbody>
    </table>';
    //si concatenano le stringhe intermedie generate
    $contents=$contents.$contents3.$contents2;

    //dati per la classifica globale già ordinati
    $sql2 = "SELECT username, points, percentage, nation FROM accounts INNER JOIN stats  ON id=user  ORDER BY points DESC, percentage DESC"; 
    $result2 = mysqli_query($con,$sql2);

    //si crea una tabella con i dati inseriti da inviare alla pagina del gioco 
    $contents7="";
      $contents4= '<table class="rank">
      <thead>
          <tr>
          <th>Utente</th>
         <th>Punteggio</th>
         <th>Percentuale</th>
         <th>Nazione</th>
          </tr>
      </thead>
      <tbody>';

    while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){ 

        $field1name = $row2["username"];
        $field2name = $row2["points"];
        $field3name = $row2["percentage"];
        $field4name = $row2["nation"];
        $field3name=round($field3name,2);

        $contents5= " <tr>
        <td>$field1name</td>
        <td>$field2name</td>
        <td>$field3name</td>
        <td>$field4name</td>    
        </tr>";
       $contents7=$contents7.$contents5;
    }    
     $contents6=' </tbody>
     </table>';
        
    $contents4=$contents4.$contents7.$contents6;  

    
    //si controlla se l'utente ha effettuato almeno una partita
    if ($stmt = $con->prepare('SELECT games FROM stats WHERE user = ?')) {

         
            $stmt->bind_param('i', $user);
            $stmt->execute();
            $stmt->store_result();

            // Se l'utente non ha mai giocato non compare in classifica e nelle statistiche persomali ha tutti 0

            if ($stmt->num_rows > 0) {
    
                //se l'utente ha giocato almeno una partita aggiorna le sue statistiche
                $sql3 = "SELECT games, wins, percentage FROM stats WHERE user = $user"; 
                $result3 = mysqli_query($con,$sql3);
                while($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)){ 

                    $field1name = $row3["games"]; 
                    $field2name = $row3["wins"];
                    $field3name = $row3["percentage"];
                    $field3name=round($field3name,2);

                }
            }else{
                
                $field1name = 0; 
                $field2name = 0;
                $field3name = 0;

            }
    }
    //crea le statistiche aggiornate
    $contents8= "<fieldset class=''>
        <legend>Statistiche:</legend>
        <label >Partite giocate:</label> <span> $field1name</span><br>
        <label >Vittorie:</label> <span> $field2name</span><br>
        <label >Percentuale vittorie:</label> <span>  $field3name %</span><br> 
        </fieldset>";
    
   //array che contiene i risultati calcolati
    $return=array("id1" => $contents, "id2" => $contents4, "id3" => $contents8);

    echo json_encode($return);
 
?>    