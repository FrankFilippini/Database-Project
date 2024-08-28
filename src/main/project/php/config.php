<?php
    define('DIR_BASE', str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(str_replace('\\', '/', __FILE__))).'/');

    function link_to($page) {
        header('Location: '.DIR_BASE.$page);
        exit;
    }

    require_once('database/Database.php');
    $db = new Database('localhost', 'root', '', 'Starfish', 3306);

    // Avoids PATH_INFO insertion, because never used in this website
    if (isset($_SERVER['PATH_INFO'])) {
        header('location: '.$_SERVER['SCRIPT_NAME']);
        exit;
    }

?>