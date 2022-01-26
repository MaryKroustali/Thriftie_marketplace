<?php

    require '../vendor/autoload.php';
    include 'config.php';  //connect to db

    if ($_GET['action'] == 'delete') {
        $delete = $collection_products->DeleteOne(["name" => $_GET['name']]);
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
            "category" => '' //for admin
        );

    if ($_GET['action'] == 'update') {
        $document["seller"] = $_GET['user'];
        $update = $collection_products->UpdateOne(["name" => $_GET['name']], ['$set' => $document]);
    }
    else {
        $search = $collection_products->InsertOne($document);
    }

    echo '<script>window.location.replace("user.php");</script>';

?>