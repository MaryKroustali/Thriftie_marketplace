<?php

    include 'config.php';

    $collection_users->deleteOne(["email" => $_GET['user']]); //delete user

    echo '<script>window.location=document.referrer;</script>'; //return to page and refresh

?>
