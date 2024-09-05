<header>
    <h1>Starfish</h1>
    <h2>Reviews</h2>
</header>
<nav>
    <ul><li id="reviews"><a href="reviews.php">Reviews</a></li><li id="reservations"><a href="reservation.php">Reservations</a></li><li id="events"><a href="event.php">Events</a></li></ul>
</nav>
<main>
    <?php
    $id = $templateParams['clientId'];
    $reservations = $templateParams['reservations'];
    if ($reservations === false) {
        echo '<p>Prenota almeno una volta per accedere alle rewiews</p>';
    } else {
        // display reviews or other content if the user has made reservations
        echo '<p>Benvenuto! Ecco le tue recensioni:</p>';
        // display reviews or other content here
        ?>
        <ul>
        <?php
            foreach($reservations as $reservation) {
                ?>
                <li>Prenotazione: <?php echo $reservation['codicePrenotazione']."\t";
                $_SESSION['codicePrenotazione'] = $reservation['codicePrenotazione'];?>
                <ul>
                    <li>
                        Staff: <?php 
                        foreach($db->getMembersByDate($reservation['dataInizio']) as $staff) {
                            echo ' '.$staff['codiceStaff'].' '.$staff['nome'].' '.$staff['cognome']."  -  ";
                        }
                        ?> Data: <?php echo $reservation['dataInizio'].' '.$reservation['dataFine'];?> Mese: <?php echo '  '.$reservation['mese']?>
                        <form action="" method="POST">
                            <ul>
                            <li><label for="codiceStaff">Codice Staff:</label>
                                <input type="number" id="codiceStaff" name="codiceStaff">
                            </li>
                            <li><label for="mese">Mese:</label>
                                <input type="number" id="mese" name="mese" value="<?php echo $reservation['mese'];?>" min="<?php echo $reservation['mese'];?>" max="<?php echo $reservation['mese'];?>">
                            </li>
                            <li><label for="numeroStelle">Stelle:</label>
                                <input type="number" id="numeroStelle" name="numeroStelle" max="5" min="1">
                            </li>
                            <li><label for="invia" hidden>Invia</label><input name="invia" id="invia" type="submit"/></li>
                            </ul>
                        </form>
                    </li>
                </ul>
                </li>
                <?php
            }
        ?>
        </ul>
        <?php
    }
    ?>
</main>