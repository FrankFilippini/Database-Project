<?php
    require_once('config.php');

    $templateParams['title'] = 'Staff - New Event';
    $templateParams['page'] = 'staff_new_event.php';
    $templateParams['css'][] = 'events.css';
    session_start();
    $staffId = $_SESSION['staffId'];
    if(isset($_POST['nomeevento'])) {
        if($db->addEvent($_POST['datainizio'], $_POST['datafine'], $_POST['numeroposti'], $staffId, $_POST['tipoevento'], $_POST['nomeevento'])) {
            link_to('new_event.php');
        }
        echo 'test';
    }
    require_once('templates/base.php');
?>