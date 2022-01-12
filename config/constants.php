<?php

    session_start(); //start session
    define('SITE_URL', 'http://localhost/restaurant_website/');
    //define('SITE_URL', 'https://kemos-restaurant.herokuapp.com/');
    
    define('LOCALHOST', 127.0.0.1);
    //define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME','restaurant-order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());//selecting database
?>