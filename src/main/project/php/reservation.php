<?php
    require_once('config.php');
    $templateParams['title'] = 'Reservation';
    $templateParams['page'] = 'new_reservation.php';
    $templateParams['css'][] = 'newreservation.css';
    session_start();
    $clientId = $_SESSION['clientId'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['dataInizio'] <= $_POST['dataFine']) {
            if(isset($_POST['prenotazioneOmbrellone']) || isset($_POST['prenotazionePedalo']) || isset($_POST['prenotazioneLettino'])) {
              
                if(isset($_POST['prenotazioneOmbrellone']) && !($_POST['prenotazioneOmbrellone'] === "")) {
                    $codiceOmbrellone = $_POST['prenotazioneOmbrellone'];
                } else {
                    $codiceOmbrellone = NULL;
                }

                if(isset($_POST['prenotazioneLettino']) && !($_POST['prenotazioneLettino'] === "")) {
                    $codiceLettino = $_POST['prenotazioneLettino'];
                } else {
                    $codiceLettino = NULL;
                }

                if(isset($_POST['prenotazionePedalo']) && !($_POST['prenotazionePedalo'] === "")) {
                    $codicePedalo = $_POST['prenotazionePedalo'];
                } else {
                    $codicePedalo = NULL;
                }

                if(isset($_POST['prenotazioneTavolo'])) {
                    $codiceTavolo = $db->insertTavolo($_POST['numeroPersone']);
                } else {
                    $codiceTavolo = NULL;
                }
                $date_arr = explode('-',$_POST['dataInizio']);
                $month = intval($date_arr[1]);
                if($db->newReservation($_POST['dataInizio'], $_POST['dataFine'], $_SESSION['clientId'], $month, $codiceOmbrellone, $codiceLettino, $codicePedalo, $codiceTavolo) ) {
                    echo "Prenotazione avvenuta con successo";
                }
            }
        }else {
            echo 'La data di inizio deve essere precedente alla data di fine.';
        }
    }
    require_once('templates/base.php');
?>