<?php

session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'pratofiorito';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if ( mysqli_connect_errno() ) {
	
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//se nome utente e password non sono stati inseriti restituisce un messaggio d'errore
if ( !isset($_POST['utente'], $_POST['password']) ) {
	
    exit('Nome utente e/o password mancanti, completa il campo!');
}


// utilizzando la prepare si ha maggiore sicurezza da SQL injection
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	
	$stmt->bind_param('s', $_POST['utente']);
	$stmt->execute();
	$stmt->store_result();
       
	if ($stmt->num_rows > 0) {             //controllo se c'è almeno un utente che corrisponde a quell'username
		
                $stmt->bind_result($id, $password); 
		$stmt->fetch();
                
		// occorre verificare la password dato che si usa la funzione hash
		if (password_verify($_POST['password'], $password)) {
			
			// creazione delle sezioni ad indicare che l'utente è loggato
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['username'] = $_POST['utente'];
			$_SESSION['account_id'] = $id;
			header('Location: game.php'); //si passa il controllo alla pagina del gioco

		} else {
			//password sbagliata
			echo ' La password è sbagliata!';
		}
	} else {
		//username scorretto
		echo 'Il nome utente è sbagliato!';
	}



	$stmt->close();
}

?>