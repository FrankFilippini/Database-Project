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
    function clientRegister($username, $CF, $nome, $cognome, $email, $numeroTelefono, $password) {
        $profileName = 'default.svg';
        $stmt = $this->conn->prepare('INSERT INTO CLIENTI (codiceCliente, CF, nome, cognome, email, numeroTelefono, password)
                                      VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sssssss', $codiceCliente, $CF, $nome, $cognome, $email, $numeroTelefono, $password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // O2
    function staffRegister($codiceStaff, $idTurno, $CF, $nome, $cognome, $email, $password) {
        $profileName = 'default.svg';
        $stmt = $this->conn->prepare('INSERT INTO MEMBRI (codiceStaff, idTurno, CF, nome, cognome, email, password)
                                        VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sssssss', $codiceStaff, $idTurno, $CF, $nome, $cognome, $email, $password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

?>