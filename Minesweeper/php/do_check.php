<?php

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'pratofiorito';
   
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    
    if (mysqli_connect_errno()) {
            
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    //se tutti i campi sono stati settati continua con l'elaborazione
    if (isset($_POST['nomeutente'], $_POST['email'], $_POST['nazioni'], $_POST['Password'])) {
    
   
        //si controlla se il nome utente è inserito nel database
        if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {

            
            $stmt->bind_param('s', $_POST['nomeutente']);
            $stmt->execute();
            $stmt->store_result();

            //se il risultato ha almeno una riga allora il nome utente è già presente e si stampa un messaggio
            if ($stmt->num_rows > 0) {

                    
                  exit( "Nome utente non disponibile");
                   
            } else {
                
                    //se una delle condizioni non è verificata stampa errore
                    if((preg_match('/^[a-zA-Z0-9_-]+$/', $_POST['nomeutente']) == 0) || (strlen($_POST['nomeutente']) > 20 || strlen($_POST['nomeutente']) < 5) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) || (preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/', $_POST['email']) == 0) || (preg_match('/^[\S]+$/', $_POST['Password']) == 0) || (strlen($_POST['Password']) > 20 || strlen($_POST['Password']) < 5)){
                            
                        exit("errore");
                       
                    }else if ($stmt = $con->prepare('INSERT INTO accounts (username, email, nation, password) VALUES (?, ?, ?, ?)')) {

                        //se i dati sono tutti corretti inserisci l'utente e stampa un messaggio

                        $password = password_hash($_POST['Password'], PASSWORD_BCRYPT );
                        $stmt->bind_param('ssss', $_POST['nomeutente'], $_POST['email'], $_POST['nazioni'], $password );
                        $stmt->execute();
                        exit("La registrazione è avvenuta con successo, puoi accedere!");

                    } else {

                 

                        echo 'Could not prepare statement!';
                    }  
            }
           
        }
   
    }
   
    //controllo della correttezza di password e nome utente
    if ( isset($_POST['utente'], $_POST['password']) ) {
	

       
        if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
               
                $stmt->bind_param('s', $_POST['utente']);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {                          

                        $stmt->bind_result($id, $password);
                        $stmt->fetch();

                        if (password_verify($_POST['password'], $password)) {
                                
                            exit("success");
                            
                        } else {
                                
                            exit("La password è sbagliata!");
                            
                        }
                        
                } else {
                       
                    exit("Il nome utente è sbagliato!");
                }
        }     
    }
    $stmt->close();
       
?>    