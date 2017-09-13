<?php
    // POST variable to session
    session_start();
    $_SESSION['additional-price'] = 0;
    $_SESSION['additional-price'] = $_POST['additionalprice'];
?>