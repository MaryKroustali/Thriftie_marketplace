<?php

    include 'config.php';

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
    $result = $collection_users->findOneAndUpdate(["email" => $username, "password" => $password],['$set' => $document]);

    //execute js code to redirect
    echo '
    <script type="text/javascript">  //redirect to user profile
        window.location.replace("user.php");
    </script>
    ';

?>

