<?php
    require_once('config.php');
    $templateParams['title'] = 'Reservation';
    $templateParams['page'] = 'new_reservation.php';
    $templateParams['css'][] = 'newreservation.css';
    session_start();
    $clientId = $_SESSION['clientId'];
    if(isset($_POST['prenotazioneOmbrellone'])) {
        if(isset($_POST['prenotazioneTavolo'])) {
            $codiceTavolo = $db->insertTavolo($_POST['numeroPersone']);
        }
        if($db->newReservation($_POST['dataInizio'], $_POST['dataFine'], $_SESSION['clientId'], 6, $_POST['prenotazioneOmbrellone'], $_POST['prenotazioneLettino'], $_POST['prenotazionePedalo'], $codiceTavolo) ) {
            echo "Prenotazione avvenuta con successo";
        }
    }
    require_once('templates/base.php');
?>