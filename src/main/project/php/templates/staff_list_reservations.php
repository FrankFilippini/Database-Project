<header>
    <h1>Starfish</h1>
    <h2>Clients' reservations</h2>
</header>
<nav>
    <ul><li id="reservationslist"><a href="">Reservations list</a></li><li id="newevent"><a href="new_event.php">Add Event</a></li></ul>
</nav>
<main>
    <ul>
    <?php
            foreach($db->getListReservations() as $reservations) {
                ?>
                <li>Prenotazione: <?php echo $reservations['codicePrenotazione'].' - ';?> Cliente: <?php foreach($db->getClientInfo($reservations['codiceCliente']) as $client) {
                    echo $client['nome'].' '.$client['cognome'].',';
                } ?> Data: <?php echo $reservations['dataInizio'].' '.$reservations['dataFine'];?> Mese: <?php echo '  '.$reservations['mese']?></li>
                <?php
            }
        ?>
    </ul>
</main>