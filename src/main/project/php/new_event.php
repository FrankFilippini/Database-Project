<?php
    require_once('config.php');

    $templateParams['title'] = 'Staff - New Event';
    $templateParams['page'] = 'staff_new_event.php';
    $templateParams['css'][] = 'events.css';
    if(isset($_POST['nomeevento'])) {
        if($db->addEvent($_POST['datainizio'], $_POST['datafine'], $_POST['numeroposti'], 1, $_POST['tipoevento'], $_POST['nomeevento'])) {
            link_to('new_event.php');
        }
        echo 'test';
    }
    require_once('templates/base.php');
?>