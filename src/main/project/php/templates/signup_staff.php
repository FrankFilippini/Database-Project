<nav>
    <ul><li id="signin"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=signin-staff">Sign in</a></li><li id="signup">Sign up</li></ul>
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
        <h2>Sign up Staff</h2>
        <ul>
            <li><label for="CF">CF:</label><input id="CF" type="text" name="CF" placeholder="CF" required/></li>
            <li><label for="name">Name:</label><input id="name" type="text" name="name" placeholder="Name" required/></li>
            <li><label for="surname">Surname:</label><input id="surname" type="text" name="surname" placeholder="Surname" required/></li>
            <li><label for="email">Email:</label><input id="email" type="text" name="email" placeholder="Email" required/></li>
            <li><label for="pwd1">Password:</label><input id="pwd1" type="password" name="pwd1" placeholder="Password" required/></li>
            <li><label for="pwd2">Confirm Password:</label><input id="pwd2" type="password" name="pwd2" placeholder="Confirm Password" required/></li>
            <li><label for="register" hidden>Register:</label><input id="register" type="submit" value="Register"/></li>
        </ul>
    </form>
</main>
<footer>
    <p>©Starfish</p>
</footer>