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
    $result = $collection->findOne($document);

    if ($result == null) {
        $search = $collection->InsertOne($document); //create user and redirect
        $search = $collection->findOne($document);
        session_start();
        $_SESSION['log'] = true;
        $_SESSION['username'] = $username;
        global $json; //define global to pass variables in other file
        $json = $search->JsonSerialize(); //get data in string format
        include 'user.php';
        echo '<script type="text/javascript">  //redirect to user profile
            window.location("user.php");
        </script>';
    } else { //if user already exists, notify user
        echo '
        <script type="text/javascript">
        window.location("home.php");
        </script>
        ';
    }

?>