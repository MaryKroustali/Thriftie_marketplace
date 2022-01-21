<?php
    //start xampp/apache
    //start mongo -> (adm) net start mongodb
    //start mongo shell -> (adm) mongo
    //access php files localhost/pr1/final/login.php
    require '../vendor/autoload.php';

    $m = new MongoDB\Client("mongodb://127.0.0.1/");  //connection
    $db = $m->Thriftie_DB; //database
    $collection = $db->Users; //collection
    //get user data
    $username = $_POST["sign_email"];
    $password = $_POST["sign_pass"];

    $document = array(
            "email" => $username,
            "password" => $password,
        );
    //search if user already exists
    $result = $collection->findOne($document);
    if ($result == null) {
        $collection->InsertOne($document); //create user and redirect
        echo '
        <script type="text/javascript">
            window.location = "home.html";
        </script>';
    } else { //if user already exists, notify user
        echo '
        <script type="text/javascript">
        </script>
        ';
    }

?>