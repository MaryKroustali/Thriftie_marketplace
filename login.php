<?php

    include 'config.php';
    session_start();

    $username = $_POST['login_email'];
    $password = $_POST['login_pass'];
    //create document to insert
    $document = array(
        "email" => $username,
        "password" => $password,
    );
    //execute query
    $result = $collection_users->findOne($document);

    //check if query got any results, execute js code to redirect
    if ($result != null) {
        $_SESSION['log'] = true;  //create session
        $_SESSION['username'] = $username;
        echo '
        <script type="text/javascript">  //redirect to user profile
            window.location.replace("user.php");
        </script>
        ';
    } else {
        //TO DO FIX
        header("location: home.php");
    }

?>

