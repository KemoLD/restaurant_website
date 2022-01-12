<?php

    include('../config/constants.php');

    session_destroy(); //destroys $_SESSION['user']
    header('location:'.SITE_URL.'admin/login.php');


?>