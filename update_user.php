<?php

    //start xampp/apache
    //start mongo -> (adm) net start mongodb
    //start mongo shell -> (adm) mongo
    //access php files localhost/pr1/final/login.php
    require '../vendor/autoload.php';

    $m = new MongoDB\Client("mongodb://127.0.0.1/");  //connection
    $db = $m->Thriftie_DB; //database
    $collection = $db->Users; //collection

    //get values from html input fields
    $username = $_POST['sign_email'];
    $password = $_POST['sign_pass'];

    if ($_GET['action'] == 'email') {  //update mail
        $new_username = $_POST['new_email'];
        $document = array(
           "email" => $new_username,
        );
    }

    if ($_GET['action'] == 'password') {   //update password
        $new_password = $_POST['new_pass'];
        $document = array(
            "password" => $new_password
        );
    }

    if ($_GET['action'] == 'location') {  //update location
        $city = $_POST['sign_city'];
        $country = $_POST['sign_country'];
        if ($city == '' || $country == '') {
            $document = array(
                "location" => $city.$country
           );
        } else {
            $document = array(
                "location" => $city.", ".$country
             );
        }
    }

    if ($_GET['action'] == 'description') {  //update description
        $description = $_POST['sign_descr'];
        $document = array(
            "description" => $description
       );
    }

    //execute query
    $result = $collection->findOneAndUpdate(["email" => $username, "password" => $password],['$set' => $document]);
    //update user profile page
    $new_result = $collection->findOne($document);
    global $json; //define global to pass variables in other file
    $json = $new_result->JsonSerialize(); //get data in string format
    include 'user.php';

    //check if query got any results, execute js code to redirect
    if ($result == null) {
        header("location: user.php");
    } else {
        header("location: user.php");  //redirect to user profile
    }

?>

