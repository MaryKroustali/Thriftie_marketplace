<?php

    include 'config.php';

    session_start(); //check if user is logged in
    if ($_SESSION['log'] == true) {
        $user = $collection_users->findOne(["email" => $_SESSION['username']]);
    }

    $sum = 0;
    $document = [];  //array to store items in order
    foreach($user->cart as $item) {  //get total price of order
        $item = $collection_products->findOne(["name" => $item]); //find products
        $sum = $sum + (float)$item->price;
        array_push($document, $item->name);  //add product in order history
    }
    array_push($document, ["total" => $sum]);  //add total in order history
    $array = (array)$user->orders;
    array_push($array, $document);
    $collection_users->UpdateOne(["email" => $user->email], [ '$set' => ['orders' => $array]]); //add order to order history

    $collection_users->UpdateOne(["email" => $user->email], [ '$set' => ['cart' => [] ]]); //empty user cart

    echo '<script>window.history.back();</script>';

?>