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
        $stmt = $this->conn->prepare("START TRANSACTION;
                                        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION 
                                        BEGIN 
                                        ROLLBACK; 
                                        SELECT 'Error during the booking process' AS error_message; 
                                        END;
                                    SELECT O.codiceOmbrellone
                                    INTO @ombrelloneDisponibile
                                    FROM OMBRELLONI O
                                    WHERE O.codiceOmbrellone NOT IN (
                                        SELECT T.codiceOmbrellone
                                        FROM PRENOTAZIONI P
                                        JOIN TIPOLOGIE T ON T.codicePrenotazione = P.codicePrenotazione
                                        WHERE P.dataInizio <= ? AND P.dataFine >= ?
                                    )
                                    LIMIT 1
                                    FOR UPDATE;

                                    INSERT INTO PRENOTAZIONI (codicePrenotazione, codiceCliente, dataInizio, dataFine, mese)
                                    VALUES (?, ?, ?, ?, ?);

                                    INSERT INTO TIPOLOGIE (codicePrenotazione, codiceOmbrellone, codiceLettino, codicePedalo, numeroTavolo)
                                    VALUES (LAST_INSERT_ID(), @ombrelloneDisponibile, ?, ?, ?);
                                    COMMIT;
                                ");
    
        $stmt->bind_param('ssiisssiiii', $dataInizio, $dataFine, $codicePrenotazione, $codiceCliente, $dataInizio, $dataFine, $mese, $codiceOmbrellone, $codiceLettino, $codicePedalo, $numeroTavolo);
    
        if($stmt->execute()) {
            return true;
        } else {
            return false;
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