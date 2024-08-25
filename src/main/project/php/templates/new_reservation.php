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
                <li><label for="nome">Nome:</label><input type="text" id="nome" name="nome" required></li>
                <li><label for="cognome">Cognome:</label><input type="text" id="cognome" name="cognome" required></li>
                <li><label for="dataInizio">Data di inizio:</label><input type="date" id="dataInizio"></li>
                <li><label for="dataFine">Data di fine:</label><input type="date" id="dataFine"></li>
                <li><label for="tipoPrenotazione">Tipologia:</label>
                    <select name="tipoPrenotazione" id="tipoPrenotazione" required>
                        <option value="ombrellone" selected>Ombrellone</option>
                        <option value="lettino">Lettino</option>
                        <option value="pedalo">Pedalò</option>
                    </select>
                </li>
                <li><label for="telefono">Numero di Telefono:</label><input type="tel" id="telefono" name="telefono" required></li>
                <li><button type="submit">Prenota</button></li>
            </ul>
        </form>
    </section>
</main>