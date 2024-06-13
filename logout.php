<?php
    session_start();
    unset($_SESSION);
    //setcookie("Koszyk", "", time()-1000);
    session_destroy();
    header('Location: index.php');
    die;
?>