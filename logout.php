<?php

/* funkcija za odjavu korisnika. samo resetujemo login,id i ime na default */
require('connection.inc.php');
require('functions.inc.php');
unset($_SESSION['USER_LOGIN']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
header('location:index.php');
die();
?>