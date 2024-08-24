<nav>
    <ul><li id="signin"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=signin">Sign in</a></li><li id="signup">Sign up</li></ul>
</nav>
<header>
    <h1>Starfish</h1>
</header>
<nav>
    <ul><li id="client"><a href="signin_client.php">Client</a></li><li id="staff"><a href="signin_staff.php">Staff area</a></li></ul>
</nav>
<main>
    <img src="../images/starfish.jpg" alt=""/>
    <form action="#" method="POST">
        <h2>Register</h2>
        <ul>
            <li><label for="username">Username:</label><input id="username" type="text" name="username" placeholder="Username" required/></li>
            <li><label for="pwd1">Password:</label><input id="pwd1" type="password" name="pwd1" placeholder="Password" required/></li>
            <li><label for="pwd2">Confirm Password:</label><input id="pwd2" type="password" name="pwd2" placeholder="Confirm Password" required/></li>
            <li><label for="register" hidden>Register:</label><input id="register" type="submit" value="Register"/></li>
        </ul>
    </form>
</main>
<footer>
    <p>©Starfish</p>
</footer>