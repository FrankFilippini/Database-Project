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

    //O3
    function newReservation($dataInizio, $dataFine, $codiceCliente, $mese, $codiceOmbrellone, $codiceLettino, $codicePedalo, $numeroTavolo) {
        // First, insert into PRENOTAZIONI
        $stmt1 = $this->conn->prepare('INSERT INTO `PRENOTAZIONI`(`dataInizio`, `dataFine`, `codiceCliente`, `mese`)
                                        VALUES (?, ?, ?, ?)');
        $stmt1->bind_param('ssis', $dataInizio, $dataFine, $codiceCliente, $mese);
        $stmt1->execute();
        $prenotazione_id = $this->conn->insert_id; // Get the ID of the newly inserted record
    
        // Then, insert into TIPOLOGIE
        $stmt2 = $this->conn->prepare('INSERT INTO `TIPOLOGIE`(`codicePrenotazione`, `codiceOmbrellone`, `codiceLettino`, `numeroTavolo`, `codicePedalò`)
                                        VALUES (?, ?, ?, ?, ?)');
        $stmt2->bind_param('iiiii', $prenotazione_id, $codiceOmbrellone, $codiceLettino, $numeroTavolo, $codicePedalo);
        if ($stmt2->execute()) {
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
    function getListReservations() {
        $stmt = $this->conn->prepare('SELECT * FROM `PRENOTAZIONI`');
        $stmt->execute();
        $result = $stmt->get_result();
        $reservationsList = array();
        while ($row = $result->fetch_assoc()) {
            $reservationsList[] = $row;
        }
        return $reservationsList;
    }

    //O7
    function insertReview($codiceCliente, $codiceStaff, $mese, $valutazione) {
        $stmt = $this->conn->prepare('INSERT INTO `RECENSIONI` (`codiceCliente`,`valutazione`, `codiceStaff`, `mese`)
            VALUES (?, ?, ?, ?)');
        $stmt->bind_param('iiii',$codiceCliente, $valutazione, $codiceStaff, $mese);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //O8
    function getBestRatedStaffMembers() {
        // Query SQL per ottenere i membri dello staff con la migliore valutazione media
        $sql = "
            SELECT 
                M.`codiceStaff`, 
                M.`nome`, 
                M.`cognome`,
                AVG(R.`valutazione`) AS `media_valutazioni`
            FROM 
                `STORICO_RECENSIONI` SR
                JOIN `RECENSIONI` R ON SR.`mese` = R.`mese`
                JOIN `MEMBRI` M ON M.`codiceStaff` = R.`codiceStaff`
            GROUP BY 
                M.`codiceStaff`, M.`nome`, M.`cognome`
            ORDER BY 
                `media_valutazioni` DESC
            LIMIT 5;
        ";
    
        // Preparare lo statement
        if ($stmt = $this->conn->prepare($sql)) {
            // Eseguire lo statement
            if ($stmt->execute()) {
                // Recuperare il risultato
                $result = $stmt->get_result();
                
                // Controlla se ci sono risultati
                if ($result->num_rows > 0) {
                    // Restituisce un array associativo contenente i dati
                    return $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    // Nessun membro trovato
                    return [];
                }
            } else {
                // Errore nell'esecuzione della query
                echo "Errore nell'esecuzione della query: " . $stmt->error;
                return [];
            }
        } else {
            // Errore nella preparazione della query
            echo "Errore nella preparazione della query: " . $this->conn->error;
            return [];
        }
    }

    //O9
    function getWorstRatedStaffMembers() {
        // Query SQL per ottenere i membri dello staff con la migliore valutazione media
        $sql = "
            SELECT 
                M.`codiceStaff`, 
                M.`nome`, 
                M.`cognome`,
                AVG(R.`valutazione`) AS `media_valutazioni`
            FROM 
                `STORICO_RECENSIONI` SR
                JOIN `RECENSIONI` R ON SR.`mese` = R.`mese`
                JOIN `MEMBRI` M ON M.`codiceStaff` = R.`codiceStaff`
            GROUP BY
                M.`codiceStaff`, M.`nome`, M.`cognome`
            ORDER BY
                `media_valutazioni`
        ";
    
        // Preparare lo statement
        if ($stmt = $this->conn->prepare($sql)) {
            // Eseguire lo statement
            if ($stmt->execute()) {
                // Recuperare il risultato
                $result = $stmt->get_result();
                
                // Controlla se ci sono risultati
                if ($result->num_rows > 0) {
                    // Restituisce un array associativo contenente i dati
                    return $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    // Nessun membro trovato
                    return [];
                }
            } else {
                // Errore nell'esecuzione della query
                echo "Errore nell'esecuzione della query: " . $stmt->error;
                return [];
            }
        } else {
            // Errore nella preparazione della query
            echo "Errore nella preparazione della query: " . $this->conn->error;
            return [];
        }
    }

    //O10
    function getBestClients($mese) {
        // La query SQL per trovare i migliori clienti in base ai giorni prenotati nel mese specificato
        $sql = "
            SELECT 
                P.codiceCliente,
                SUM(DATEDIFF(P.dataFine, P.dataInizio)) AS giorni_prenotati 
            FROM 
                PRENOTAZIONI P 
                JOIN LISTINI L ON L.mese BETWEEN MONTH(P.dataInizio) AND MONTH(P.dataFine)
            WHERE 
                L.mese = ? 
            GROUP BY 
                P.codiceCliente 
            ORDER BY 
                giorni_prenotati DESC 
            LIMIT 5;
        ";
    
        // Preparare lo statement
        if ($stmt = $this->conn->prepare($sql)) {
            // Bind del parametro 'mese'
            $stmt->bind_param('i', $mese);
    
            // Eseguire lo statement
            if ($stmt->execute()) {
                // Recuperare il risultato
                $result = $stmt->get_result();
                
                // Controlla se ci sono risultati
                if ($result->num_rows > 0) {
                    // Restituisce un array associativo contenente i dati
                    $bestClients = $result->fetch_all(MYSQLI_ASSOC);
                    $stmt->close(); // Chiudere lo statement
                    return $bestClients;
                } else {
                    // Nessun cliente trovato
                    $stmt->close(); // Chiudere lo statement
                    return [];
                }
            } else {
                // Errore nell'esecuzione della query
                echo "Errore nell'esecuzione della query: " . $stmt->error;
                $stmt->close(); // Chiudere lo statement
                return [];
            }
        } else {
            // Errore nella preparazione della query
            echo "Errore nella preparazione della query: " . $this->conn->error;
            return [];
        }
    }

    //O11

    function getBestWorker() {
        // La query SQL per trovare il membro che ha lavorato di più nel mese di Giugno 2024
        $sql = "
            SELECT M.`nome`, M.`cognome`, SUM(TIMESTAMPDIFF(MINUTE, T.`oraInizio`, T.`oraFine`)) AS `minuti_lavorati` 
            FROM 
                `AGENDE_DEI_TURNI` A 
                JOIN `MEMBRI` M ON A.`codiceStaff` = M.`codiceStaff` 
                JOIN `TURNI_DI_LAVORO` T ON A.`idTurno` = T.`idTurno` 
            WHERE 
                A.`dataTurno` BETWEEN ? AND ?
            GROUP BY 
                M.`codiceStaff`, M.`nome`, M.`cognome` 
            ORDER BY 
                `minuti_lavorati` DESC 
            LIMIT 1;
        ";
    
        // Preparare lo statement
        if ($stmt = $this->conn->prepare($sql)) {
            // Bind dei parametri per le date di inizio e fine
            $startDate = '2024-06-01';
            $endDate = '2024-06-30';
            $stmt->bind_param("ss", $startDate, $endDate);
    
            // Eseguire lo statement
            if ($stmt->execute()) {
                // Recuperare il risultato
                $result = $stmt->get_result();
                
                // Controlla se ci sono risultati
                if ($result->num_rows > 0) {
                    // Restituisce i dati del miglior lavoratore
                    return $result->fetch_assoc();
                } else {
                    // Nessun lavoratore trovato
                    return null;
                }
            } else {
                // Errore nell'esecuzione della query
                echo "Errore nell'esecuzione della query: " . $stmt->error;
                return null;
            }
        } else {
            // Errore nella preparazione della query
            echo "Errore nella preparazione della query: " . $this->conn->error;
            return null;
        }
    }

    //FUNZIONI DI APPOGGIO
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

    function getClientId($email) {
        if ($stmt = $this->conn->prepare('SELECT `codiceCliente`
                                            FROM `CLIENTI`
                                            WHERE `email` = ?;')) 
        {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row) {
                return $row['codiceCliente'];
            } else {
                return false;
            }
        } 
        return false;
    }

    function getClientInfo($id) {
        if ($stmt = $this->conn->prepare('SELECT *
                                            FROM `CLIENTI`
                                            WHERE `codiceCliente` = ?;')) 
        {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $clientsList = array();
            while ($row = $result->fetch_assoc()) {
                $clientsList[] = $row;
            }
        } 
        return $clientsList;
    }

    //login Staff
    function staffLogin($email, $password) {
        if ($stmt = $this->conn->prepare('SELECT `email`, `password`
                                            FROM `MEMBRI`
                                            WHERE `email` = ?;'))
        {
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

    function getStaffId($email) {
        if ($stmt = $this->conn->prepare('SELECT `codiceStaff`
                                            FROM `MEMBRI`
                                            WHERE `email` = ?;')) 
        {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row) {
                return $row['codiceStaff'];
            } else {
                return false;
            }
        } 
        return false;
    }

    function getOmbrelloni() {
        $stmt = $this->conn->prepare('SELECT `codiceOmbrellone`
                                        FROM `OMBRELLONI`
                                        WHERE NOT EXISTS (
                                        SELECT 1
                                        FROM `TIPOLOGIE`
                                        WHERE `TIPOLOGIE`.`codiceOmbrellone` = `OMBRELLONI`.`codiceOmbrellone`
                                        )');
        $stmt->execute();
        $result = $stmt->get_result();
        $ombrelloniList = array();
        while ($row = $result->fetch_assoc()) {
            $ombrelloniList[] = $row;
        }
        if (empty($ombrelloniList)) {
            $stmt = $this->conn->prepare('SELECT `codiceOmbrellone` FROM `OMBRELLONI`');
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $ombrelloniList[] = $row;
            }
        }
        return $ombrelloniList;
    }

    function getLettini() {
        $stmt = $this->conn->prepare('SELECT `codiceLettino`
                                        FROM `LETTINI`
                                        WHERE NOT EXISTS (
                                        SELECT 1
                                        FROM `TIPOLOGIE`
                                        WHERE `TIPOLOGIE`.`codiceLettino` = `LETTINI`.`codiceLettino`
                                        )');
        $stmt->execute();
        $result = $stmt->get_result();
        $lettiniList = array();
        while ($row = $result->fetch_assoc()) {
            $lettiniList[] = $row;
        }
        if (empty($lettiniList)) {
            $stmt = $this->conn->prepare('SELECT `codiceLettino` FROM `LETTINI`');
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $lettiniList[] = $row;
            }
        }
        return $lettiniList;
    }

    function getPedalo() {
        $stmt = $this->conn->prepare('SELECT `codicePedalò`
                                        FROM `PEDALO`
                                        WHERE NOT EXISTS (
                                        SELECT 1
                                        FROM `TIPOLOGIE`
                                        WHERE `TIPOLOGIE`.`codicePedalò` = `PEDALO`.`codicePedalò`
                                        )');
        $stmt->execute();
        $result = $stmt->get_result();
        $pedaloList = array();
        while ($row = $result->fetch_assoc()) {
            $pedaloList[] = $row;
        }
        if (empty($pedaloList)) {
            $stmt = $this->conn->prepare('SELECT `codicePedalo` FROM `PEDALO`');
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $pedaloList[] = $row;
            }
        }
        return $pedaloList;
    }

    function insertTavolo($numeroPersone) {
        $stmt = $this->conn->prepare('INSERT INTO `TAVOLI` (`numeroPersone`)
                                        VALUES (?)');
        $stmt->bind_param('i', $numeroPersone);

        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    function getEventsList() {
        $stmt = $this->conn->prepare('SELECT * FROM `EVENTI`');
        $stmt->execute();
        $result = $stmt->get_result();
        $eventsList = array();
        while ($row = $result->fetch_assoc()) {
            $eventsList[] = $row;
        }
        return $eventsList;
    }

    function getReservationsFromId($id) {
        if ($stmt = $this->conn->prepare('SELECT * FROM `PRENOTAZIONI` WHERE `codiceCliente` = ?')) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $reservations = array();
            while ($row = $result->fetch_assoc()) {
                $reservations[] = $row;
            }
            if (!empty($reservations)) {
                return $reservations;
            } else {
                return false;
            }
        }
    }

    function getMonthFromReservation($id) {
        if($stmt = $this->conn->prepare('SELECT `mese` FROM `PRENOTAZIONI` WHERE `codicePrenotazione` = ?')) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['mese'];
        }
        return null; // or some default value if no result is found
    }
    function getMembersByDate($date_input) {
        $date_parts = explode('-', $date_input);
        $day = $date_parts[2];
        $month = $date_parts[1];
      
        $stmt = $this->conn->prepare("SELECT * 
                                 FROM MEMBRI 
                                 WHERE giorno = ? AND mese = ?");
      
        $stmt->bind_param("ii", $day, $month);
      
        $stmt->execute();
      
        $result = $stmt->get_result();
        $members = array();
        while ($row = $result->fetch_assoc()) {
          $members[] = $row;
        }
      
        $stmt->close();
      
        return $members;
    }

    function adminLogin($email, $password) {
        if ($stmt = $this->conn->prepare('SELECT `email`, `password`
                                            FROM `AMMINISTRATORI`
                                            WHERE `email` = ?;'))
        {
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
}
?>