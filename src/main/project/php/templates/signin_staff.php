<nav>
    <ul><li id="signin">Sign in</li><li id="signup"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=signup-staff">Sign up</a></li></ul>
</nav>
<header>
    <h1>Starfish</h1>
    <h2>Private area</h2>
</header>
<nav>
    <ul><li id="client"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=signin-client">Client</a></li><li id="staff"><a href="#">Staff area</a></li></ul>
</nav>
<main>
    <img src="../../../../starfish.jpg" alt=""/>
    <form action="#" method="POST">
        <h2>Sign in Staff</h2>
        <ul>
            <li><label for="email">Email:</label><input id="email" type="email" name="email" autocomplete="on" placeholder="jack.black@starfish.com" required/></li>
            <li><label for="pwd">Password:</label><input id="pwd" type="password" name="pwd" placeholder="Password" required/></li>
            <li><label for="login" hidden>Login:</label><input id="login" type="submit" value="Login"/></li>
        </ul>
    </form>
</main>
<footer>
    <p>©Starfish</p>
</footer>