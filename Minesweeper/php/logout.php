<?php

session_start();
session_destroy();
// ritorna alla pagina di accesso
header('Location: ../index.php');
?>
