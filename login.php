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
    $username = $_POST['login_email'];
    $password = $_POST['login_pass'];
    //create document to insert
    $document = array(
        "email" => $username,
        "password" => $password,
    );
    //execute query
    $result = $collection->findOne($document);

    //check if query got any results, execute js code to redirect
    if ($result != null) {
        global $json; //define global to pass variables in other file
        $json = $result->JsonSerialize(); //get data in string format
        include 'user.php';
        echo '
        <script type="text/javascript">  //redirect to user profile
            window.location("user.php");
        </script>
        ';
    } else {
        header("location: home.html");
    }

?>

