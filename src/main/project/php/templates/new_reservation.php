<header>
    <h1>Starfish</h1>
    <h2>New Reservation</h2>
</header>
<nav>
    <ul><li id="home"><a href="home.html">Home</a></li><li id="reservations"><a href="reservation.php">Reservations</a></li><li id="events"><a href="event.php">Events</a></li></ul>
</nav>
<main>
    <section>
        <h3>New Reservation</h3>
        <form action="#" method="post">
            <ul>
                <li><label for="dataInizio">Data di inizio:</label><input type="date" name="dataInizio" id="dataInizio"></li>
                <li><label for="dataFine">Data di fine:</label><input type="date" name="dataFine" id="dataFine"></li>
                <li><label for="tipoPrenotazione">Quale servizio desideri prenotare?:</label></li>
                <li><label for="ombrellone">Seleziona un ombrellone disponibile:</label>
                    <select name="prenotazioneOmbrellone" id="ombrellone" required>
                        <option value="NULL"></option>
                        <?php foreach($db->getOmbrelloni() as $ombrellone) {
                            ?> <option value="<?php echo $ombrellone['codiceOmbrellone']; ?>"><?php echo $ombrellone['codiceOmbrellone']; ?></option>
                            <?php
                        } ?>
                    </select>
                </li>
                <li><label for="lettino">Seleziona un lettino disponibile:</label>
                    <select name="prenotazioneLettino" id="lettino" required>
                        <option value="NULL"></option>
                        <?php foreach($db->getLettini() as $lettino) {
                            ?> <option value="<?php echo $lettino['codiceLettino']; ?>"><?php echo $lettino['codiceLettino']; ?></option>
                            <?php
                        } ?>
                    </select>
                </li>
                <li><label for="pedalo">Seleziona un pedalò disponibile:</label>
                    <select name="prenotazionePedalo" id="pedalo" required>
                        <option value="NULL"></option>
                        <?php foreach($db->getPedalo() as $pedalo) {
                            ?> <option value="<?php echo $pedalo['codicePedalò']; ?>"><?php echo $pedalo['codicePedalò']; ?></option>
                            <?php
                        } ?>
                    </select>
                </li>
                <li>
                <label>Vuoi prenotare un tavolo?</label>
                <input type="radio" id="si" name="prenotazioneTavolo" value="si" onclick="showTavoloSelector()">
                <label for="si">Sì</label>
                <input type="radio" id="no" name="prenotazioneTavolo" value="no" onclick="hideTavoloSelector()">
                <label for="no">No</label></li>
                <li>
                <div id="tavolo-selector" style="display: none;">
                    <label for="numeroPersone">Numero di persone:</label>
                    <input type="number" name="numeroPersone" id="numeroPersone" min="1" required>
                </div>
                </li>
                
                <li><button type="submit">Prenota</button></li>
            </ul>
        </form>
    </section>
</main>
<script>
    function showTavoloSelector() {
        document.getElementById("tavolo-selector").style.display = "block";
    }

    function hideTavoloSelector() {
        document.getElementById("tavolo-selector").style.display = "none";
    }
</script>