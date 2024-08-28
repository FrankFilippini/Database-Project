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
        $stmt = $this->conn->prepare('INSERT INTO `CLIENTI` (`CF`, `nome`, `cognome`, `email`, `numeroTelefono`, `password`)
                                      VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssis', $CF, $nome, $cognome, $email, $numeroTelefono, $password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // O2
    function staffRegister($CF, $nome, $cognome, $email, $password) {
        $stmt = $this->conn->prepare('INSERT INTO `MEMBRI` (`CF`, `nome`, `cognome`, `email`, `password`)
                                        VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssss', $CF, $nome, $cognome, $email, $password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //login Client
    function clientLogin($email, $password) {
        if ($stmt = $this->conn->prepare('SELECT `email`, `password`
                                            FROM `CLIENTI`
                                            WHERE `email` = ?;')) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($email, $password);
            $stmt->fetch();
            if ($stmt->num_rows == 1) {
                return true;
            }
        }
        return false;
    }

    //login Staff
    function staffLogin($email, $password) {
        if ($stmt = $this->conn->prepare('SELECT `email`, `password`
                                            FROM `MEMBRI`
                                            WHERE `email` = ?;')) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($email, $password);
            $stmt->fetch();
            if ($stmt->num_rows == 1) {
                return true;
            }
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
                                    SELECT O.`codiceOmbrellone`
                                    INTO @ombrelloneDisponibile
                                    FROM `OMBRELLONI` O
                                    WHERE O.`codiceOmbrellone` NOT IN (
                                        SELECT T.`codiceOmbrellone`
                                        FROM `PRENOTAZIONI` P
                                        JOIN `TIPOLOGIE` T ON T.`codicePrenotazione` = P.`codicePrenotazione`
                                        WHERE P.`dataInizio` <= ? AND P.`dataFine` >= ?
                                    )
                                    LIMIT 1
                                    FOR UPDATE;

                                    INSERT INTO `PRENOTAZIONI` (`codicePrenotazione`, `codiceCliente`, `dataInizio`, `dataFine`, `mese`)
                                    VALUES (?, ?, ?, ?, ?);

                                    INSERT INTO `TIPOLOGIE` (`codicePrenotazione`, `codiceOmbrellone`, `codiceLettino`, `codicePedalo`, `numeroTavolo`)
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
        $stmt = $this->conn->prepare('INSERT INTO `ISCRIZIONI` (`codiceCliente`, `codiceEvento`)
            SELECT C.`codiceCliente`, E.`codiceEvento`
            FROM `CLIENTI` C, `EVENTI` E
            WHERE C.`codiceCliente` = ? 
            AND E.`codiceEvento` = ?
            AND E.`numeroPosti` > (SELECT COUNT(*)
                      FROM `ISCRIZIONI` I
                      WHERE I.`codiceEvento` = E.`codiceEvento`);');

        $stmt->bind_param('ii', $codiceCliente, $codiceEvento);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //O5
    function addEvent($dataInizio, $dataFine, $numeroPosti, $codiceStaff, $tipoEvento, $nomeEvento) {
        $stmt = $this->conn->prepare('INSERT INTO `EVENTI` (`dataInizio`, `dataFine`, `numeroPosti`, `codiceStaff`, `tipoEvento`, `nomeEvento`)
            VALUES (?, ?, ?, ?, ?, ?)'); 
        $stmt->bind_param('ssiiss',  $dataInizio, $dataFine, $numeroPosti, $codiceStaff, $tipoEvento, $nomeEvento);
        if($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->error);
            return false;
        }
    }

    //O6

    function listReservations() {

    }

    //O7

    function insertReview($codiceCliente, $codiceStaff, $mese, $valutazione) {
        $stmt = $this->conn->prepare('INSERT INTO `RECENSIONI` (`codiceCliente`, `codiceStaff`, `mese`, `valutazione`)
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