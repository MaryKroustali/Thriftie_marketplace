<?php //connect to db

    require '../vendor/autoload.php';

    $m = new MongoDB\Client("mongodb://127.0.0.1/");  //connection
    $db = $m->Thriftie_DB; //database
    $collection_products = $db->Products;
    $collection_users = $db->User;

?>