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
    
   
    if (isset($_POST['punti'], $_POST['vittorie'], $_POST['partite'])) {

        if(isset($_SESSION['account_id'])){

            $user=$_SESSION['account_id'];
        }


        if ($stmt = $con->prepare('SELECT user FROM stats WHERE user = ?')) {

          
           $stmt->bind_param('i', $user);
           $stmt->execute();
           $stmt->store_result();

           //se l'utente ha giocato almeno una statistica aggiorna le statistiche con i dati della partita appena conclusa
           if ($stmt->num_rows > 0) {

                $sql = "SELECT games, points, wins FROM stats WHERE user = $user";
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 

                     $partite= $row["games"]; 
                     $punti=$row["points"];
                     $vittorie=$row["wins"];
                } 


                $partite=$partite+$_POST['partite'];
                $punti=$punti+$_POST['punti'];
                $vittorie= $vittorie+$_POST['vittorie'];
                $percentuale=($vittorie/$partite)*100;
                
                //aggiornamneto delle statistiche nella base di dati
                if ($stmt = $con->prepare("UPDATE stats SET games=?, percentage=?, points=?, wins=? WHERE  user = ?")) {
 
                       $stmt->bind_param('idiii',  $partite, $percentuale, $punti,  $vittorie, $user );
                       $stmt->execute();

                }  

            } else {

                    $partite=$_POST['partite'];
                    $vittorie=$_POST['vittorie'];
                    $percentuale=($vittorie/$partite)*100;
                    //se l'utente non aveva mai giocato prima inserisce in stats con i dati dell'ultima partita giocata
                    if ($stmt = $con->prepare('INSERT INTO stats (games, percentage, points, wins, user) VALUES (?, ?, ?, ?, ?)')) {

                        $stmt->bind_param('idiii', $_POST['partite'], $percentuale, $_POST['punti'], $_POST['vittorie'], $user );
                        $stmt->execute();

                    } else {

                     
                        echo 'Could not prepare statement!';
                    }
            }       
        }
    }
?>    