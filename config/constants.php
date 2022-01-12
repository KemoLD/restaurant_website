<?php

use Dotenv\Dotenv;

    session_start(); //start session
    //define('SITE_URL', 'http://localhost/restaurant_website/');
    define('SITE_URL', 'https://kemos-restaurant.herokuapp.com/');
    
    //define('LOCALHOST', 'localhost');
    //define('DB_USERNAME', 'root');
    //define('DB_PASSWORD', '');
    //define('DB_NAME','restaurant-order');

    //$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //database connection
    //$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());//selecting database

    //$conn = mysqli_connect($_ENV['CLEARDB_SERVER'], $_ENV['CLEARDB_USERNAME'], $_ENV['CLEARDB_PASSWORD']);
    //$db_select = mysqli_select_db($conn,$_ENV['CLEARDB_DB']);
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"],1);
    $active_group = 'default';
    $query_builder = TRUE;
    // Connect to DB
    $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
    $db_select = mysqli_select_db($conn, $cleardb_db);

?>