<header>
    <h1>Staff area</h1>
    <h2>Add a new event</h2>
</header>
<nav>
    <ul><li id="reservationslist"><a href="list_reservations.php">Reservations list</a></li><li id="newevent"><a href="">Add Event</a></li></ul>
</nav>
<main>
    <section>
        <h3>New Event</h3>
        <form action="" method="POST">
            <ul>
                <li><label for="nomeevento">Nome Evento:</label><input type="text" id="nomeevento" name="nomeevento" required></li>
                <li><label for="datainizio">Data di inizio:</label><input type="date" id="datainizio" name="datainizio" required></li>
                <li><label for="datafine">Data di fine:</label><input type="date" id="datafine" name="datafine" required></li>
                <li><label for="tipoevento">Tipologia:</label>
                    <select name="tipoevento" id="tipoevento" required>
                        <option value="torneo" selected>Torneo</option>
                        <option value="serata">Serata</option>
                    </select>
                </li>
                <li><label for="numeroposti">Numero di posti:</label><input type="number" name="numeroposti" id="numeroposti" min="1" required></li>
                <li><button type="submit">Crea</button></li>
            </ul>
        </form>
    </section>
</main>