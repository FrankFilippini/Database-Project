<?php
// Alessandro Verna
class Database {
    private $conn;

    function __construct($serverName, $username, $password, $connName, $port) {
        // Reports MySQL errors
        // mysqli_report(MYSQLI_REPORT_ALL);
        mysqli_report(MYSQLI_REPORT_STRICT);
        $this->conn = new mysqli($serverName, $username, $password, $connName, $port);
        if (mysqli_connect_errno()) {
            $error = mysqli_connect_error();
            die("Connection with MySQL failed: ".$error);
        }
    }

    function __destruct() {
        $this->conn->close();
    }

    // O1
    function clientRegister($CF, $nome, $cognome, $email, $numeroTelefono, $password) {
        $profileName = 'default.svg';
        $stmt = $this->conn->prepare('INSERT INTO CLIENTI (CF, nome, cognome, email, numeroTelefono, password)
                                      VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssis', $CF, $nome, $cognome, $email, $numeroTelefono, $password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // O2
    function staffRegister($idTurno, $CF, $nome, $cognome, $email, $password) {
        $profileName = 'default.svg';
        $stmt = $this->conn->prepare('INSERT INTO MEMBRI (idTurno, CF, nome, cognome, email, password)
                                        VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('isssss', $idTurno, $CF, $nome, $cognome, $email, $password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //O3

    function bookUmbrella($codiceCliente, $dataInizio, $dataFine, $mese, $codiceLettino, $codicePedalo, $numeroTavolo) {
        $stmt = $this->conn->prepare('SELECT o.codiceOmbrellone
            FROM OMBRELLONI o
            WHERE o.codiceOmbrellone NOT IN (
                SELECT t.codiceOmbrellone
                FROM PRENOTAZIONI p
                JOIN TIPOLOGIE t ON t.codicePrenotazione = p.codicePrenotazione
                WHERE p.dataInizio <= ? AND p.dataFine >= ?
            )
        ');
    
        $stmt->bind_param('ss', $dataInizio, $dataFine);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $stmt = $this->conn->prepare('
                INSERT INTO PRENOTAZIONI (codicePrenotazione, codiceCliente, dataInizio, dataFine, mese)
                VALUES (?, ?, ?, ?, ?);
            ');
            $stmt->bind_param('iisss', $codicePrenotazione, $codiceCliente, $dataInizio, $dataFine, $mese);
            $stmt->execute();
    
            $stmt = $this->conn->prepare('
                INSERT INTO TIPOLOGIE (codiceOmbrellone, codiceLettino, codicePedalo, numeroTavolo)
                VALUES ((SELECT MAX(codicePrenotazione) FROM PRENOTAZIONI), ?, ?, ?, ?);
            ');
            $stmt->bind_param('iiii', $codiceOmbrellone, $codiceLettino, $codicePedalo, $numeroTavolo);
            $stmt->execute();
    
            return 1; // booking successful
        } else {
            return 0; // no available umbrella
        }
    }

    //O4
    function bookEvent($codiceCliente, $codiceEvento) {
        $stmt = $this->conn->prepare('INSERT INTO ISCRIZIONI (codiceCliente, codiceEvento)
            SELECT C.codiceCliente, E.codiceEvento
            FROM CLIENTI C, EVENTI E
            WHERE C.codiceCliente = ? 
            AND E.codiceEvento = ?
            AND E.numeroPosti > (SELECT COUNT(*)
                      FROM ISCRIZIONI I
                      WHERE I.codiceEvento = E.codiceEvento);');

        $stmt->bind_param('ii', $codiceCliente, $codiceEvento);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //O5
    function addEvent($codiceStaff, $dataInizio, $dataFine, $numeroPosti) {
        $stmt = $this->conn->prepare('INSERT INTO EVENTI (codiceStaff, dataInizio, dataFine, numeroPosti)
            VALUES (?, ?, ?, ?, ?)'); 
        $stmt->bind_param('issi', $codiceStaff, $dataInizio, $dataFine, $numeroPosti);
         if($stmt->execute()) {
             return true;
         } else {
             return false;
         }
    }

    //O6

    function listReservations() {

    }

    //O7

    function insertReview($codiceCliente, $codiceStaff, $mese, $valutazione) {
        $stmt = $this->conn->prepare('INSERT INTO RECENSIONI (codiceCliente, codiceStaff, mese, valutazione)
            VALUES (?, ?, ?, ?)');
        $stmt->bind_param('iisi',$codiceCliente, $codiceStaff, $mese, $valutazione);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>