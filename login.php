<?php
    //start xampp/apache
    //start mongo -> (adm) net start mongodb
    //start mongo shell -> (adm) mongo
    //access php files localhost/pr1/final/login.php
    require '../vendor/autoload.php';

    $m = new MongoDB\Client("mongodb://127.0.0.1/");  //connection
    $db = $m->Thriftie_DB; //database
    $collection = $db->users; //collection

?>