<header>
    <h1>Starfish</h1>
    <h2>Private area - admin</h2>
</header>
<nav>
<ul><li id="best_rated_members"><a href="best_rated_members.php">Best rated members</a></li><li id="worst_rated_members"><a href="worst_rated_members.php">Worst rated members</a></li><li id="best_clients"><a href="best_clients.php">Best clients</a></li><li id="best_worker"><a href="best_worker.php">Best worker</a></li></ul>
</nav>
<main>
    <ul>
        <?php $member = $db->getBestWorker(); ?>
            <li><?php echo $member['nome'].' '.$member['cognome'].' '.$member['minuti_lavorati']; ?></li>
    </ul>
</main>

