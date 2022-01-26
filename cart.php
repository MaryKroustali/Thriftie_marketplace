<?php

    include 'config.php'; //connect to db

    //add product to cart
    if ($_GET['action'] == 'add') {
        $user = $collection_users->findOne(["email" => $_GET['user']]);  //find user
        if (in_array( $_GET['item'], (array)$user->cart)) {
            echo '<script>window.location.replace("user.php");</script>';
            exit();
        }
        $array_cart = (array)$user->cart;
        array_push($array_cart, $_GET['item']); //add to array cart
        $result = $collection_users->UpdateOne(["email" => $_GET['user']], ['$set' => [ "cart" => $array_cart]]); //update cart
    }

    //remove product from cart
    if ($_GET['action'] == 'remove') {
        $user = $collection_users->findOne(["email" => $_GET['user']]);  //find user
        $key = array_search($_GET['item'], (array)$user->cart);  //get position of item in cart array
        unset($user->cart[$key]);  //delete item from cart array
        $result = $collection_users->UpdateOne(["email" => $_GET['user']], ['$set' => [ "cart" => (array)$user->cart]]); //remove item
    }

    echo '<script>window.location.replace("user.php");</script>';
?>