<?php

    include 'config.php';

    $user = $collection_users->findOne(["name" => $_GET['seller']]);  //find user

    $document = array(  //create document from user data
        "stars" => $_POST['rating'],
        "comment" => $_POST['rate'],
        "buyer" => $_GET['user']
    );

    $array = (array)$user->rate; //get rating of user
    array_push($array, $document);

    $result = $collection_users->UpdateOne(["name" => $_GET['seller']], ['$set' => [ "rate" => $array]]); //append user rating

    echo '<script>window.location.replace("user.php");</script>'; //redirect

?>