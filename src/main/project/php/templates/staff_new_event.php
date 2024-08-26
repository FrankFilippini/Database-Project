<header>
    <h1>Staff area</h1>
    <h2>Add a new event</h2>
</header>
<nav>
    <ul><li id="reservationslist"><a href="list_reservations.php">Reservations list</a></li><li id="newevent"><a href="">Reservations</a></li></ul>
</nav>
<main>
    <section>
        <h3>New Event</h3>
        <form action="#" method="post">
            <ul>
                <li><label for="nomeevento">Nome Evento:</label><input type="text" id="nome" name="nome" required></li>
                <li><label for="dataInizio">Data di inizio:</label><input type="date" id="dataInizio"></li>
                <li><label for="dataFine">Data di fine:</label><input type="date" id="dataFine"></li>
                <li><label for="tipoPrenotazione">Tipologia:</label>
                    <select name="tipoPrenotazione" id="tipoPrenotazione" required>
                        <option value="torneo" selected>Torneo</option>
                        <option value="serata">Serata</option>
                    </select>
                </li>
                <li><label for="numeroposti">Numero di posti:</label><input type="number" id="numeroposti" min="1"></li>
                <li><button type="submit">Crea</button></li>
            </ul>
        </form>
    </section>
</main>