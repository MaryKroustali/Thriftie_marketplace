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
        if (str_contains($result->email, "admin")) { //if user is an admin
            echo '<script type="text/javascript">  //redirect to user profile
                    window.location.replace("Admin_Home.html");
                </script>';
        } else { //if user is a client redirect to his profile
            echo '<script type="text/javascript">  //redirect to user profile
                    window.location.replace("user.php");
                </script>';
        }
    } else {
        echo '
        <script type="text/javascript">  //redirect to user profile
            window.location.replace("error.php?msg=Incorrect email or password.");
        </script>
        ';
    }

?>

