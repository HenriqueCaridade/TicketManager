<?php
    include("../templates/header.php");
    session_start();
    $prevUsername  = htmlentities($_SESSION['input']['register username'] ?? "");
    $prevName      = htmlentities($_SESSION['input']['register name'] ?? "");
    $prevEmail     = htmlentities($_SESSION['input']['register email'] ?? "");
    $prevPassword1 = htmlentities($_SESSION['input']['register password1'] ?? "");
    $prevPassword2 = htmlentities($_SESSION['input']['register password2'] ?? "");
?>
<main>
    <h1>Register</h1>
    <form action="../actions/register.php" method="post">
        <label class="register-item">Username:         <input type="text"     name="username"  required value="<?=$prevUsername?>"></label>
        <label class="register-item">Name:             <input type="text"     name="name"      required value="<?=$prevName?>"></label>
        <label class="register-item">E-mail:           <input type="email"    name="email"     required value="<?=$prevEmail?>"></label>
        <label class="register-item">Password:         <input type="password" name="password1" required value="<?=$prevPassword1?>"></label>
        <label class="register-item">Confirm password: <input type="password" name="password2" required value="<?=$prevPassword2?>"></label>
        <a class="register-item" href="login_page.php">I already have an account.</a>
        <input class="button register-item" type="submit" value="Register">
    </form>
</main>
<?php
    include("../templates/footer.php");
?>