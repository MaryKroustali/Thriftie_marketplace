<?php

    include 'config.php';

    session_start(); //check if user is logged in
    if ($_SESSION['log'] == true) {
        $user = $collection_users->findOne(["email" => $_SESSION['username']]);
    }

    $seller = $collection_users->findOne(["name" => $_GET['seller']]);  //find user

    $document = array(  //create document from user data
        "stars" => $_POST['rating'],
        "comment" => $_POST['rate'],
        "buyer" => $user->name
    );

    $array = (array)$seller->rate; //get rating of user
    array_push($array, $document);

    $result = $collection_users->UpdateOne(["name" => $seller->name], ['$set' => [ "rate" => $array]]); //append user rating

    echo '<script>window.location.replace("user.php");</script>'; //redirect

?>
