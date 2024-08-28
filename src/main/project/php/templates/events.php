<header>
    <h1>Starfish</h1>
    <h2>Partecipa ai nostri eventi</h2>
</header>
<nav>
    <ul><li id="home"><a href="home.html">Home</a></li><li id="reservations"><a href="reservation.php">Reservations</a></li><li id="events"><a href="event.php">Events</a></li></ul>
</nav>
<main>
    <section>
        <h3>Partecipa a un Evento - Torneo</h3>
        <form action="#" method="post">
            <ul>
                <li><label for="codiceEvento">Codice evento:</label><input type="number" id="codiceEvento" name="codiceEvento" min="0" required></li>
                <li><button type="submit">Iscriviti</button></li>
            </ul>
        </form>
        <h3>Lista di eventi</h3>
        <ul>
        <?php
            foreach($db->getEventsList() as $events) {
                ?>
                <li>Nome: <?php echo $events['nomeEvento'].' -';?> Tipologia: <?php echo $events['tipoEvento']?> Codice evento: <?php echo $events['codiceEvento']?></li>
                <?php
            }
        ?>
        </ul>
    </section>
</main>