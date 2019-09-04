<?php
    session_start();
    if(isset($_SESSION['userLoggedIn'])) {
        $_SESSION = array();
        session_destroy();
        setcookie(session_name(), '', time()-3600);
        header('Location:http://localhost/product_review/Autentico/landing.php');
        exit();
    }
    else {
        header('Location:http://localhost/product_review/Autentico/landing.php');
        exit();
    }
?>