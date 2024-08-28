<?php
require_once('config.php');
    $templateParams['title'] = 'Event';
    $templateParams['page'] = 'events.php';
    $templateParams['css'][] = 'events.css';
    session_start();
    $clientId = $_SESSION['clientId'];
    if(isset($_POST['codiceEvento'])) {
        if($db->bookEvent($clientId, $_POST['codiceEvento'])) {
            echo "prenotazione evento avvenuta con successo";
        }
    }
    require_once('templates/base.php');
?>