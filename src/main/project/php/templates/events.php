<header>
    <h1>Starfish</h1>
    <h2>Partecipa ai nostri eventi</h2>
</header>
<nav>
    <ul><li id="home"><a href="home.html">Home</a></li><li id="reservations"><a href="reservation.php">New Event</a></li><li id="events"><a href="event.php">Events</a></li></ul>
</nav>
<main>
    <section>
        <h3>Partecipa a un Evento</h3>
        <form action="#" method="post">
            <ul>
                <li><label for="nomeEvento">Nome:</label><input type="text" id="nomeEvento" name="nome" required></li>
                <li><label for="cognomeEvento">Cognome:</label><input type="text" id="cognomeEvento" name="cognome" required></li>
                <li><label for="emailEvento">Email:</label><input type="email" id="emailEvento" name="email" required></li>
                <li><label for="telefonoEvento">Numero di Telefono:</label><input type="tel" id="telefonoEvento" name="telefono" required></li>
            <li><label for="evento">Tipo di Evento:</label>
                <select id="evento" name="evento" required>
                    <option value="" hidden>vuoto</option>
                    <option value="concerto" selected>Concerto</option>
                    <option value="serata_danza">Serata di Danza</option>
                    <option value="cena_gala">Cena di Gala</option>
                </select></li>
                <li><button type="submit">Iscriviti</button></li>
            </ul>
        </form>
    </section>
    <section>
        <h3>Partecipa a un Torneo sportivo</h3>
        <form action="#" method="post">
            <ul>
                <li><label for="nomeSport">Nome:</label><input type="text" id="nomeSport" name="nome" required></li>
                <li><label for="cognomeSport">Cognome:</label><input type="text" id="cognomeSport" name="cognome" required></li>
                <li><label for="emailSport">Email:</label><input type="email" id="emailSport" name="email" required></li>
                <li><label for="telefonoSport">Numero di Telefono:</label><input type="tel" id="telefonoSport" name="telefono" required></li>
            <li><label for="sport">Tipo di Sport:</label>
                <select id="sport" name="sport" required>
                    <option value="" hidden>vuoto</option>
                    <option value="calcio" selected>Calcio</option>
                    <option value="basket">Basket</option>
                    <option value="tennis">Tennis</option>
                    <option value="volley">Volley</option>
                    <option value="altro">Altro</option>
                </select></li>
                <li><button type="submit">Iscriviti</button></li>
            </ul>
        </form>
    </section>
</main>