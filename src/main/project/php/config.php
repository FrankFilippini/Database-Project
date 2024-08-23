<?php
    define('DIR_BASE', str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(str_replace('\\', '/', __FILE__))).'/');

    require_once('database/Database.php');
    $db = new Database('localhost', 'root', '', 'Starfish', 3306);
    $templateParams = array();
?>