<?php

    include 'config.php'; //connect to db

    $user = $collection_users->findOne(['email' => $_GET['user']]);  //find buyer
    $product = $collection_products->findOne(['name' => $_GET['product']]); //find product

    foreach ((array)$user->orders as $order) {
        if (in_array( $_GET['product'], (array)$order)) {
            $key = array_search($_GET['product'], (array)$order);  //get position of item in orders
            unset($order[$key]);  //delete item from order array
        }
    }
    //update order total
    foreach ($order as $item) {
        if (gettype($item) == 'object') {
            $item->total = $item->total - $product->price;
        }
    }

    $result = $collection_users->UpdateOne(["email" => $_GET['user']], ['$set' => [ 'orders' => (array)$user->orders]]); //cancel order

    //if no other products on this order, delete order
    if (count((array)$order) == 1) {  //get length of array, if one product and total only delete all
        $key = array_search($order, (array)$user->orders);  //get position of item in orders
        unset($user->orders[$key]);  //delete item from order array
        $result = $collection_users->UpdateOne(["email" => $_GET['user']], ['$set' => [ 'orders' => (array)$user->orders]]); //cancel order
    }

    echo '<script>window.location=document.referrer;</script>'; //return to previous page and reload

?>