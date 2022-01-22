<?php

session_start();
$_SESSION = array();
session_destroy();

//lead to login page
header("location: home.html");
?>