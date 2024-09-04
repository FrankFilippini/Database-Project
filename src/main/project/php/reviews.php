<?php
require_once('config.php');
$templateParams['title'] = 'Reviews';
$templateParams['page'] = 'client_reviews.php';
$templateParams['css'][] = 'client_reviews.css';
session_start();
$clientId = $_SESSION['clientId'];
$templateParams['clientId'] = $_SESSION['clientId'];
$templateParams['reservations'][] = $db->getReservationsFromId($clientId);

//TODO Inserire funzione per ricavare il mese
if(isset($_POST['invia'])) {
    if($db->insertReview($clientId, $_POST['codiceStaff'], 6, $_POST['numeroStelle'])) {
        echo "ok";
    }
}
require_once('templates/base.php');
?>