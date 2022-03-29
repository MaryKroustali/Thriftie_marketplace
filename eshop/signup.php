<?php

    include 'config.php';
    session_start();

    //get user data
    $name = $_POST["sign_name"];
    $username = $_POST["sign_email"];
    $password = $_POST["sign_pass"];

    $document = array(
            "name" => $name,
            "email" => $username,
            "password" => $password,
            "location" => '',
            "description" => '',
            "cart" => [],
            "orders" => [],
            "favorites" => [],
            "rate" => []
        );
    //search if user already exists
    $result = $collection_users->findOne($document);

    if ($result == null) {
        $search = $collection_users->InsertOne($document); //create user and redirect
        $search = $collection_users->findOne($document);

        $_SESSION['log'] = true; //create session
        $_SESSION['username'] = $username;

        echo '<script type="text/javascript">  //redirect to user profile
                window.location.replace("user.php");
            </script>';
    } else { //if user already exists, notify user
        echo '<script type="text/javascript">
        //TO DO FIX
            window.location.replace("home.php");
        </script>';
    }

?>
