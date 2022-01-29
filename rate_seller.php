<?php

    include 'config.php';

    $user = $collection_users->findOne(["name" => $_GET['user']]);  //find user

    $document = array(  //create document from user data
        "stars" => $_POST['rating'],
        "comment" => $_POST['rate']
    );

    $array = (array)$user->rate; //get rating of user
    array_push($array, $document);

    $result = $collection_users->UpdateOne(["name" => $_GET['user']], ['$set' => [ "rate" => $array]]); //append user rating

    echo '<script>window.location.replace("user.php");</script>'; //redirect

?>