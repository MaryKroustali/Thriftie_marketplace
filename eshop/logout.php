<?php

    include 'config.php';

    session_start(); //check if user is logged in
    $_SESSION = array();

    if (!isset($_SESSION['log'])) {
        $user = $collection_users->UpdateOne(['email' => 'not_logged'], ['$set' => ['cart' => [] ]]);
    }

    session_destroy();  //close current session

    //redirect to home page
    echo '<script>window.location.replace("home.php");</script>';

?>
