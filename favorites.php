<?php

    require '../vendor/autoload.php';
    include 'config.php';

    //remove product from favorites
    if ($_GET['action'] == 'remove') {
        $user = $collection_users->findOne(["email" => $_GET['user']]);  //find user
        $key = array_search($_GET['item'], (array)$user->favorites);  //get position of item in favorites array
        unset($user->favorites[$key]);  //delete item from favorites array
        $result = $collection_users->UpdateOne(["email" => $_GET['user']], ['$set' => [ "favorites" => (array)$user->favorites]]); //remove item
    }

    echo '<script>window.location.replace("user.php");</script>';

?>