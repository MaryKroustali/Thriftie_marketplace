<?php

    include 'config.php';  //connect to db
    session_start();
    if (isset($_SESSION['log']) && $_SESSION['log'] == true) {
        $user = $collection_users->findOne(["email" => $_SESSION['username']]);
    } else {
        echo '<script>window.location.replace("sell.html");</script>';
        exit();
    }

    //call to delete product
    if ($_GET['action'] == 'delete') {
        $delete = $collection_products->DeleteOne(["name" => $_GET['product']]);
        echo '<script>window.location.replace("user.php");</script>';
        exit();
    }

    //get product images
    $files = $_POST['files'];  //multiple files uploaded
    $array_files = new stdClass();
    $i = 1;
    foreach ($files as $file) {
        $file = substr($file, 0, -4); //remove .jpg,.png
        $file = 'items/'.$file;  //add to file items
        $key = 'pic'.$i; //create key, value
        $array_files->$key = $file;
        $i++;
    }
    //get product name
    $name = $_POST['name'];
    //get product description
    $description = $_POST['descr'];
    //get product price
    $price = $_POST['price'].'$';
    //get product size
    if (isset($_POST['size'])) {  //check if not required fields have values
        $size = $_POST['size'];
    } else {
        $size = 'Not Available';
    }
    //get product fit
    if (isset($_POST['fit'])) {
        $fit = $_POST['fit'];
    } else {
        $fit = 'Not Available';
    }
    //get product materials
    if (isset($_POST['materials'])) {
        $materials = $_POST['materials']; //array of multiple materials
        $array_materials = [];
        foreach ($materials as $material) {
            array_push($array_materials, $material);
        }
    } else {
        $array_materials = [0 => 'Not Available'];
    }

    $document = array(  //create document
            "images" => $array_files,
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "size" => $size,
            "fit" => $fit,
            "materials" => $array_materials,
            "category" => '', //for admin
            "seller" => $user->email
        );

    //call to edit product
    if ($_GET['action'] == 'update') {
        $update = $collection_products->UpdateOne(["name" => $_GET['name']], ['$set' => $document]);
    }
    //call to add product
    else {
        $search = $collection_products->InsertOne($document);
    }

    echo '<script>window.history.back();</script>';

?>