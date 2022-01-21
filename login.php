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
        echo '
        <script type="text/javascript">
            window.location = "home.html";
        </script>';
    } else { //if no data returned, notify user
        echo '
        <script type="text/javascript">
        </script>
        ';
    }

?>