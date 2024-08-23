<?php
    require_once('config.php');
    $_GET['page'] = 'signin';

    require_once('login.php');
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>