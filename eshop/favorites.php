<?php

    include 'config.php';

    session_start(); //check logged in user
    if ($_SESSION['log'] == true) {
        $user = $collection_users->findOne(["email" => $_SESSION['username']]);
    }

    //remove product from favorites
    if ($_GET['action'] == 'remove') {
        $key = array_search($_GET['item'], (array)$user->favorites);  //get position of item in favorites array
        unset($user->favorites[$key]);  //delete item from favorites array
        $result = $collection_users->UpdateOne(["email" => $user->email], ['$set' => [ "favorites" => (array)$user->favorites]]); //remove item
    }

    if ($_GET['action'] == 'add') {
        $array_favorites = (array)$user->favorites;
        array_push($array_favorites, $_GET['item']); //add to array  favorites
        $result = $collection_users->UpdateOne(["email" => $user->email], ['$set' => [ "favorites" => $array_favorites]]); //update list favorites
    }

    echo '<script>window.history.go(-1);</script>'; //return to previous page

?>
